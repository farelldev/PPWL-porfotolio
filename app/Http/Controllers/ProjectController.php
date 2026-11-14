<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Project;
use App\Models\Category;
use App\Models\Technology;
use Illuminate\View\View;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);

        $search = $request->input('search');

        $projects = Project::orderBy('created_at', 'desc');

        if ($search) {
            $projects->where('title', 'like', "%{$search}%");
        }

        $projects = $projects->paginate($perPage)->withQueryString();

        return view('projects.index', compact('projects'));
    }

    public function publicIndex(Request $request): View
    {
        $query = Project::with(['category', 'technologies'])
            ->where('status', 'published')
            ->when($request->search, fn ($q, $s) =>
                $q->where(fn ($w) => $w->where('title', 'like', "%{$s}%")
                    ->orWhere('short_description', 'like', "%{$s}%")
                    ->orWhere('description', 'like', "%{$s}%")))
            ->when($request->category, fn ($q, $c) =>
                $q->whereHas('category', fn ($w) => $w->where('slug', $c)))
            ->when($request->technology, fn ($q, $t) =>
                $q->whereHas('technologies', fn ($w) => $w->where('slug', $t)));

        switch ($request->query('sort')) {
            case 'terlama':
                $query->oldest();
                break;
            case 'az':
                $query->orderBy('title');
                break;
            default:
                $query->latest();
        }

        $projects = $query->paginate(9)->withQueryString();
        $categories = Category::orderBy('name')->get();
        $technologies = Technology::orderBy('name')->get();

        return view('projects.public-index', compact('projects', 'categories', 'technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        $technologies = Technology::orderBy('name')->get();

        return view('projects.create', compact('categories', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'             => 'required|string|min:5|max:200|unique:projects,title',
            'category_id'       => 'required|exists:categories,id',
            'short_description' => 'nullable|string|max:255',
            'description'       => 'required|string|min:10', 
            'status'            => 'required|in:draft,published', 
            'project_url'       => 'nullable|url|max:255',
            'repository_url'    => 'nullable|url|max:255',
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
            'technologies'   => 'nullable|array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        $validated['slug'] = Str::slug($validated['title']) ?: 'project';

        if ($request->hasFile('thumbnail')) {
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }
        
        $technologyIds = $validated['technologies'] ?? [];
        unset($validated['technologies']);

        $project = Project::create($validated);
        $project->technologies()->attach($technologyIds);

        return redirect()->route('projects.index')
            ->with('success', 'Project berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function publicShow(string $slug): View
    {
        $project = Project::published()
            ->with(['category', 'technologies', 'images'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('projects.public-show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::with('technologies')->findOrFail($id);
        $categories = Category::orderBy('name')->get();
        $technologies = Technology::orderBy('name')->get();

        return view('projects.edit', compact('project', 'categories', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $validated = $request->validate([
            'title'             => 'required|string|min:5|max:200|unique:projects,title,' . $project->id,
            'category_id'       => 'required|exists:categories,id',            
            'short_description' => 'nullable|string|max:255',
            'description'       => 'required|string|min:10',
            'status'            => 'required|in:draft,published',
            'project_url'       => 'nullable|url|max:255',
            'repository_url'    => 'nullable|url|max:255',            
            'thumbnail'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048|dimensions:min_width=400,min_height=300',
            'technologies'   => 'nullable|array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($project->thumbnail) {
                Storage::disk('public')->delete($project->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')
                ->store('projects/thumbnails', 'public');
        }

        $technologyIds = $validated['technologies'] ?? [];
        unset($validated['technologies']);

        $project->update($validated);
        $project->technologies()->sync($technologyIds);

        return redirect()->route('projects.index')
            ->with('success', 'Project berhasil diperbarui.');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);

        if ($project->thumbnail) {
            Storage::disk('public')->delete($project->thumbnail);
        }
        foreach ($project->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $project->delete();

        return redirect()->route('projects.index')
            ->with('success', 'Project berhasil dihapus.');
    }

    public function trash()
    {
        $projects = Project::onlyTrashed()->orderBy('created_at', 'desc')->paginate(10);
        return view('projects.trash', compact('projects'));
    }

    public function restore($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->restore();

        return redirect()->route('projects.trash')->with('success', 'Project berhasil dikembalikan.');
    }

    public function forceDelete($id)
    {
        $project = Project::withTrashed()->findOrFail($id);
        $project->forceDelete();

        return redirect()->route('projects.trash')->with('success', 'Project dihapus permanen.');
    }
}

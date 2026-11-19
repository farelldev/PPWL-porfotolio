<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $projects = Project::with(['category', 'technologies'])
            ->where('status', 'published')
            ->when($request->search, fn ($q, $s) =>
                $q->where(fn ($w) => $w->where('title', 'like', "%{$s}%")
                    ->orWhere('short_description', 'like', "%{$s}%")))
            ->when($request->category, fn ($q, $c) =>
                $q->whereHas('category', fn ($w) => $w->where('slug', $c)))
            ->latest()
            ->paginate(9)
            ->withQueryString();

        return ProjectResource::collection($projects);
    }

    public function show(Project $project)
    {
        abort_if($project->status !== 'published', 404);
        return new ProjectResource($project->load(['category', 'technologies']));
    }
}

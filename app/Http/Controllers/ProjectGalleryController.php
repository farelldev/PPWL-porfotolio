<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectGalleryController extends Controller
{
    public function store(Request $request, Project $project): RedirectResponse
    {
        $remainingSlots = max(0, 10 - $project->images()->count());

        $request->validate([
            'images' => ['required', 'array', 'min:1', 'max:'.$remainingSlots],
            'images.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        foreach ($request->file('images', []) as $index => $file) {
            $project->images()->create([
                'image' => $file->store('projects/gallery', 'public'),
                'caption' => $request->input("captions.{$index}"),
                'sort_order' => $project->images()->count(),
            ]);
        }

        return back()->with('success', 'Gambar berhasil diunggah.');
    }

    public function update(Request $request, Project $project, ProjectImage $image): RedirectResponse
    {
        abort_if($image->project_id !== $project->id, 404);

        $validated = $request->validate([
            'caption' => ['nullable', 'string', 'max:255'],
        ]);

        $image->update($validated);

        return back()->with('success', 'Caption berhasil diperbarui.');
    }

    public function destroy(Project $project, ProjectImage $image): RedirectResponse
    {
        abort_if($image->project_id !== $project->id, 404);
        Storage::disk('public')->delete($image->image);
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProjectGalleryController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $request->validate([
            'images'   => 'required|array|max:10',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        foreach ($request->file('images') as $file) {
            $project->images()->create([
                'image' => $file->store('projects/gallery', 'public'),
            ]);
        }

        return back()->with('success', 'Gambar berhasil diunggah.');
    }

    public function destroy(Project $project, ProjectImage $image)
    {
        abort_if($image->project_id !== $project->id, 404);
        Storage::disk('public')->delete($image->image);
        $image->delete();
        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}

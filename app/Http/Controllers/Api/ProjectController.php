<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Http\Resources\ProjectResource;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with(['category', 'technologies'])
            ->where('status', 'published')
            ->latest()
            ->paginate(9);

        return ProjectResource::collection($projects);
    }

    public function show(Project $project)
    {
        abort_if($project->status !== 'published', 404);
        return new ProjectResource($project->load(['category', 'technologies']));
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Project, Skill, Technology};

class DashboardController extends Controller
{
    public function index()
    {
        return view('projects.dashboard', [
        'totalProjects' => Project::count(),
        'totalCategories' => Category::count(),
        'totalTechnologies' => Technology::count(),
        'totalSkills' => Skill::count(),
        'latestProjects' => Project::latest()->take(5)->get(),
        ]);
    }
}

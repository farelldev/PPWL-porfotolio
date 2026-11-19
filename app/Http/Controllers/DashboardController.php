<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Contact, Project, Skill, Technology};

class DashboardController extends Controller
{
    public function index()
    {
        $totalProjects = Project::count();
        $publishedProjects = Project::where('status', 'published')->count();
        $draftProjects = Project::where('status', 'draft')->count();
        $totalSkills = Skill::count();
        $totalMessages = Contact::count();
        $unreadMessages = Contact::where('is_read', false)->count();

        $categories = Category::withCount('projects')->get();

        $topSkills = Skill::withCount('projects')
                        ->orderBy('projects_count', 'desc')
                        ->take(5)
                        ->get();

        return view('projects.dashboard', compact(
            'totalProjects', 
            'publishedProjects', 
            'draftProjects', 
            'totalSkills',
            'categories',
            'topSkills',
            'totalMessages',
            'unreadMessages'
        ));
    }
}

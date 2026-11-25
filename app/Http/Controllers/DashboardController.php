<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{Category, Contact, Project, Skill, Technology};
use Illuminate\Support\Facades\{Cache, DB};

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

        $cacheStatuses = [
            'portfolio.featured'     => Cache::has('portfolio.featured'),
            'portfolio.skills'       => Cache::has('portfolio.skills'),
            'portfolio.categories'   => Cache::has('portfolio.categories'),
            'portfolio.technologies' => Cache::has('portfolio.technologies'),
            'portfolio.experiences'  => Cache::has('portfolio.experiences'),
            'portfolio.educations'   => Cache::has('portfolio.educations'),
        ];

        $pendingJobs = DB::table('jobs')->count();
        $failedJobs = DB::table('failed_jobs')->count();

        return view('projects.dashboard', compact(
            'totalProjects',
            'publishedProjects',
            'draftProjects',
            'totalSkills',
            'categories',
            'topSkills',
            'totalMessages',
            'unreadMessages',
            'cacheStatuses',
            'pendingJobs',
            'failedJobs'
        ));
    }

    public function clearCache()
    {
        Cache::forget('portfolio.featured');
        Cache::forget('portfolio.skills');
        Cache::forget('portfolio.categories');
        Cache::forget('portfolio.technologies');
        Cache::forget('portfolio.experiences');
        Cache::forget('portfolio.educations');

        return back()->with('success', 'Seluruh cache portofolio berhasil dibersihkan.');
    }
}

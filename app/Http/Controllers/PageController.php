<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\Education;
use App\Models\Experience;


class PageController extends Controller
{
    public function experience()
    {
        $experiences = Cache::remember('portfolio.experiences', 3600, fn () =>
            Experience::latest()->get()
        );

        return view('experience', compact('experiences'));
    }

    public function education()
    {
        $educations = Cache::remember('portfolio.educations', 3600, fn () =>
            Education::latest()->get()
        );

        return view('education', compact('educations'));
    }
}

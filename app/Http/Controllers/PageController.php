<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function experience()
    {
        // Jika pakai database: $experiences = Experience::orderBy('created_at', 'desc')->get();
        // return view('pages.experience', compact('experiences'));
        
        return view('experience'); 
    }

    public function education()
    {
        // Jika pakai database: $educations = Education::orderBy('created_at', 'desc')->get();
        // return view('pages.education', compact('educations'));
        
        return view('education');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|max:100',
            'subject' => 'nullable|max:200',
            'message' => 'required|min:10',
        ]);

        Contact::create($validated);
        return back()->with('success', 'Pesan berhasil dikirim. Terima kasih!');
    }
}

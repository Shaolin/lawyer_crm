<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function show()
    {
        return view('contact');
    }

    public function send(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'message' => 'required|string|max:1000',
        ]);

        // Example: store in DB (optional)
        // ContactMessage::create($validated);

        // Example: send email (optional)
        // Mail::to('support@crystalcrm.com')->send(new ContactMail($validated));

        return back()->with('success', 'Thanks for reaching out! We’ll get back to you soon.');
    }
}

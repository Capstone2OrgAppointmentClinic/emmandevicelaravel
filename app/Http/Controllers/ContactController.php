<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;



class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // Save to database
        Contact::create($request->only(['name', 'email', 'message']));

        return redirect()->back()->with('success', 'Thank you for your feedback! We appreciate your message and will take it into consideration.');

    }
}

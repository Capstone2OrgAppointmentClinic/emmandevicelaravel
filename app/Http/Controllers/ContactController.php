<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

<<<<<<< HEAD


=======
>>>>>>> 29e3bda8c0e3ece2ad2fc9d7b45eb6f851bd88fe
class ContactController extends Controller
{
    public function store(Request $request)
    {
<<<<<<< HEAD
        // Validation
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        // Save to database
        Contact::create($request->only(['name', 'email', 'message']));

        return redirect()->back()->with('success', 'Thank you for your feedback! We appreciate your message and will take it into consideration.');

=======
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        Contact::create($validated);

        return redirect()->back()->with('success', 'Thanks for reaching out to us. Your feedback and suggestions are always welcome and help us improve.');
>>>>>>> 29e3bda8c0e3ece2ad2fc9d7b45eb6f851bd88fe
    }
}

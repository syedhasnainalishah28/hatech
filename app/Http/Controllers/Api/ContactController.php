<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    // Public: submit contact form
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        $contact = Contact::create($data);

        // TODO: notify admin via email
        // Mail::to(config('mail.admin_email'))->send(new NewContactMail($contact));

        return response()->json(['message' => 'Thank you! We will get back to you soon.'], 201);
    }

    // Public: subscribe to newsletter
    public function subscribe(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        NewsletterSubscriber::firstOrCreate(['email' => $request->email]);

        return response()->json(['message' => 'Subscribed successfully! Welcome to HA Tech updates.']);
    }

    // Admin: list all contacts
    public function index()
    {
        $contacts = Contact::orderByDesc('created_at')->paginate(30);
        return response()->json($contacts);
    }

    // Admin: mark contact as read
    public function markRead(int $id)
    {
        Contact::findOrFail($id)->update(['read' => true]);
        return response()->json(['message' => 'Marked as read.']);
    }
}

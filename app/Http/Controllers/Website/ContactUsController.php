<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    public function create()
    {
        return view('website.content.contact-us');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'      => 'required|min:3|max:50',
            'user_id'   => 'nullable|exists:users,id',
            'email'     => 'required|email',
            'mobile'    => 'nullable|numeric',
            'subject'   => 'required|min:5|max:200',
            'message'   => 'required|min:10|max:500',
        ]);

        Contact::create($request->all());

        return redirect()->route('contact-us')
            ->with('success', 'Massage Sent Successfully!');

    }
}

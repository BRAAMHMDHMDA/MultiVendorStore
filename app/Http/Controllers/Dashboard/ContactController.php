<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class ContactController extends Controller
{
    public function index()
    {
        return view('dashboard.content.contacts.index',[
            'contacts' => Contact::latest()->paginate(10),
        ]);
    }
    public function update(Contact $contact)
    {
        $contact->update(['status' => Contact::STATUS_READ,]);
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return Redirect::route('dashboard.contacts.index')
            ->with('success', 'Contact Deleted Successfully!');
    }
}

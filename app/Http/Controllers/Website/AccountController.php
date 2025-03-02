<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{

    public function index()
    {
        $user = Auth::guard('web')->user();
        return view('website.content.my-account',[
            'orders' => $user->orders()->latest()->get(),
            'user' => $user
        ]);
    }

    public function update(Request $request)
    {
        // validate request
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'phone_number' => 'required|numeric'
        ]);
        Auth::guard('web')->user()->update($request->all());
        return back()->with('success', 'Profile Updated');
    }

    public function changePassword(Request $request)
    {
        // validate password
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = Auth::guard('web')->user();

        if (Hash::check($request->current_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->password)
            ]);
            return back()->with('success', 'Password Updated');
        }
        return back()->with('error', 'Current Password does not match');

    }
}

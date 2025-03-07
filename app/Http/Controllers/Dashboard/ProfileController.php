<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use JetBrains\PhpStorm\NoReturn;

class ProfileController extends Controller
{

    public function index()
    {
        return view('dashboard.content.pages.profile', [
            'admin' => Auth::guard('admins')->user() ?? Auth::guard('vendors')->user(),
        ]);
    }

    public function update(Request $request)
    {
        $admin = Auth::guard('admins')->user();
        $vendor = Auth::guard('vendors')->user();

        $request->validate([
            'name' => 'required|min:3|max:50|string',
            'username' => 'required|min:3|max:50|string',
            'phone_number' => 'required|string|min:6|max:30',
            'email' => 'required|email'
        ]);

        if ($admin){
            Admin::updateImage($request, $admin->image_path);
            $admin->update($request->all());
        }elseif ($vendor){
            Vendor::updateImage($request, $vendor->image_path);
            $vendor->update($request->all());
        }

        return redirect()->route('dashboard.profile')->with('success', 'Profile Info Updated Successfully');
    }

    public function changePassword(Request $request)
    {
        $admin = Auth::guard('admins')->user() ?? Auth::guard('vendors')->user();

        // validate password
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:6'
        ]);

        if (Hash::check($request->current_password, $admin->password)) {
            $admin->forceFill([
                'password' => Hash::make($request->password)
            ]);
            $admin->save();
            return back()->with('success', 'Password Updated Successfully');
        }
        return back()->with('error', 'Current Password does not match');

    }
}

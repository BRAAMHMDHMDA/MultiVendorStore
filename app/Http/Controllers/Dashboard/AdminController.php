<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $admins = Admin::latest()->paginate();
        return view('dashboard.content.admins.index', [
            'admins' => $admins
        ]);
    }
    public function create()
    {

    }
    public function edit()
    {

    }
    public function update()
    {

    }
    public function delete()
    {

    }

    public function setStatus(Admin $admin)
    {
        $admin->updateOrFail([
            'status' => ($admin->status === 'active') ? 'inactive' : 'active',
        ]);

        return redirect()->route('dashboard.admins.index');
    }

}

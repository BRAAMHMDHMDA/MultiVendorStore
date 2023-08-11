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
}

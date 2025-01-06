<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Show the admin dashboard
    public function dashboard()
    {
        // Additional logic for the dashboard can be added here if needed
        return view('admin.dashboard');
    }
}

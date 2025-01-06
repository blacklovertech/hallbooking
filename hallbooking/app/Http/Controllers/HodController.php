<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HodController extends Controller
{
    // Display the calendar
    public function index()
    {
        return view('calendar.index');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CrabController extends Controller
{
    function dashboard()
    {
        return view('dashboard');
    }
}

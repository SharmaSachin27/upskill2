<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DemoController extends Controller
{
    // demo controller
    public function index()
    {
        return view('homes');
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompanyProfileController extends Controller
{
    //
    public function index()
    {
        
        $user = Auth::user();
        return view('manageCompanyProfile', compact('user'));
        
    }
}

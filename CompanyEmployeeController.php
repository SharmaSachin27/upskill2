<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class CompanyEmployeeController extends Controller
{
    //
    public function employeelist()
    {
        
        $user = Auth::user();
        $employees = Employee::where('company_id', $user->id)->get();
        return view('employeelist', compact('employees'));
        
    }
}

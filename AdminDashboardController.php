<?php

namespace App\Http\Controllers;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function dashboardData()
    {
        $companiesCnt = Company::all()->count();
        $employeesCnt = Employee::all()->count();
        return view('admin')->with(['companiesCnt' => $companiesCnt, 'employeesCnt' => $employeesCnt]);
    }
}

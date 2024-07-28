<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmployeeRequest;
use App\Mail\NotifyMail;
use App\Models\Employee;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class EmployeeContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$employees = Employee::join('company', 'employee.company_id', '=', 'company.id')->select('employee.*', 'company.name')->get();
        //$employees = Employee::with('getCompany')->get();
        $employees = Employee::with('company')->get();
        return view('viewEmployee')->with('employees', $employees);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = Company::all();
        return view('manageEmployee')->with('company', $company);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'firstname' =>  'required|max:100',
            'lastname' => 'required|max:100',
            'email' => 'required|email|unique:employee',
            'company_id' => 'required'
        ], 
        [
            'firstname.required' => 'The firstname field is required.',
            'firstname.max' => 'The firstname may not be greater than 100 characters.',
            'lastname.required' => 'The lastname field is required.',
            'lastname.max' => 'The lastname may not be greater than 100 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 100 characters.',
            'email.unique' => 'The email has already been taken.',
            'company_id.required' => 'The company ID field is required.',
        ]);
        $input = $request->all();
        Employee::create($input);
        Mail::to($input['email'])->send(new NotifyMail($input['firstname']));
        Session::put('statusCode', 'success');
        return redirect()->route('employees.index')->with('status', 'Record Addedd Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $employee = Employee::find($id);
        $company = Company::all();
        return view('manageEmployee')->with(['employee' => $employee, 'company' => $company]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $employee = Employee::find($id);
        $request->validate([
            'firstname' =>  'required|max:100',
            'lastname' => 'required|max:100',
            'email' => 'required|email|max:100|unique:employee,email,' . $id . ',id',
            'company_id' => 'required'
        ],[
            'firstname.required' => 'The firstname field is required.',
            'firstname.max' => 'The firstname may not be greater than 100 characters.',
            'lastname.required' => 'The lastname field is required.',
            'lastname.max' => 'The lastname may not be greater than 100 characters.',
            'email.required' => 'The email field is required.',
            'email.email' => 'The email must be a valid email address.',
            'email.max' => 'The email may not be greater than 100 characters.',
            'email.unique' => 'The email has already been taken.',
            'company_id.required' => 'The company ID field is required.',
        ]);
        $employee->firstname = $request->firstname;
        $employee->lastname = $request->lastname;
        $employee->email = $request->email;
        $employee->company_id = $request->company_id;
        $employee->save();
        Session::put('statusCode', 'success');
        return redirect()->route('employees.index')->with('status', 'Record Updated Successfully!');
    }

    public function updateStatus(Request $request, Employee $employee)
    {
        
        $request->validate([
            'status' => 'required|boolean',
        ]);

        $employee->status = $request->status;
        $employee->save();

        return response()->json(['message' => 'Status updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        Session::put('statusCode', 'success');
        return redirect()->route('employees.index')->with('status', 'Record Deleted Successfully!');
    }
}

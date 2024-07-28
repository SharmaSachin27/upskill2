<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $company = Company::all();
        return view('viewCompany')->with('company', $company);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('/manageCompany');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' =>  'required|max:100',
            'email' => 'required|email|unique:companies,email',
            'logo' => 'required|dimensions:min_width=100,min_height=100|file|mimes:jpg,png|min:100|max:204800',
            'website' => 'required'
        ],
        [
            'logo.required' => "you have to choose company logo it required.",
            'logo.dimensions' => "you have to choose image minimum 100 x 100 dimension.",
            'logo.min' => 'The logo must be at least 100KB.',
            'logo.max' => 'The logo may not be greater than 200MB.',
            'name.max' => 'The firstname may not be greater than 100 characters.',
        ]);
        $input = $request->all();
        if($request->file('logo')){
            $file= $request->file('logo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(storage_path('app/public/company_logos/'), $filename);
        }
        $input['logo'] = $filename;
        Company::create($input);
        Session::put('statusCode', 'success');
        return redirect()->route('companies.index')->with('status', 'Record Addedd Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return redirect()->route('companies.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company = Company::find($id);
        return  view('manageCompany')->with('company', $company);
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
        $company = Company::find($id);
        $request->validate([
            'name' =>  'required|max:100',
            'email' => 'required|email|unique:company,email,' . $id . ',id',
            'logo' => 'dimensions:min_width=100,min_height=100',
            'website' => 'required'
        ],
        [
            'logo.dimensions' => "you have to choose image minimum 100 x 100 dimension.",
            'name.max' => 'The firstname may not be greater than 100 characters.',
        ]);
        $filename = null;
        if($request->file('logo') !== null){
            $file= $request->file('logo');
            $filename= date('YmdHi').$file->getClientOriginalName();
            $file-> move(storage_path('app/public/company_logos/'), $filename);
            File::delete(storage_path('app/public/company_logos/' . $request->oldlogo));
        } else {
            $filename = $request->oldlogo;
        }
        $company->name = $request->name;
        $company->email = $request->email;
        $company->website = $request->website;
        $company->logo = $filename;
        $company->save();
        return redirect()->route('companies.index')->with('status', 'Record Updated Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::find($id);
        File::delete(storage_path('app/public/company_logos/' . $company->logo));
        $company->delete();
        Session::put('statusCode', 'success');
        return redirect()->route('companies.index')->with('status', 'Record Deleted Successfully!');
    }
}

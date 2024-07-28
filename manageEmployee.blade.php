@extends('layout.master')
@section('title', 'Manage Company')
@section('main-content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Manage Employee</h1>
        <div class="card mb-4">
            <div class="card-body">
                @if(isset($employee))
                    <form action="{{ route('employees.update', $employee->id) }}" method="post" enctype="multipart/form-data">
                        @method('put')
                @else
                    <form action="{{ url('employees') }}" method="post" enctype="multipart/form-data">
                @endif 
                    @csrf
                    <div class="form-group">
                        <label>First Name <span class="text-danger">*</span></label>
                        <input type="text" name="firstname" id="firstname" class="form-control" placeholder="Enter First Name" value="{{ old('firstname', $employee->firstname ?? '') }}">
                        <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label>Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="lastname" id="lastname" class="form-control" placeholder="Enter Last Name" value="{{ old('lastname', $employee->lastname ?? '') }}">
                        <span class="text-danger">@error('lastname') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="abc@gmail.com" value="{{ old('email', $employee->email ?? '') }}">
                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-1">Company <span class="text-danger">*</span></label>
                            <select class="form-control col-md-3" name="company_id" id="company_id">
                                <option value="">Select company</option>
                                @foreach ($company as $item)
                                    @isset($employee)
                                        <option value="{{ $item->id }}" {{ $item->id == $employee->company_id ? 'selected' : '' }}>{{ $item->name }}</option>    
                                    @else
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>    
                                    
                                    @endisset
                                @endforeach
                            </select>
                        </div>
                        <span class="text-danger">@error('company_id') {{ $message }} @enderror</span>
                    </div>
                    <input type="submit" value="Save" class="btn btn-success">
            </div>
        </div>
    </div>
</main>
@endsection
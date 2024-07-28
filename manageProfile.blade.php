@extends('layout.master')
@section('title', 'Manage Company')
@section('main-content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Manage Company</h1>
        <div class="card mb-4">
            <div class="card-body">
                @if(isset($user))
                    <form action="{{ route('profile.update') }}" method="post" enctype="multipart/form-data">
                        @method('put')
                @endif 
                    @csrf
                    <div class="form-group">
                    <label>Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter Name" value="{{ old('name', $user->name ?? '') }}">
                        <span class="text-danger">@error('name') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <label>Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="abc@gmail.com" value="{{ old('email', $user->email ?? '') }}">
                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                    </div>
                    <!-- <div class="form-group">
                        <label>Website <span class="text-danger">*</span></label>
                        <input type="text" name="website" id="website" class="form-control" placeholder="www.abc.com" value="{{ old('website', $company->website ?? '') }}">
                        <span class="text-danger">@error('website') {{ $message }} @enderror</span>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <label class="col-sm-1">Upload Logo <span class="text-danger">*</span></label>
                            <input type="file" name="logo" id="logo" class="form-control col-md-3">
                            @if (isset($company))
                                <input name="oldlogo" type="hidden" value="{{ $company->logo }}">
                                <img src="{{ asset('public/storage/company_logos/' . $company->logo) }}" id="preview" alt="img" height="100px" width="40px" class="col-sm-1 border border-dark ml-4">
                            @else
                                <img src="{{ asset('public/nopreview.png') }}" alt="img" id="preview" height="100px" width="40px" class="col-sm-1 border border-dark ml-4">
                            @endif
                        </div>
                        <span class="text-danger">@error('logo') {{ $message }} @enderror</span>
                    </div> -->
                    <input type="submit" value="Save" class="btn btn-success">
                
            </div>
        </div>
    </div>
</main>
@endsection
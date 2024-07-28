@extends('layout.master')
@section('title', 'Manage Company')
@section('main-content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Manage Employee</h1>
        <div class="row">
            <div class="add-btn col-md-11">
            </div>
            <div class="add-btn col-md-1">
                <a href="{{ route('employees.create') }}"><button class="btn btn-dark pull-right">ADD <i class="fa fa-plus"></i></button></a>    
            </div>
        </div>
        <div class="card mb-4 mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Firstname</th>
                                <th>Lastname</th>
                                <th>email</th>
                                <th>company</th>
                                <th>status</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($employees as $item)
                            <tr>
                                <td>{{ $item->firstname }}</td>
                                <td>{{ $item->lastname }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->company->name }}</td>
                                <td class="text-center">
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="status-{{ $item->id }}" data-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="status-{{ $item->id }}"></label>
                                </div>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('employees.edit',$item->id) }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a>
                                </td>
                                <td class="text-center">
                                    <form method="POST" action="{{ url('employees', $item->id) }}" accept-charset="UTF-8" style="display:inline" id="deleteEmployee">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm delete" id="deleteCompany"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Scripts section -->
@push('scripts')
<script>
    $(document).ready(function() {
        console.log("dhdhdhdh");
        // Handle toggle change event
        
    });
</script>
@endpush
@endsection
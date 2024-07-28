@extends('layout.master')
@section('title', 'Manage Company')
@section('main-content')
<main>
    <div class="container-fluid">
        <h1 class="mt-4">view Company</h1>
        <div class="row">
            <div class="add-btn col-md-11">
            </div>
            <div class="add-btn col-md-1 pull-right">
                <a href="{{ route('companies.create') }}"><button class="btn btn-dark pull-right">ADD <i class="fa fa-plus"></i></button></a>
            </div>
        </div>
        <div class="card mb-4 mt-3">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Logo</th>
                                <th>Email</th>
                                <th>Website</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($company as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td class="text-center">
                                    <a href="{{ asset("public/storage/company_logos") . "/" . $item->logo }}" data-fancybox="gallery"><img src="{{ asset("public/storage/company_logos") . "/" . $item->logo }}" alt="img" height="80px" width="80px" style="border-radius: 50%;"  class="logo-img"></a>
                                    </td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->website }}</td>
                                <td class="text-center">
                                    <a href="{{ route('companies.edit',$item->id) }}" title="Edit Student"><button class="btn btn-primary btn-sm"><i class="fa fa-edit" aria-hidden="true"></i> Edit</button></a>
                                </td>
                                <td class="text-center">
                                    <form method="POST" action="{{ url('companies', $item->id) }}" accept-charset="UTF-8" style="display:inline" id="{{ 'deleteCompany_' . $item->id }}" class="delete">
                                        {{ method_field('DELETE') }}
                                        {{ csrf_field() }}
                                        <button type="submit" class="btn btn-danger btn-sm delete"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
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
<script>
    
</script>
@endsection
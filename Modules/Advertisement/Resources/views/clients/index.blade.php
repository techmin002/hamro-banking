@extends('setting::layouts.master')

@section('title', 'Advertisement')

@section('third_party_stylesheets')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Advertisement</li>
</ol>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Client</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Clients</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- /.card -->

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title float-right"><a class="btn btn-info text-white" href="{{ route('clients.create') }}"><i class="fa fa-plus"></i> Create</a> </h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped text-center">
                                <thead>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Client Name</th>
                                        <th>Client Contact</th>
                                        <th>Company Name</th>
                                        <th>Owner Name</th>
                                        <th>Owner Contact</th>
                                        <th>Details</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clients as $key => $value)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $value->name }}</td>
                                        <td>{{ $value->phone }}</td>
                                        <td>{{ $value->company_name }}</td>
                                        <td>{{ $value->owner_name }}</td>
                                        <td>{{ $value->owner_phone }}</td>

                                        <td>
                                            <a href="{{ route('clients.show', $value->id) }}" class="btn btn-info btn-sm">Details</a>
                                        </td>
                                        <td>
                                            @if ($value->status == 'on')
                                            <a href="{{ route('clients.status', $value->id) }}" class="btn btn-success btn-sm">On</a>
                                            @else
                                            <a href="{{ route('clients.status', $value->id) }}" class="btn btn-danger  btn-sm">Off</a>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('clients.edit', $value->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                            {{-- <a href="{{ route('blogs.show',$value->id) }}" class="btn btn-success btn-sm"><i class="fa fa-eye"></i></a> --}}
                                            <button id="delete" class="btn btn-danger btn-sm" onclick="
                              event.preventDefault();
                              if (confirm('Are you sure? It will delete the data permanently!')) {
                                  document.getElementById('destroy{{ $value->id }}').submit()
                              }
                              ">
                                                <i class="fa fa-trash"></i>
                                                <form id="destroy{{ $value->id }}" class="d-none" action="{{ route('clients.destroy', $value->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')
                                                </form>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S.N</th>
                                        <th>Client Name</th>
                                        <th>Client Contact</th>
                                        <th>Company Name</th>
                                        <th>Owner Name</th>
                                        <th>Owner Contact</th>
                                        <th>Details</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection

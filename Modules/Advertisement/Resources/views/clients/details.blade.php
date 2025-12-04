@extends('setting::layouts.master')

@section('title', 'Cient Details')

@section('third_party_stylesheets')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
@endsection

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Cient Details</li>
</ol>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Client Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Clients Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="row">
                    <!-- ================= CLIENT DETAILS ================= -->
                    <div class="col-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">Client Details</h5>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <!-- ---------------- Client Info ---------------- -->
                                    <div class="col-lg-4 mb-3">
                                        <div class="card border-info">
                                            <div class="card-header bg-info text-white">Client Info</div>
                                            <div class="card-body">
                                                <p><strong>Name:</strong> {{ $client->name }}</p>
                                                <p><strong>Email:</strong> {{ $client->email }}</p>
                                                <p><strong>Phone:</strong> {{ $client->phone }}</p>
                                                <p><strong>Alternate Phone:</strong> {{ $client->alternate_phone }}</p>
                                                <p><strong>Address:</strong> {!! $client->address !!}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ---------------- Company Info ---------------- -->
                                    <div class="col-lg-4 mb-3">
                                        <div class="card border-success">
                                            <div class="card-header bg-success text-white">Company Info</div>
                                            <div class="card-body">
                                                <p><strong>Company Name:</strong> {{ $client->company_name }}</p>
                                                <p><strong>Email:</strong> {{ $client->company_email }}</p>
                                                <p><strong>Phone:</strong> {{ $client->company_phone }}</p>
                                                <p><strong>PAN:</strong> {{ $client->company_pan }}</p>
                                                <p><strong>Address:</strong> {!! $client->company_address !!}</p>
                                                @if($client->company_logo)
                                                <p><strong>Logo:</strong><br>
                                                    <img src="{{ asset('upload/images/company/' . $client->company_logo) }}" width="150px">
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <!-- ---------------- Owner Info ---------------- -->
                                    <div class="col-lg-4 mb-3">
                                        <div class="card border-warning">
                                            <div class="card-header bg-warning text-dark">Owner Info</div>
                                            <div class="card-body">
                                                <p><strong>Name:</strong> {{ $client->owner_name }}</p>
                                                <p><strong>Email:</strong> {{ $client->owner_email }}</p>
                                                <p><strong>Phone:</strong> {{ $client->owner_phone }}</p>
                                                <p><strong>Address:</strong> {!! $client->owner_address !!}</p>
                                                @if($client->owner_image)
                                                <p><strong>Image:</strong><br>
                                                    <img src="{{ asset('upload/images/owner/' . $client->owner_image) }}" width="150px">
                                                </p>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ================= RUNNING ADS ================= -->
                    <div class="col-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-success text-white">
                                <h5 class="card-title mb-0">Running Advertisements</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Link</th>
                                            <th>Page</th>
                                            <th>Position</th>
                                            <th>Expire Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($runningAds as $index => $ad)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $ad->title }}</td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/images/advertisements/' . $ad->image) }}" width="120px">
                                            </td>
                                            <td>{{ $ad->link }}</td>
                                            <td>{{ $ad->page }}</td>
                                            <td>{{ $ad->position }}</td>
                                            <td>{{ \Carbon\Carbon::parse($ad->expire_date)->format('d M, Y h:i A') }}</td>
                                            <td>{{ $ad->status ? 'Active' : 'Inactive' }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No running advertisements.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- ================= PAST ADS ================= -->
                    <div class="col-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-danger text-white">
                                <h5 class="card-title mb-0">Past Advertisements</h5>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>S.N</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>Link</th>
                                            <th>Page</th>
                                            <th>Position</th>
                                            <th>Expire Date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($pastAds as $index => $ad)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $ad->title }}</td>
                                            <td class="text-center">
                                                <img src="{{ asset('upload/images/advertisements/' . $ad->image) }}" width="120px">
                                            </td>
                                            <td>{{ $ad->link }}</td>
                                            <td>{{ $ad->page }}</td>
                                            <td>{{ $ad->position }}</td>
                                            <td>{{ \Carbon\Carbon::parse($ad->expire_date)->format('d M, Y h:i A') }}</td>
                                            <td>{{ $ad->status ? 'Active' : 'Inactive' }}</td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No past advertisements.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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

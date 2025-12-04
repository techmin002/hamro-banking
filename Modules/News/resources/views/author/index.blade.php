@extends('setting::layouts.master')

@section('title', 'Author')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">Author</li>
</ol>
@endsection

@section('content')
<div class="content-wrapper">

    {{-- Page Header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Author</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Author</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    {{-- Main Content --}}
    <section class="content">
        <div class="container-fluid">

            <div class="card">

                {{-- Header --}}
                <div class="card-header">
                    <h3 class="card-title float-right">
                        <a class="btn btn-info text-white" data-toggle="modal" data-target="#createAuthor">
                            <i class="fa fa-plus"></i> Create
                        </a>
                    </h3>

                    {{-- Include Create Modal --}}
                    @include('news::author.create')
                </div>

                {{-- Table Section --}}
                <div class="card-body">

                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($author as $value)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $value->name }}</td>
                                {{-- Image --}}
                                <td class="text-center">
                                    @if ($value->image)
                                    <img src="{{ asset('upload/images/News_Author/'.$value->image) }}" width="120" alt="Author Image">
                                    @else
                                    <span class="badge badge-secondary">No Image</span>
                                    @endif
                                </td>
                                <td class="text-center">{!! $value->description !!}</td>
                                {{-- Status --}}
                                <td class="text-center">
                                    <a href="{{ route('author.status', $value->id) }}" class="btn btn-sm btn-{{ $value->status == 'on' ? 'success' : 'danger' }}">
                                        {{ ucfirst($value->status) }}
                                    </a>
                                </td>

                                {{-- Actions --}}
                                <td>

                                    {{-- Edit Button --}}
                                    <a data-toggle="modal" data-target="#editAuthor{{ $value->id }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    {{-- Include Edit Modal --}}
                                    @include('news::author.edit')

                                    {{-- Delete Button --}}
                                    <button class="btn btn-danger btn-sm" onclick="
                                                event.preventDefault();
                                                if (confirm('Are you sure you want to delete this Author?')) {
                                                    document.getElementById('delete{{ $value->id }}').submit();
                                                }
                                            ">
                                        <i class="fa fa-trash"></i>
                                    </button>

                                    {{-- Delete Form --}}
                                    <form id="delete{{ $value->id }}" action="{{ route('author.destroy', $value->id) }}" method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>

                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                        <tfoot>
                            <tr>
                                <th>S.N</th>
                                <th>Name</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Description</th>
                                <th class="text-center">Status</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </tfoot>

                    </table>
                </div>

            </div>

        </div>
    </section>

</div>
@endsection

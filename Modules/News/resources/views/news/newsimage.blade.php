@extends('setting::layouts.master')

@section('title', 'News Images')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item active">News Images</li>
</ol>
@endsection

@section('content')
<div class="content-wrapper">

    {{-- Page Header --}}
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>News Images</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active">News Images</li>
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
                    <h3>News Title: <strong>{{ $news->title }}</h3></strong>
                    <form action="{{ route('news.newsimages_store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name='news_id' value='{{ $news->id }}'>
                        <div class="form-group">
                            <label>Upload Images</label>
                            <input type="file" name="images[]" class="form-control-file border" multiple accept="image/*" required>
                            <small class="text-muted">You can select multiple images</small>
                        </div>

                        <button type="submit" class="btn btn-success">Upload</button>
                    </form>
                </div>

            </div>

        </div>

        {{-- Table Section --}}
        <div class=" card-body">

            <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>S.N</th>
                        <th class="text-center">Image</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach ($images as $value)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <img src="{{ asset('upload/images/News_Images/'.$value->image) }}" width="120" alt="Category Image">
                        </td>
                        <td>

                            {{-- Edit Button --}}
                            <a href="{{ route('news.newsimages_status', $value->id) }}" class="btn btn-sm btn-{{ $value->status == 'on' ? 'success' : 'danger' }}">
                                {{ ucfirst($value->status) }}
                            </a>

                            {{-- Delete Button --}}
                            <button class="btn btn-danger btn-sm" onclick="
                                                event.preventDefault();
                                                if (confirm('Are you sure you want to delete this News Image?')) {
                                                    document.getElementById('delete{{ $value->id }}').submit();
                                                }
                                            ">
                                <i class="fa fa-trash"></i>
                            </button>

                            {{-- Delete Form --}}
                            <form id="delete{{ $value->id }}" action="{{ route('news.newsimages_destroy', $value->id) }}" method="POST" class="d-none">
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
                        <th class="text-center">Image</th>
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

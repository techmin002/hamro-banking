@extends('setting::layouts.master')

@section('title', 'Create Advertisement')

@section('breadcrumb')
<ol class="breadcrumb border-0 m-0">
    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
    <li class="breadcrumb-item"><a href="{{ route('clients.index') }}">Advertisement</a></li>
    <li class="breadcrumb-item active">Add</li>
</ol>
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <form id="client-form" action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <!-- ================= CLIENT DETAILS CARD ================= -->
                    <div class="col-lg-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">Client Details</h5>
                            </div>
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Name</label>
                                            <input type="text" name="name" class="form-control" value="{{ old('name') }}">
                                            @error('name') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" name="email" class="form-control" value="{{ old('email') }}">
                                            @error('email') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Phone</label>
                                            <input type="number" name="phone" class="form-control" value="{{ old('phone') }}">
                                            @error('phone') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Alternate Phone</label>
                                            <input type="number" name="alternate_phone" class="form-control" value="{{ old('alternate_phone') }}">
                                            @error('alternate_phone') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Address</label>
                                            <textarea name="address" class="form-control summernote">{{ old('address') }}</textarea>
                                            @error('address') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- ================= COMPANY DETAILS CARD ================= -->
                    <div class="col-lg-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-info text-white">
                                <h5 class="card-title mb-0">Company Details</h5>
                            </div>
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Company Name</label>
                                            <input type="text" name="company_name" class="form-control" value="{{ old('company_name') }}">
                                            @error('company_name') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Company Email</label>
                                            <input type="email" name="company_email" class="form-control" value="{{ old('company_email') }}">
                                            @error('company_email') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Company Phone</label>
                                            <input type="number" name="company_phone" class="form-control" value="{{ old('company_phone') }}">
                                            @error('company_phone') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Company PAN</label>
                                            <input type="text" name="company_pan" class="form-control" value="{{ old('company_pan') }}">
                                            @error('company_pan') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Company Address</label>
                                            <textarea name="company_address" class="form-control summernote">{{ old('company_address') }}</textarea>
                                            @error('company_address') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Company Logo</label>
                                            <input type="file" name="company_logo" class="form-control-file border" accept="image/*" onchange="showPreview1(event)">
                                            @error('company_logo') <p class="text-danger">{{ $message }}</p> @enderror
                                            <div class="preview mt-2">
                                                <img src="" id="file-ip-1-preview" width="180px">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- ================= OWNER DETAILS CARD ================= -->
                    <div class="col-lg-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-warning text-dark">
                                <h5 class="card-title mb-0">Owner Details</h5>
                            </div>
                            <div class="card-body">

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Owner Name</label>
                                            <input type="text" name="owner_name" class="form-control" value="{{ old('owner_name') }}">
                                            @error('owner_name') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Owner Email</label>
                                            <input type="email" name="owner_email" class="form-control" value="{{ old('owner_email') }}">
                                            @error('owner_email') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Owner Phone</label>
                                            <input type="number" name="owner_phone" class="form-control" value="{{ old('owner_phone') }}">
                                            @error('owner_phone') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Owner Image</label>
                                            <input type="file" name="owner_image" class="form-control-file border" accept="image/*">
                                            @error('owner_image') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Owner Address</label>
                                            <textarea name="owner_address" class="form-control summernote">{{ old('owner_address') }}</textarea>
                                            @error('owner_address') <p class="text-danger">{{ $message }}</p> @enderror
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- ================= STATUS CARD ================= -->
                    <div class="col-lg-12 mb-4">
                        <div class="card shadow-sm">
                            <div class="card-header bg-secondary text-white">
                                <h5 class="card-title mb-0">Publish Status</h5>
                            </div>
                            <div class="card-body">

                                <input type="checkbox" name="status" checked data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                <label class="ml-2">Active</label>

                            </div>
                        </div>
                    </div>

                    <!-- SUBMIT BUTTON -->
                    <hr>


                </div>
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-primary">Create <i class="bi bi-check"></i></button>
                </div>
            </form>
        </div>
    </section>
</div>

@endsection
@section('script')

<!-- image preview -->
<script type="text/javascript">
    function showPreview1(event) {
        if (event.target.files.length > 0) {
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = document.getElementById("file-ip-1-preview");
            preview.src = src;
            preview.style.display = "block";
        }
    }

</script>
<script>
    $('textarea.summernote').summernote({
        placeholder: 'Enter  Company Description'
        , tabsize: 2
        , height: 250
        , toolbar: [
            ['style', ['style']]
            , ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']]
            , ['fontname', ['fontname']]
            , ['fontsize', ['fontsize']]
            , ['color', ['color']]
            , ['para', ['ul', 'ol', 'paragraph']]
            , ['height', ['height']]
            , ['table', ['table']]
            , ['insert', ['link', 'picture', 'hr']]
            , ['view', ['fullscreen', 'codeview']]
            , ['help', ['help']]
        ]
    , });

</script>
<script>
    $('.extra-fields-customer').click(function() {
        $('.customer_records').clone().appendTo('.customer_records_dynamic');
        $('.customer_records_dynamic .customer_records').addClass('single remove');
        $('.single .extra-fields-customer').remove();
        $('.single').append(
            '<a href="#" class="remove-field btn-remove-customer badge badge-danger">Remove Product</a>');
        $('.customer_records_dynamic > .single').attr("class", "remove");

        $('.customer_records_dynamic input').each(function() {
            var count = 0;
            var fieldname = $(this).attr("name");
            $(this).attr('name', fieldname + count);
            count++;
        });

    });

    $(document).on('click', '.remove-field', function(e) {
        $(this).parent('.remove').remove();
        e.preventDefault();
    });

</script>

@endsection

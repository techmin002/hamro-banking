<div class="modal fade" id="editNews{{ $value->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header justify-content-center bg-primary text-white">
                <h4 class="modal-title">Edit News</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form action="{{ route('news.update', $value->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input name="name" class="form-control" value="{{ $value->name }}" required>
                                </div>
                            </div>

                            {{-- <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="parents_id" class="form-control">
                                        <option value="" disabled>--Select Category--</option>

                                        @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{ $item->id == $value->parents_id ? 'selected' : '' }}>
                            {{ $item->name }}
                            </option>
                            @endforeach
                            </select>
                        </div>
                    </div> --}}
                </div>

                <div class="form-group">
                    <label>Image</label>
                    <input name="image" type="file" class="form-control-file border" accept="image/*">
                    <br>
                    @if ($value->image)
                    <img src="{{ asset('upload/images/News/'.$value->thumbnail) }}" width="120">
                    @endif
                </div>

                <div class="card card-secondary">
                    <div class="card-header">
                        <h3 class="card-title">Publish</h3>
                    </div>
                    <div class="card-body">
                        <input type="checkbox" name="status" {{ $value->status == 'on' ? 'checked' : '' }} data-bootstrap-switch data-on-color="success" data-off-color="danger">
                    </div>
                </div>

        </div>
    </div>

    <div class="modal-footer">
        <button class="btn btn-primary">Update</button>
    </div>

    </form>

</div>
</div>
</div>

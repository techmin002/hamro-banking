<div class="modal fade" data-backdrop="static" id="createAuthor" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header justify-content-center bg-primary text-white">
                <h4 class="modal-title">Create Author</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form action="{{ route('author.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="container">

                        <div class="form-group">
                            <label>Name</label>
                            <input name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Image</label>
                            <input type="file" class="form-control-file border" name="image" accept="image/*" required>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea name="description" id="" class="form-control summernote"></textarea>
                        </div>
                        <div class="card card-secondary">
                            <div class="card-header">
                                <h3 class="card-title">Publish</h3>
                            </div>
                            <div class="card-body">
                                <input type="checkbox" name="status" checked data-bootstrap-switch data-on-color="success" data-off-color="danger">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="modal-footer">
                    <button class="btn btn-primary">Save</button>
                    <button class="btn btn-danger" type="reset">Reset</button>
                </div>

            </form>

        </div>
    </div>
</div>

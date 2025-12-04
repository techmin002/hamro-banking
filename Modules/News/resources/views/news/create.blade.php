<div class="modal fade" data-backdrop="static" id="createNews" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header justify-content-center bg-primary text-white">
                <h4 class="modal-title">Create News</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="modal-body">
                    <div class="container">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="" disabled selected>--Select Category--</option>
                                        @foreach ($categories as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Types</label>
                                    <select name="types_id" class="form-control">
                                        <option value="" disabled selected>--Select Types--</option>
                                        @foreach ($types as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Author</label>
                                    <select name="author_id" class="form-control">
                                        <option value="" disabled selected>--Select Author--</option>
                                        @foreach ($authors as $item)
                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image (Thumbnail)</label>
                                    <input type="file" class="form-control-file border" name="thumbnail" accept="image/*" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tags (comma separated)</label>
                                    <input name="tags" class="form-control" placeholder="example: sports, cricket, news">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short_description" class="form-control summernote"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control summernote"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>News Section</label>
                                    <textarea name="news_section" class="form-control summernote"></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Schedule</label>
                                    <select name="schedule" class="form-control" id="scheduleSelect">
                                        <option value="no">No</option>
                                        <option value="yes">Yes</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group" id="scheduleTimeGroup" style="display: none;">
                                    <label>Schedule Date & Time</label>
                                    <input type="datetime-local" name="schedule_time" class="form-control">
                                </div>
                            </div>
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Publish</h3>
                                </div>
                                <div class="card-body">
                                    <input type="checkbox" name="status" checked data-bootstrap-switch data-on-color="success" data-off-color="danger">
                                </div>
                            </div>
                            <script>
                                document.getElementById('scheduleSelect').addEventListener('change', function() {
                                    document.getElementById('scheduleTimeGroup').style.display =
                                        this.value === 'yes' ? 'block' : 'none';
                                });

                            </script>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Save</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>

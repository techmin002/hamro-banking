<div class="modal fade" id="editNews{{ $value->id }}" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header justify-content-center bg-primary text-white">
                <h4 class="modal-title">Edit Type</h4>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>

            <form action="{{ route('news.update', $value->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            {{-- Title --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Title</label>
                                    <input name="title" class="form-control" value="{{ $value->title }}" required>
                                </div>
                            </div>

                            {{-- Category --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category</label>
                                    <select name="category_id" class="form-control">
                                        <option value="" disabled selected>--Select Category--</option>
                                        @foreach ($categories as $item)
                                        <option value="{{ $item->id }}" {{ $value->category_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Types --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Types</label>
                                    <select name="types_id" class="form-control">
                                        <option value="" disabled selected>--Select Types--</option>
                                        @foreach ($types as $item)
                                        <option value="{{ $item->id }}" {{ $value->types_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Author --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Author</label>
                                    <select name="author_id" class="form-control">
                                        <option value="" disabled selected>--Select Author--</option>
                                        @foreach ($authors as $item)
                                        <option value="{{ $item->id }}" {{ $value->author_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Thumbnail --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image (Thumbnail)</label>
                                    <input type="file" class="form-control-file border" name="thumbnail" accept="image/*">
                                    @if($value->thumbnail)
                                    <img src="{{ asset('upload/images/News/'.$value->thumbnail) }}" alt="Thumbnail" width="100" class="mt-2">
                                    @endif
                                </div>
                            </div>

                            {{-- Tags --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Tags (comma separated)</label>
                                    <input name="tags" class="form-control" value="{{ is_array(json_decode($value->tags)) ? implode(', ', json_decode($value->tags)) : '' }}" placeholder="example: sports, cricket, news">
                                </div>
                            </div>

                            {{-- Short Description --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Short Description</label>
                                    <textarea name="short_description" class="form-control summernote">{{ $value->short_description }}</textarea>
                                </div>
                            </div>

                            {{-- Description --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control summernote">{{ $value->description }}</textarea>
                                </div>
                            </div>

                            {{-- News Section --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>News Section</label>
                                    <textarea name="news_section" class="form-control summernote">{{ $value->news_section }}</textarea>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Schedule</label>
                                    <select name="schedule" class="form-control scheduleSelect">
                                        <option value="no" {{ $value->schedule == 'no' ? 'selected' : '' }}>No</option>
                                        <option value="yes" {{ $value->schedule == 'yes' ? 'selected' : '' }}>Yes</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group scheduleTimeGroup" style="display: {{ $value->schedule == 'yes' ? 'block' : 'none' }};">
                                    <label>Schedule Date & Time</label>
                                    <input type="datetime-local" name="schedule_time" class="form-control" value="{{ $value->schedule_time ? date('Y-m-d\TH:i', strtotime($value->schedule_time)) : '' }}">
                                </div>
                            </div>

                            <script>
                                // Apply for all rows if inside a loop
                                document.querySelectorAll('.scheduleSelect').forEach(function(select) {
                                    select.addEventListener('change', function() {
                                        let timeGroup = this.closest('.row').querySelector('.scheduleTimeGroup');
                                        timeGroup.style.display = this.value === 'yes' ? 'block' : 'none';
                                    });
                                });

                            </script>



                            {{-- Publish --}}
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Publish</h3>
                                </div>
                                <div class="card-body">
                                    <input type="checkbox" name="status" {{ $value->status == 'on' ? 'checked' : '' }} data-bootstrap-switch data-on-color="success" data-off-color="danger">
                                </div>
                            </div>

                            {{-- Script for schedule toggle --}}
                            <script>
                                document.getElementById('scheduleSelect').addEventListener('change', function() {
                                    document.getElementById('scheduleTimeGroup').style.display =
                                        this.value === 'yes' ? 'block' : 'none';
                                });

                            </script>


                        </div>
                    </div>

                    <div class="modal-footer">
                        <button class="btn btn-primary">Update</button>
                        <button class="btn btn-danger" type="reset">Reset</button>
                    </div>
                </div>
            </form>


        </div>
    </div>
</div>

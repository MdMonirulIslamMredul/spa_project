@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0"><i class="fas fa-edit me-1"></i> Edit Blog Post</h5>
                    <a href="{{ route('admin.setting.blogs') }}" class="btn btn-light btn-sm"><i class="fas fa-arrow-left me-1"></i> Back to Blog List</a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.setting.blogs.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="blogs_id" value="{{ $blogs->id }}">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Banner Title *</label>
                                    <input type="text" name="blog_ban_title" class="form-control"
                                        placeholder="Blog Banner Title*" value="{{ $blogs->blog_ban_title }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Title *</label>
                                    <input type="text" name="blog_title" class="form-control" placeholder="Blog Title*"
                                        value="{{ $blogs->blog_title }}" required>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Banner Image</label>
                                    @if($blogs->blog_ban_img)
                                        <div class="mb-2">
                                            <img src="{{ asset('backend_img/blogs/' . $blogs->blog_ban_img) }}"
                                                 alt="Current Banner" style="height: 70px; border-radius: 4px; border: 1px solid #dee2e6; object-fit: cover;">
                                            <small class="text-muted d-block">Current: {{ $blogs->blog_ban_img }}</small>
                                        </div>
                                    @endif
                                    <input type="file" name="blog_ban_img" class="form-control">
                                    <small class="text-muted">Leave empty to keep current banner</small>
                                </div>
                            </div>

                            <div class="col-md-12 mb-2">
                                <label class="form-label font-weight-bold">Blog Images</label>
                                <div class="row">
                                    <!-- Blog Card Image 1 (Main) -->
                                    <div class="col-md-3">
                                        <div class="border p-2 rounded bg-light mb-3">
                                            <label class="font-weight-bold small">Image 1 (Main Card)</label>
                                            @if($blogs->blog_img)
                                                <div class="mb-2">
                                                    <img src="{{ asset('backend_img/blogs/' . $blogs->blog_img) }}"
                                                         alt="Current Thumbnail" style="height: 70px; width: 100%; border-radius: 4px; border: 1px solid #dee2e6; object-fit: cover;">
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" name="remove_blog_img" value="1" id="remove_blog_img">
                                                        <label class="form-check-label text-danger small" for="remove_blog_img">Remove</label>
                                                    </div>
                                                </div>
                                            @endif
                                            <input type="file" name="blog_img" class="form-control form-control-sm">
                                            <small class="text-muted d-block mt-1">Replace image</small>
                                        </div>
                                    </div>

                                    <!-- Blog Image 2 -->
                                    <div class="col-md-3">
                                        <div class="border p-2 rounded bg-light mb-3">
                                            <label class="font-weight-bold small">Image 2</label>
                                            @if(!empty($blogs->blog_img_2))
                                                <div class="mb-2">
                                                    <img src="{{ asset('backend_img/blogs/' . $blogs->blog_img_2) }}"
                                                         alt="Blog Image 2" style="height: 70px; width: 100%; border-radius: 4px; border: 1px solid #dee2e6; object-fit: cover;">
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" name="remove_blog_img_2" value="1" id="remove_blog_img_2">
                                                        <label class="form-check-label text-danger small" for="remove_blog_img_2">Remove</label>
                                                    </div>
                                                </div>
                                            @endif
                                            <input type="file" name="blog_img_2" class="form-control form-control-sm">
                                            <small class="text-muted d-block mt-1">Upload or replace</small>
                                        </div>
                                    </div>

                                    <!-- Blog Image 3 -->
                                    <div class="col-md-3">
                                        <div class="border p-2 rounded bg-light mb-3">
                                            <label class="font-weight-bold small">Image 3</label>
                                            @if(!empty($blogs->blog_img_3))
                                                <div class="mb-2">
                                                    <img src="{{ asset('backend_img/blogs/' . $blogs->blog_img_3) }}"
                                                         alt="Blog Image 3" style="height: 70px; width: 100%; border-radius: 4px; border: 1px solid #dee2e6; object-fit: cover;">
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" name="remove_blog_img_3" value="1" id="remove_blog_img_3">
                                                        <label class="form-check-label text-danger small" for="remove_blog_img_3">Remove</label>
                                                    </div>
                                                </div>
                                            @endif
                                            <input type="file" name="blog_img_3" class="form-control form-control-sm">
                                            <small class="text-muted d-block mt-1">Upload or replace</small>
                                        </div>
                                    </div>

                                    <!-- Blog Image 4 -->
                                    <div class="col-md-3">
                                        <div class="border p-2 rounded bg-light mb-3">
                                            <label class="font-weight-bold small">Image 4</label>
                                            @if(!empty($blogs->blog_img_4))
                                                <div class="mb-2">
                                                    <img src="{{ asset('backend_img/blogs/' . $blogs->blog_img_4) }}"
                                                         alt="Blog Image 4" style="height: 70px; width: 100%; border-radius: 4px; border: 1px solid #dee2e6; object-fit: cover;">
                                                    <div class="form-check mt-1">
                                                        <input class="form-check-input" type="checkbox" name="remove_blog_img_4" value="1" id="remove_blog_img_4">
                                                        <label class="form-check-label text-danger small" for="remove_blog_img_4">Remove</label>
                                                    </div>
                                                </div>
                                            @endif
                                            <input type="file" name="blog_img_4" class="form-control form-control-sm">
                                            <small class="text-muted d-block mt-1">Upload or replace</small>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Short Description *</label>
                                    <input type="text" name="blog_sort" class="form-control" placeholder="Blog Short Description*"
                                        value="{{ $blogs->blog_sort }}" required>
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Status *</label>
                                    <select class="form-control" name="is_active">
                                        <option value="1" @if ($blogs->is_active == 1) selected @endif>Active</option>
                                        <option value="0" @if ($blogs->is_active == 0) selected @endif>Deactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Long Description *</label>
                                    <textarea name="blog_long" class="form-control" rows="8"
                                        placeholder="Blog Long Description*" required>{{ $blogs->blog_long }}</textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-1"></i> Update Blog</button>
                            <a href="{{ route('admin.setting.blogs') }}" class="btn btn-secondary px-3 ms-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

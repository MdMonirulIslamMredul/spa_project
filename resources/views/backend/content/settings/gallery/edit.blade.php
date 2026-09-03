@extends('backend.layouts.app')

@section('title', 'Edit Gallery')

@section('content')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-white"><i class="fas fa-edit me-2"></i> Edit Gallery (galleries table)</h5>
                    <a href="{{ route('admin.setting.gallery') }}" class="btn btn-sm btn-light">
                        <i class="fas fa-arrow-left me-1"></i> Back to Gallery
                    </a>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.setting.gallery.update') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" name="gallery_id" value="{{ $notice->id }}">
                        <input type="hidden" name="oldimage" value="{{ $notice->image }}">

                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">Title</label>
                            <input type="text" name="title" value="{{ $notice->title }}" class="form-control" placeholder="Gallery Title" required>
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label fw-bold">Current Image</label>
                            <div class="mb-2">
                                <img src="{{ asset('/setting/banner/' . $notice->image) }}" style="height: 100px; width: 140px; object-fit: cover; border-radius: 6px;">
                            </div>
                            <label class="form-label fw-bold">Change Image (Optional)</label>
                            <input type="file" name="image" class="form-control" accept="image/*">
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label fw-bold">Status</label>
                            <select class="form-control" name="is_active">
                                <option value="1" @if ($notice->is_active == 1) selected @endif>Active</option>
                                <option value="0" @if ($notice->is_active == 0) selected @endif>Inactive</option>
                            </select>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.setting.gallery') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update Gallery</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

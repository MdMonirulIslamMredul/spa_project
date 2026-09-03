@extends('backend.layouts.app')

@section('title', 'Gallery Settings')

@section('content')
    <div class="row">
        <!-- Create Gallery Item Card -->
        <div class="col-lg-12 mb-4">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 text-white"><i class="fas fa-images me-2"></i> Add Gallery Item (Galleries Table)</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('admin.setting.gallery.store') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Gallery Title</label>
                                    <input type="text" name="title" class="form-control" placeholder="Enter Title (e.g. Traditional Thai Massage)" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label fw-bold">Gallery Image</label>
                                    <input type="file" name="image" class="form-control" accept="image/*" required>
                                    <small class="text-muted">Recommended aspect ratio 4:3 (e.g. 800x600px)</small>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="fas fa-plus-circle me-1"></i> Save to Galleries
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Galleries List Card -->
        <div class="col-lg-12">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
                    <h5 class="mb-0 text-dark fw-bold"><i class="fas fa-list me-2 text-primary"></i> Galleries List (galleries table)</h5>
                    <span class="badge bg-primary rounded-pill">{{ count($multis) }} Items</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-hover align-middle" style="width:100%">
                            <thead class="table-light">
                                <tr>
                                    <th style="width: 60px;">#</th>
                                    <th style="width: 140px;">Image</th>
                                    <th>Title</th>
                                    <th style="width: 120px;">Status</th>
                                    <th style="width: 160px;">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($multis as $key => $multi)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>
                                            @if($multi->image && file_exists(public_path('setting/banner/' . $multi->image)))
                                                <img src="{{ asset('/setting/banner/' . $multi->image) }}" 
                                                     alt="{{ $multi->title }}" 
                                                     style="height: 70px; width: 100px; object-fit: cover; border-radius: 6px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                                            @else
                                                <img src="{{ asset('/setting/banner/' . $multi->image) }}" 
                                                     alt="{{ $multi->title }}" 
                                                     style="height: 70px; width: 100px; object-fit: cover; border-radius: 6px;"
                                                     onerror="this.src='{{ asset('frontend_assets/img/slider/slider-1.jpg') }}'">
                                            @endif
                                        </td>
                                        <td>
                                            <strong class="text-dark">{{ $multi->title ?? 'N/A' }}</strong>
                                        </td>
                                        <td>
                                            @if ($multi->is_active == 1)
                                                <span class="badge bg-success text-white px-2 py-1"><i class="fas fa-check-circle me-1"></i> Active</span>
                                            @else
                                                <span class="badge bg-danger text-white px-2 py-1"><i class="fas fa-times-circle me-1"></i> Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <button type="button" 
                                                    class="btn btn-sm btn-primary edit-gallery-btn" 
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editModal{{ $multi->id }}"
                                                    data-toggle="modal" 
                                                    data-target="#editModal{{ $multi->id }}">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <a href="{{ route('admin.setting.gallery.delete', $multi->id) }}" 
                                               class="btn btn-sm btn-danger"
                                               onclick="return confirm('Are you sure you want to delete this gallery item?')">
                                                <i class="fas fa-trash-alt"></i> Delete
                                            </a>
                                        </td>
                                    </tr>

                                    <!-- Edit Modal for Item {{ $multi->id }} -->
                                    <div class="modal fade" id="editModal{{ $multi->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $multi->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <form action="{{ route('admin.setting.gallery.update') }}" enctype="multipart/form-data" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="gallery_id" value="{{ $multi->id }}">
                                                    <input type="hidden" name="oldimage" value="{{ $multi->image }}">

                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel{{ $multi->id }}">Edit Gallery #{{ $multi->id }}</h5>
                                                        <button type="button" class="close btn-close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Title</label>
                                                            <input type="text" name="title" value="{{ $multi->title }}" class="form-control" required>
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Current Image</label>
                                                            <div class="mb-2">
                                                                <img src="{{ asset('/setting/banner/' . $multi->image) }}" style="height: 90px; width: 130px; object-fit: cover; border-radius: 6px;">
                                                            </div>
                                                            <label class="form-label fw-bold">Change Image (Optional)</label>
                                                            <input type="file" name="image" class="form-control" accept="image/*">
                                                        </div>

                                                        <div class="mb-3">
                                                            <label class="form-label fw-bold">Status</label>
                                                            <select class="form-control" name="is_active">
                                                                <option value="1" @if ($multi->is_active == 1) selected @endif>Active</option>
                                                                <option value="0" @if ($multi->is_active == 0) selected @endif>Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal" data-bs-dismiss="modal">Cancel</button>
                                                        <button type="submit" class="btn btn-primary"><i class="fas fa-save me-1"></i> Update Gallery</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center py-4 text-muted">
                                            <i class="fas fa-images fa-2x mb-2 d-block"></i>
                                            No gallery images found in galleries table. Use the form above to add some!
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

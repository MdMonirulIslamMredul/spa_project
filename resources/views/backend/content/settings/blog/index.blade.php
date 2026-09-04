@extends('backend.layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="card-title mb-0"><i class="fas fa-plus-circle me-1"></i> Add New Blog</h5>
                </div>
                <div class="card-body">
                    <form class="form-horizontal" action="{{ route('admin.setting.blogs.store') }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Banner Title *</label>
                                    <input type="text" name="blog_ban_title" class="form-control"
                                        placeholder="e.g. Ancient Healing & Body Alignment" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Banner Image *</label>
                                    <input type="file" name="blog_ban_img" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Title *</label>
                                    <input type="text" name="blog_title" class="form-control" placeholder="e.g. The Healing Powers of Traditional Thai Massage" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Card Image 1 (Main) *</label>
                                    <input type="file" name="blog_img" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Image 2</label>
                                    <input type="file" name="blog_img_2" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Image 3</label>
                                    <input type="file" name="blog_img_3" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Image 4</label>
                                    <input type="file" name="blog_img_4" class="form-control">
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Short Description *</label>
                                    <input type="text" name="blog_sort" class="form-control"
                                        placeholder="Brief overview of the article..." required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Status *</label>
                                    <select class="form-control" name="is_active">
                                        <option value="1" selected>Active</option>
                                        <option value="0">Deactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <label class="form-label font-weight-bold">Blog Long Description *</label>
                                    <textarea name="blog_long" class="form-control" rows="5"
                                        placeholder="Write detailed blog content here..." required></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="mt-2">
                            <button type="submit" class="btn btn-primary px-4"><i class="fas fa-save me-1"></i> Save Blog</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12 mt-4">
            <div class="card shadow-sm">
                <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0"><i class="fas fa-newspaper me-1"></i> All Blog Posts</h5>
                    <span class="badge badge-light text-dark">{{ count($blogsall) }} Blogs</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered table-striped table-hover align-middle" style="width:100%">
                            <thead class="thead-light">
                                <tr>
                                    <th style="width: 14%;">Banner Title</th>
                                    <th style="width: 10%;">Banner Image</th>
                                    <th style="width: 16%;">Blog Title</th>
                                    <th style="width: 14%;">Images</th>
                                    <th style="width: 18%;">Short Description</th>
                                    <th style="width: 14%;">Long Description</th>
                                    <th style="width: 7%; text-align: center;">Status</th>
                                    <th style="width: 7%; text-align: center;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($blogsall as $Blog)
                                    <tr>
                                        <td class="font-weight-bold">{{ $Blog->blog_ban_title ?? 'N/A' }}</td>
                                        <td>
                                            @if($Blog->blog_ban_img)
                                                <img style="width: 75px; height: 50px; object-fit: cover; border-radius: 4px; border: 1px solid #dee2e6;"
                                                    src="{{ asset('backend_img/blogs/' . $Blog->blog_ban_img) }}" alt="Banner">
                                            @else
                                                <span class="badge badge-secondary">No Banner</span>
                                            @endif
                                        </td>
                                        <td><strong>{{ $Blog->blog_title }}</strong></td>
                                        <td>
                                            <div style="display: flex; flex-wrap: wrap; gap: 4px; max-width: 120px;">
                                                @if($Blog->blog_img)
                                                    <img style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid #dee2e6;"
                                                        src="{{ asset('backend_img/blogs/' . $Blog->blog_img) }}" alt="Image 1" title="Image 1 (Main)">
                                                @endif
                                                @if(!empty($Blog->blog_img_2))
                                                    <img style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid #dee2e6;"
                                                        src="{{ asset('backend_img/blogs/' . $Blog->blog_img_2) }}" alt="Image 2" title="Image 2">
                                                @endif
                                                @if(!empty($Blog->blog_img_3))
                                                    <img style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid #dee2e6;"
                                                        src="{{ asset('backend_img/blogs/' . $Blog->blog_img_3) }}" alt="Image 3" title="Image 3">
                                                @endif
                                                @if(!empty($Blog->blog_img_4))
                                                    <img style="width: 45px; height: 45px; object-fit: cover; border-radius: 4px; border: 1px solid #dee2e6;"
                                                        src="{{ asset('backend_img/blogs/' . $Blog->blog_img_4) }}" alt="Image 4" title="Image 4">
                                                @endif
                                                @if(!$Blog->blog_img && empty($Blog->blog_img_2) && empty($Blog->blog_img_3) && empty($Blog->blog_img_4))
                                                    <span class="badge badge-secondary">No Image</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td><small class="text-secondary">{{ \Illuminate\Support\Str::limit($Blog->blog_sort, 65) }}</small></td>
                                        <td><small class="text-muted">{{ \Illuminate\Support\Str::limit(strip_tags($Blog->blog_long), 75) }}</small></td>
                                        <td class="text-center">
                                            @if ($Blog->is_active == 1)
                                                <span class="badge badge-success px-2 py-1">Active</span>
                                            @elseif($Blog->is_active == 0)
                                                <span class="badge badge-danger px-2 py-1">Deactive</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.setting.blogs.edit', $Blog->id) }}"
                                                class="btn btn-primary btn-sm px-3"><i class="fas fa-edit"></i> Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

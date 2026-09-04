@extends('backend.layouts.app')

@section('title', 'Mixed Settings')

@php
    $required = html()
        ->span('*')
        ->class('text-danger');
    $demoImg = 'img/backend/front-logo.png';
@endphp

@section('content')
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <style>
        .modal-confirm {
            color: #636363;
            width: 400px;
        }

        .modal-confirm .modal-content {
            padding: 20px;
            border-radius: 5px;
            border: none;
            text-align: center;
            font-size: 14px;
        }

        .modal-confirm .modal-header {
            border-bottom: none;
            position: relative;
        }

        .modal-confirm h4 {
            text-align: center;
            font-size: 26px;
            margin: 30px 0 -10px;
        }

        .modal-confirm .close {
            position: absolute;
            top: -5px;
            right: -2px;
        }

        .modal-confirm .modal-body {
            color: #999;
        }

        .modal-confirm .modal-footer {
            border: none;
            text-align: center;
            border-radius: 5px;
            font-size: 13px;
            padding: 10px 15px 25px;
        }

        .modal-confirm .modal-footer a {
            color: #999;
        }

        .modal-confirm .icon-box {
            width: 80px;
            height: 80px;
            margin: 0 auto;
            border-radius: 50%;
            z-index: 9;
            text-align: center;
            border: 3px solid #f15e5e;
        }

        .modal-confirm .icon-box i {
            color: #f15e5e;
            font-size: 46px;
            display: inline-block;
            margin-top: 13px;
        }

        .modal-confirm .btn,
        .modal-confirm .btn:active {
            color: #fff;
            border-radius: 4px;
            background: #60c7c1;
            text-decoration: none;
            transition: all 0.4s;
            line-height: normal;
            min-width: 120px;
            border: none;
            min-height: 40px;
            border-radius: 3px;
            margin: 0 5px;
        }

        .modal-confirm .btn-secondary {
            background: #c1c1c1;
        }

        .modal-confirm .btn-secondary:hover,
        .modal-confirm .btn-secondary:focus {
            background: #a8a8a8;
        }

        .modal-confirm .btn-danger {
            background: #f15e5e;
        }

        .modal-confirm .btn-danger:hover,
        .modal-confirm .btn-danger:focus {
            background: #ee3535;
        }

        .trigger-btn {
            display: inline-block;
            margin: 100px auto;
        }
    </style>
    @php
        $multis = DB::table('services')
            ->where('is_active', 1)
            ->orwhere('is_active', 0)
            ->get();
    @endphp
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4>Edit Service</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.setting.service.update') }}" enctype="multipart/form-data" method="POST">
                        @csrf
                        <input type="hidden" name="notice_id" value="{{ $notice->id ?? '' }}">

                        <div class="form-group">
                            <label>Banner Title</label>
                            <input type="text" name="ban_title" value="{{ $notice->ban_title ?? '' }}" class="form-control" placeholder="Banner Title">
                        </div>

                        <div class="form-group">
                            <label>Banner Image</label>
                            @if (!empty($notice->ban_img))
                                <div class="mb-2">
                                    <img src="{{ asset('setting/banner/' . $notice->ban_img) }}" alt="Banner" style="max-height: 80px; border-radius: 4px;">
                                </div>
                            @endif
                            <input type="file" name="ban_img" class="form-control">
                        </div>

                        <div class="form-group">
                            <label>Title</label>
                            <input type="text" name="title" value="{{ $notice->title ?? '' }}" class="form-control" placeholder="Title">
                        </div>

                        <div class="form-group">
                            <label>Description</label>
                            <textarea rows="3" name="description" class="form-control" placeholder="Description">{{ $notice->description ?? '' }}</textarea>
                        </div>

                        <div class="row">
                            <!-- Service Image 1 (Main) -->
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group border p-3 rounded bg-light">
                                    <label class="font-weight-bold">Service Image 1 (Main)</label>
                                    @if (!empty($notice->service_image))
                                        <div class="mb-2">
                                            <img src="{{ asset('setting/banner/' . $notice->service_image) }}" alt="Service Image 1" style="max-height: 90px; width: 100%; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;">
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="remove_image" value="1" id="remove_image">
                                            <label class="form-check-label text-danger small" for="remove_image">Remove Image</label>
                                        </div>
                                    @endif
                                    <input type="file" name="image" class="form-control">
                                    <input type="hidden" name="oldimage" value="{{ $notice->service_image ?? '' }}">
                                </div>
                            </div>

                            <!-- Service Image 2 -->
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group border p-3 rounded bg-light">
                                    <label class="font-weight-bold">Service Image 2</label>
                                    @if (!empty($notice->service_image_2))
                                        <div class="mb-2">
                                            <img src="{{ asset('setting/banner/' . $notice->service_image_2) }}" alt="Service Image 2" style="max-height: 90px; width: 100%; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;">
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="remove_image_2" value="1" id="remove_image_2">
                                            <label class="form-check-label text-danger small" for="remove_image_2">Remove Image</label>
                                        </div>
                                    @endif
                                    <input type="file" name="image_2" class="form-control">
                                    <input type="hidden" name="oldimage_2" value="{{ $notice->service_image_2 ?? '' }}">
                                </div>
                            </div>

                            <!-- Service Image 3 -->
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group border p-3 rounded bg-light">
                                    <label class="font-weight-bold">Service Image 3</label>
                                    @if (!empty($notice->service_image_3))
                                        <div class="mb-2">
                                            <img src="{{ asset('setting/banner/' . $notice->service_image_3) }}" alt="Service Image 3" style="max-height: 90px; width: 100%; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;">
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="remove_image_3" value="1" id="remove_image_3">
                                            <label class="form-check-label text-danger small" for="remove_image_3">Remove Image</label>
                                        </div>
                                    @endif
                                    <input type="file" name="image_3" class="form-control">
                                    <input type="hidden" name="oldimage_3" value="{{ $notice->service_image_3 ?? '' }}">
                                </div>
                            </div>

                            <!-- Service Image 4 -->
                            <div class="col-md-6 col-lg-3">
                                <div class="form-group border p-3 rounded bg-light">
                                    <label class="font-weight-bold">Service Image 4</label>
                                    @if (!empty($notice->service_image_4))
                                        <div class="mb-2">
                                            <img src="{{ asset('setting/banner/' . $notice->service_image_4) }}" alt="Service Image 4" style="max-height: 90px; width: 100%; object-fit: cover; border-radius: 4px; border: 1px solid #ccc;">
                                        </div>
                                        <div class="form-check mb-2">
                                            <input class="form-check-input" type="checkbox" name="remove_image_4" value="1" id="remove_image_4">
                                            <label class="form-check-label text-danger small" for="remove_image_4">Remove Image</label>
                                        </div>
                                    @endif
                                    <input type="file" name="image_4" class="form-control">
                                    <input type="hidden" name="oldimage_4" value="{{ $notice->service_image_4 ?? '' }}">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Service Title</label>
                            <input type="text" name="service_title" value="{{ $notice->service_title ?? $notice->title ?? '' }}" class="form-control" placeholder="Service Title">
                        </div>

                        <div class="form-group">
                            <label>Service Details</label>
                            <textarea name="service_details" rows="4" class="form-control" placeholder="Service Details">{{ $notice->service_details ?? '' }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Add to Homepage</label>
                            <select class="form-control" name="homepage">
                                <option value="1" @if (($notice->homepage ?? 0) == 1) selected @endif>Yes</option>
                                <option value="0" @if (($notice->homepage ?? 0) == 0) selected @endif>No</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Active/Deactive</label>
                            <select class="form-control" name="is_active">
                                <option value="1" @if (($notice->is_active ?? 1) == 1) selected @endif>Active</option>
                                <option value="0" @if (($notice->is_active ?? 1) == 0) selected @endif>Deactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-info">Update</button>
                    </form>
                </div>
            </div>
        </div>





    </div>


    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
    <script>
        tinymce.init({
            selector: 'textarea#default'
        });
    </script>


@endsection



@push('after-scripts')
    {{ script('assets/js/jscolor.js') }}
@endpush

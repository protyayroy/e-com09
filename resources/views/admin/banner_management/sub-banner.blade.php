@extends('admin.layouts.layout')

@section('title', '| Product Attribute Management')

<style>
    .btn {
        padding: 12px !important;
    }
</style>

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Sub-banner Image</h4>
                        @if (Session::has('success_msg'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong> {{ Session('success_msg') }}!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <div class="col-lg-6">
                            <form class="forms-sample  mt-5" method="post" action="{{ url('admin/banner-management/sub-banner/add-sub_banner') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <h4 class="card-title">Add Sub-banner Image: </h4>
                                <hr>
                                <div class="form-group">
                                    <div class="form-group">
                                        <label for="title">Sub-banner Title:</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                        @error('title')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="subBanner_image">Sub-banner Image:</label>
                                        <input type="file" class="form-control-file" id="subBanner_image"
                                            name="subBanner_image">

                                        @error('subBanner_image')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                </div>

                                <button class="btn btn-primary mt-3 w-100">
                                    Add Sub-banner Image
                                </button>
                                <!-- <button class="btn btn-light">Cancel</button>  -->
                            </form>

                        </div>
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <h4 class="card-title">Sub-banner Image list: </h4>
                                <hr>
                            </div>
                            @foreach ($subBanners as $item)
                                <div class="col-lg-6">
                                    <div class="card">
                                        <img class="card-img-top"
                                            src="{{ url('images/banner_image/sub_banner_img/' . $item->image) }}"
                                            alt="{{$item->image}}">
                                        <div class="card-body">
                                            <a href="{{ url('images/banner_image/sub_banner_img/' . $item->image) }}"
                                                class="btn btn-info" title="View Image">View</a>
                                            <a href="javascript:" class="btn btn-danger float-right delete_row"
                                                delete_id="{{ $item['id'] }}" delete_path="sub-banner"
                                                title="Delete Image"><i class="mdi mdi-delete-forever"
                                                    style="font-size: 20px"></i></a>
                                            <div class="clr"></div>
                                            <hr class="mb-2">
                                            <form action="{{ url('admin/banner-management/sub-banner/edit-sub_banner/' . $item['id']) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <label for="edit_slider_image">Change Sub-banner Image:</label>
                                                <input type="file" class="form-control-file" id="edit_slider_image"
                                                    name="edit_subBanner_image">
                                                <button class="btn btn-success mt-2 float-right" title="Update Image"><i
                                                        class="mdi mdi-refresh" style="font-size: 20px"></i></button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

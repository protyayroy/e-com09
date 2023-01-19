@extends('admin.layouts.layout')

@section('title', '| Product Attribute Management')

<style>
    .btn{
        padding: 12px !important;
    }
</style>

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product Gallary Image</h4>
                        @if (Session::has('success_msg'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong> {{ Session('success_msg') }}!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <a href="{{ url('admin/product') }}" class="btn btn-warning float-right  mb-4">Back</a>
                        <div class="clr"></div>
                        <table class="table table-bordered table-striped mb-5">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Category</th>
                                    <th>Product Brand</th>
                                </tr>
                            </thead>
                            <tr>
                                <td>{{ $products['product_name'] }}</td>
                                <td>{{ $products['category']['name'] }}</td>
                                <td>{{ $products['brand']['name'] }}</td>
                            </tr>
                        </table>

                        {{-- <div class="clearfix mt-3">
                            <button class="btn btn-success mb-2 float-right" id="add_gallary_img">Add
                                Product Gallary Image <small>(Optional)</small></button>
                            <div class="clr"></div>
                            <div id="gallary_img"></div>
                        </div> --}}
                        <form class="forms-sample  mt-5" method="post"
                            action="{{ url('admin/product/' . $products['id'] . '/add-product-gallary') }}"
                            enctype="multipart/form-data">
                            @csrf
                            <h4 class="card-title">Add Product Gallary Image: </h4>
                            <hr>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <input class="form-control" name="product_id" value="{{ $products['id'] }}" type="hidden">
                            <div class="form-group">

                                <label for="gallary_image">Product Gallary Image:</label>
                                <input type="file" class="form-control-file" id="gallary_image"
                                    name="product_gallery_image[]">
                                <div id="gallary_img" class="mt-4"></div>

                                <button class="btn btn-success mt-3 float-right" id="add_gallary_img">Add More
                                    <small>(Optional)</small></button>
                                <div class="clr"></div>

                                @error('product_gallery_image')
                                    <div class="text-danger">{{ $message }}*</div>
                                @enderror
                            </div>

                            <button class="btn btn-primary mt-5 w-100">
                                Add Gallary Image
                            </button>
                            <!-- <button class="btn btn-light">Cancel</button>  -->
                        </form>
                        <div class="row mt-5">
                            <div class="col-lg-12">
                                <h4 class="card-title">Product Gallary Image list: </h4>
                                <hr>
                            </div>
                            @foreach ($gallary as $item)
                                <div class="col-lg-4">
                                    <div class="card">
                                        <img class="card-img-top"
                                            src="{{ url('images/product_image/large_img/' . $item->image) }}"
                                            alt="Card image cap">
                                        <div class="card-body">
                                            <a href="{{ url('images/product_image/large_img/' . $item->image) }}"
                                                class="btn btn-info" title="View Image">View</a>
                                            <a href="javascript:" class="btn btn-danger float-right delete_row"
                                                delete_id="{{ $item['id'] }}" delete_path="product-gallary"
                                                title="Delete Image"><i class="mdi mdi-delete-forever"
                                                    style="font-size: 20px"></i></a>
                                            <div class="clr"></div>
                                            <hr class="mb-2">
                                            <form action="{{ url('admin/edit-product-gallary/' . $item['id']) }}"
                                                method="post" enctype="multipart/form-data">
                                                @csrf
                                                <label for="gal_image">Change Gallary Image:</label>
                                                <input type="file" class="form-control-file" id="gal_image"
                                                    name="edit_product_gallery_image">
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

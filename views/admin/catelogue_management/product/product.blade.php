@extends('admin.layouts.layout')

@section('title', '| Product Management')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product</h4>
                        @if (Session::has('success_msg'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong> {{ Session('success_msg') }}!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <a href="{{ url('admin/add-edit-product') }}" class="btn btn-success block float-right mb-4">Add
                            Product</a>
                        <div class="clr"></div>
                        <div class="table-responsive">
                            <table id="bootstrap_datatable" class="table table-striped table-bordered nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th> #Id </th>
                                        <th> Name: </th>
                                        <th> Code: </th>
                                        <th> Price: </th>
                                        <th> Discount: </th>
                                        <th> Section: </th>
                                        <th> Category: </th>
                                        <th> Brand: </th>
                                        <th> Image: </th>
                                        <th> Status: </th>
                                        <th> Action: </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr>
                                            <td> {{ $loop->index + 1 }} </td>
                                            <td> {{ $product['product_name'] }} </td>
                                            <td> {{ $product['product_code'] }} </td>
                                            <td> {{ $product['product_price'] }} </td>
                                            <td> {{ $product['product_discount'] }}% </td>
                                            <td> {{ $product['section']['name'] }} </td>
                                            <td> {{ $product['category']['name'] }} </td>
                                            <td> {{ $product['brand']['name'] }} </td>
                                            <td>
                                                @if (isset($product['product_image']) && !empty($product['product_image']))
                                                    <a
                                                        href="{{ url('images/product_image/' . $product['product_image']) }}">
                                                        <img src="{{ url('images/product_image/' . $product['product_image']) }}"
                                                            alt="">
                                                    </a>
                                                @else
                                                    <a href="{{ url('images/dummy_img/no_img.png') }}" target="_blannk">
                                                        <img src="{{ url('images/dummy_img/no_img.png') }}" alt="No Image">
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="status_collum">
                                                @if ($product['status'] == 1)
                                                    <a href="javascript:void(0)" class="change_status text-primary"
                                                        id="product-{{ $product['id'] }}" status_id="{{ $product['id'] }}"
                                                        status_path="product">
                                                        <i class="mdi mdi-checkbox-marked-circle" status="Active"  title="Inactive Product"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" class="change_status text-primary"
                                                        id="product-{{ $product['id'] }}" status_id="{{ $product['id'] }}"
                                                        status_path="product">
                                                        <i class="mdi mdi-checkbox-blank-circle-outline"
                                                            status="Inactive" title="Active Product"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="action_collum">
                                                <a href="{{ url('admin/product-attr/' . $product['id']) }}" class="text-success">
                                                    <i class="mdi mdi-plus-circle" title="See Product Attribute"></i>
                                                </a>
                                                <a href="{{ url('admin/add-edit-product/' . $product['id']) }}" class="text-info">
                                                    <i class="mdi mdi-table-edit" title="Edit Product"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="delete_row text-danger"
                                                    delete_id="{{ $product['id'] }}" delete_path="product">
                                                    <i class="mdi mdi-delete-forever" title="Delete Product"></i>
                                                </a>
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
    </div>

@endsection

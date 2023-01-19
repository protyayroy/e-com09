@extends('admin.layouts.layout')

@section('title', '| Product Attribute Management')

<style>
    .my_btn {
        height: 40px;
        padding: 9px !important;
        margin: 0;
        margin-top: 30px
    }

    .my_btn i {
        line-height: 20px;
    }
</style>
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product Attribute</h4>
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
                        {{-- <div class="table-responsive">
                            <table id="bootstrap_datatable" class="table table-striped table-bordered nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th> #Id </th>
                                        <th> Product Name: </th>
                                        <th> Size: </th>
                                        <th> Price: </th>
                                        <th> Stock: </th>
                                        <th> Stock Limit Alert: </th>
                                        <th> Status: </th>
                                        <th> Action: </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($productAttributes as $productAttr)
                                        <tr>
                                            <td> {{ $loop->index + 1 }} </td>
                                            <td> {{ $products['product_name'] }} </td>
                                            <td> {{ $productAttr['size'] }} </td>
                                            <td> {{ $productAttr['price'] }} </td>
                                            <td> {{ $productAttr['stock'] }} </td>
                                            <td> {{ $productAttr['stock_limit_alert'] }} </td>
                                            <td class="status_collum">
                                                @if ($productAttr['status'] == 1)
                                                    <a href="javascript:void(0)" class="change_status text-primary"
                                                        id="productAttribute-{{ $productAttr['id'] }}"
                                                        status_id="{{ $productAttr['id'] }}" status_path="productAttribute">
                                                        <i class="mdi mdi-checkbox-marked-circle" status="Active" title="Deactive Attribute"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" class="change_status text-primary"
                                                        id="productAttribute-{{ $productAttr['id'] }}"
                                                        status_id="{{ $productAttr['id'] }}"
                                                        status_path="productAttribute">
                                                        <i class="mdi mdi-checkbox-blank-circle-outline"
                                                            status="Inactive" title="Active Attribute"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="action_collum">
                                                <a href="{{ url('admin/product-attr/' . $products['id'] . '/edit-product-attr/' . $productAttr['id']) }}"
                                                    class="text-info">
                                                    <i class="mdi mdi-table-edit" title="Update Attribute"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="delete_attr_row text-danger"
                                                    delete_id="{{ $productAttr['id'] }}"
                                                    delete_path="{{ $products['id'] }}/delete-productAttribute">
                                                    <i class="mdi mdi-delete-forever" title="Delete Attribute"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> --}}

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

                        <form class="forms-sample  mt-5"
                            action="{{ url('admin/product/' . $products['id'] . '/add-product-attr') }}" method="post">
                            @csrf
                            <h4 class="card-title">Add Product Attribute: </h4>
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
                                <label for="size">Product Attribute: <small>(Optional)</small></label>
                                <div class="d-flex mb-2">
                                    <input type="text" class="form-control mr-1" id="size" name="size[]"
                                        placeholder="Size">
                                    <input type="text" class="form-control mr-1" name="price[]" placeholder="Price">
                                    <input type="text" class="form-control mr-1" name="stock[]" placeholder="Stock">
                                    <input type="text" class="form-control mr-1" name="stock_limit_alert[]"
                                        placeholder="Stock Limit Alert">
                                    <button class="btn btn-success" id="add_attribute">Add</button>
                                </div>
                                <div id="attr_field"></div>

                                @error('size')
                                    <div class="text-danger">{{ $message }}*</div>
                                @enderror
                                @error('price')
                                    <div class="text-danger">{{ $message }}*</div>
                                @enderror
                                @error('price')
                                    <div class="text-danger">{{ $message }}*</div>
                                @enderror
                                @error('alert_stock')
                                    <div class="text-danger">{{ $message }}*</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary mt-3 w-100">
                                Add Attribute
                            </button>
                            <!-- <button class="btn btn-light">Cancel</button>  -->
                        </form>
                        <div style="border: 1px solid rgba(0, 0, 0, 0.1); padding:10px;margin-top:3rem">
                            <h4 class="card-title">Product Attribute list: </h4>
                            <hr>

                            @foreach ($productAttributes as $productAttr)
                                <form class="d-flex" action="{{ url('admin/edit-product-attr/' . $productAttr['id']) }}"
                                    method="post">
                                    @csrf
                                    <div class="form-group mr-1">
                                        <label for="edit_size">Size:</label>
                                        <input type="text" class="form-control mr-1" id="edit_size" name="edit_size"
                                            value="{{ $productAttr['size'] }}">
                                    </div>
                                    <div class="form-group mr-1">
                                        <label for="edit_price">Price:</label>
                                        <input type="text" class="form-control mr-1" id="edit_price" name="edit_price"
                                            value="{{ $productAttr['price'] }}">
                                    </div>
                                    <div class="form-group mr-1">
                                        <label for="edit_stock">Stock:</label>
                                        <input type="text" class="form-control mr-1" id="edit_stock" name="edit_stock"
                                            value="{{ $productAttr['stock'] }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="edit_stock_limit_alert">Stock Limit Alert:</label>
                                        <input type="text" class="form-control mr-1" id="edit_stock_limit_alert"
                                            name="edit_stock_limit_alert" value="{{ $productAttr['stock_limit_alert'] }}">
                                    </div>
                                    <button class="btn btn-info my_btn mr-1 ml-2" title="Update Attribute">
                                        <i class="mdi mdi-refresh" style="font-size: 20px"></i>
                                    </button>
                                    <a href="javascript:" class="btn btn-danger my_btn delete_row"
                                        delete_id="{{ $productAttr['id'] }}" delete_path="product-attr"
                                        title="Delete Attribute">
                                        <i class="mdi mdi-delete-forever" style="font-size: 20px"></i>
                                    </a>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

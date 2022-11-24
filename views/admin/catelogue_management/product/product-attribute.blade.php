@extends('admin.layouts.layout')

@section('title', '| Product Attribute Management')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-10 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Product Attribute</h4>
                        @if (Session::has('success_msg_attr'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong> {{ Session('success_msg_attr') }}!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <a href="{{ url('admin/product') }}" class="btn btn-warning float-right  mb-4">Back</a>
                        <div class="clr"></div>
                        <div class="table-responsive">
                            <table id="bootstrap_datatable" class="table table-striped table-bordered nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th> #Id </th>
                                        <th> Product Name: </th>
                                        <th> Sku: </th>
                                        <th> Size: </th>
                                        <th> Price: </th>
                                        <th> Stock: </th>
                                        <th> Status: </th>
                                        <th> Action: </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($productAttributes as $productAttr)
                                        <tr>
                                            <td> {{ $loop->index + 1 }} </td>
                                            <td> {{ $products['product_name'] }} </td>
                                            <td> {{ $productAttr['sku'] }} </td>
                                            <td> {{ $productAttr['size'] }} </td>
                                            <td> {{ $productAttr['price'] }} </td>
                                            <td> {{ $productAttr['stock'] }} </td>
                                            <td class="status_collum">
                                                @if ($productAttr['status'] == 1)
                                                    <a href="javascript:void(0)" class="change_status text-primary"
                                                        id="productAttribute-{{ $productAttr['id'] }}"
                                                        status_id="{{ $productAttr['id'] }}" status_path="productAttribute">
                                                        <i class="mdi mdi-checkbox-marked-circle" status="Active"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" class="change_status text-primary"
                                                        id="productAttribute-{{ $productAttr['id'] }}"
                                                        status_id="{{ $productAttr['id'] }}"
                                                        status_path="productAttribute">
                                                        <i class="mdi mdi-checkbox-blank-circle-outline"
                                                            status="Inactive"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="action_collum">
                                                <a href="{{ url('admin/product-attr/'.$products['id'] .'/edit-product-attr/' . $productAttr['id']) }}"
                                                    class="text-info">
                                                    <i class="mdi mdi-table-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="delete_attr_row text-danger"
                                                    delete_id="{{ $productAttr['id'] }}"
                                                    delete_path="{{ $products['id'] }}/delete-productAttribute">
                                                    <i class="mdi mdi-delete-forever"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <form class="forms-sample  mt-5" action="{{ url('admin/add-product-attr') }}" method="post">
                            <h4 class="card-title">Add Product Attribute</h4>
                            <hr>
                            @csrf
                            <input class="form-control" name="product_id" value="{{ $products['id'] }}" type="hidden">
                            <div class="form-group">
                                <label for="name">Product Name:</label>
                                <input class="form-control" id="name" value="{{ $products['product_name'] }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Product Category:</label>
                                <input class="form-control" id="name" value="{{ $products['category']['name'] }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Product Category:</label>
                                <input class="form-control" id="name" value="{{ $products['brand']['name'] }}"
                                    readonly>
                            </div>
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="field_wrapper">
                                <div>
                                    <input style="width: 20%" type="text" name="sku[]" placeholder="Sku"
                                        class="form-control" />
                                    <input style="width: 20%" type="text" name="size[]" placeholder="Size"
                                        class="form-control" />
                                    <input style="width: 20%" type="text" name="price[]" placeholder="Price"
                                        class="form-control" />
                                    <input style="width: 20%" type="text" name="stock[]" placeholder="Stock"
                                        class="form-control" />
                                    <a href="javascript:void(0);" class="add_button" title="Add field">Add More</a>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mt-5 w-100">
                                Add Attribute
                            </button>
                            <!-- <button class="btn btn-light">Cancel</button>  -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

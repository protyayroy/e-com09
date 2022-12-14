@extends('admin.layouts.layout')

@section('title', '| Product Attribute Management')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-8 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Add Attribute</h4>
                        @if (Session::has('success_msg'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong> {{ Session('success_msg') }}!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <a href="{{ url('admin/product-attr/'.$products['id']) }}" class="btn btn-warning block float-right mb-4">Back</a>
                        <div class="clr"></div>
                        <form class="forms-sample" action="" method="post">
                            @csrf
                            {{-- @method('put') --}}
                            <div class="form-group">
                                <label for="name">Product Name:</label>
                                <input class="form-control" value="{{ $products['product_name'] }}" readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Product Category:</label>
                                <input class="form-control" value="{{ $products['category']['name'] }}"
                                    readonly>
                            </div>
                            <div class="form-group">
                                <label for="name">Product Category:</label>
                                <input class="form-control" value="{{ $products['brand']['name'] }}"
                                    readonly>
                            </div>
                            <div class="field_wrapper">
                                <div>
                                    <input type="text" class="form-control" name="sku" value="{{ $productAttributes['sku'] }}"/>
                                    <input type="text" class="form-control" name="size" value="{{ $productAttributes['size'] }}"/>
                                    <input type="text" class="form-control" name="price" value="{{ $productAttributes['price'] }}"/>
                                    <input type="text" class="form-control" name="stock" value="{{ $productAttributes['stock'] }}"/>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary w-100 mt-4">
                                    Update Product Attribute
                            </button>
                            <!-- <button class="btn btn-light">Cancel</button>  -->
                        </form>
                        {{-- <div class="table-responsive mt-5">
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
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($productAttributes as $productAttr)
                                        <tr>
                                            <td> {{ $loop->index + 1 }} </td>
                                            <td> {{ $productAttr['sku'] }} </td>
                                            <td> {{ $productAttr['sku'] }} </td>
                                            <td>
                                                @if ($productAttr['size'] == 0)
                                                    Root
                                                @else
                                                    {{ $productAttr['price'] }}
                                                @endif
                                            </td>
                                            <td> {{ $productAttr['stock'] }} </td>
                                            <td class="status_collum">
                                                @if ($productAttr['status'] == 1)
                                                    <a href="javascript:void(0)" class="change_status text-primary"
                                                        id="category-{{ $productAttr['id'] }}"
                                                        status_id="{{ $productAttr['id'] }}" status_path="category">
                                                        <i class="mdi mdi-checkbox-marked-circle" status="Active"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" class="change_status text-primary"
                                                        id="category-{{ $productAttr['id'] }}"
                                                        status_id="{{ $productAttr['id'] }}" status_path="category">
                                                        <i class="mdi mdi-checkbox-blank-circle-outline"
                                                            status="Inactive"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="action_collum">
                                                <a href="{{ url('admin/add-edit-category/' . $productAttr['id']) }}"
                                                    class="text-info">
                                                    <i class="mdi mdi-table-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="delete_row text-danger"
                                                    delete_id="{{ $productAttr['id'] }}" delete_path="category">
                                                    <i class="mdi mdi-delete-forever"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@php
    use App\Models\Products_filter;

    $productFilters = Products_filter::productFilters();
    // var_dump($proFilterCatIds)  ;
@endphp

@extends('admin.layouts.layout')


<style>
    .sectionType {
        font-weight: 800;
        color: rgb(15, 16, 15)
    }

    .categoryType {
        font-weight: 600;
        color: rgb(56, 85, 61)
    }
</style>

@section('title', '| Product Management')

{{-- @section('active_class')
    active
    $active = 'active';
@endsection --}}

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        <a href="{{ url('admin/product') }}" class="btn btn-warning float-right">Back</a>
                        <div class="clr"></div>

                        @if (Session::has('error_msg'))
                            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                <strong>Error:</strong> {{ Session('error_msg') }}!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <form class="forms-sample"
                            action="{{ isset($products['id']) && !empty($products['id']) ? url('admin/add-edit-product/' . $products['id']) : url('admin/add-edit-product') }}"
                            method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="product_name">Product Name:</label>
                                        <input type="text" class="form-control" id="product_name" name="product_name"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['product_name'] : old('product_name') }}">
                                        @error('product_name')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="section_id">Product Category:</label>
                                        <select name="section_id" id="section_id" class="form-control">
                                            <option disabled selected> Select Product Category</option>
                                            @foreach ($getSection as $sectionType)
                                                <option value="{{ $sectionType['id'] }}" class="sectionType" disabled>
                                                    {{ $sectionType['name'] }}
                                                    @foreach ($sectionType['sectioncategory'] as $categoryType)
                                                <option value="{{ $categoryType['id'] }}"
                                                    {{ isset($products['category_id']) && $products['category_id'] == $categoryType['id'] ? 'selected' : '' }}
                                                    class="categoryType">
                                                    &nbsp;&nbsp;&raquo; {{ $categoryType['name'] }}
                                                    @foreach ($categoryType['subcategory'] as $subCategoryType)
                                                <option value="{{ $subCategoryType['id'] }}"
                                                    {{ isset($products['category_id']) && $products['category_id'] == $subCategoryType['id'] ? 'selected' : '' }}>
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-&raquo; {{ $subCategoryType['name'] }}
                                                </option>
                                            @endforeach
                                            </option>
                                            @endforeach
                                            </option>
                                            @endforeach
                                        </select>
                                        @error('section_id')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div id="select_filter">
                                        @include('admin.catelogue_management.product.select_filter')
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_id">Product Brand:</label>
                                        <select name="brand_id" id="brand_id" class="form-control">
                                            <option disabled selected> Select Product Brand</option>
                                            @foreach ($getBrand as $brand)
                                                <option value="{{ $brand['id'] }}"
                                                    {{ isset($products['brand_id']) && $products['brand_id'] == $brand['id'] ? 'selected' : '' }}>
                                                    {{ ucfirst($brand['name']) }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('brand_id')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_code">Product Code:</label>
                                        <input type="text" class="form-control" id="product_code" name="product_code"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['product_code'] : old('product_code') }}">
                                        @error('product_code')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_group_code">Product Group Code:</label>
                                        <input type="text" class="form-control" id="product_group_code" name="product_group_code"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['product_group_code'] : old('product_group_code') }}">
                                        @error('product_group_code')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_price">Product Main Price:</label>
                                        <input type="text" class="form-control" id="product_price"
                                            name="product_price"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['product_price'] : old('product_price') }}">
                                        @error('product_price')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_discount">Product Discount:</label>
                                        <input type="text" class="form-control" id="product_discount"
                                            name="product_discount"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['product_discount'] : old('product_discount') }}">
                                        @error('product_discount')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title:</label>
                                        <input type="text" class="form-control" id="meta_title" name="meta_title"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['meta_title'] : old('meta_title') }}">
                                        @error('meta_title')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="product_weight">Product Weight:</label>
                                        <input type="text" class="form-control" id="product_weight" name="product_weight"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['product_weight'] : old('product_weight') }}">
                                        @error('product_weight')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords:</label>
                                        <input type="text" class="form-control" id="meta_keywords" name="meta_keywords"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['meta_keywords'] : old('meta_keywords') }}">
                                        @error('meta_keywords')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_color">Product Color:</label>
                                        <input type="text" class="form-control" id="product_color" name="product_color"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['product_color'] : old('product_color') }}">
                                        @error('product_color')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="stock">Product Stock:</label>
                                        <input type="text" class="form-control" id="stock"
                                            name="stock"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['stock'] : old('stock') }}">
                                        @error('stock')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="stock_limit_alert">Product Stock Limit Alert:</label>
                                        <input type="text" class="form-control" id="stock_limit_alert"
                                            name="stock_limit_alert"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['stock_limit_alert'] : old('stock_limit_alert') }}">
                                        @error('stock_limit_alert')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description:</label>
                                        <input type="text" class="form-control" id="meta_description"
                                            name="meta_description"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['meta_description'] : old('meta_description') }}">
                                        @error('meta_description')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_description">Product Description:</label>

                                        {{-- <textarea name="product_description"  class="form-control"id="product_description">
                                            {{ isset($products['id']) && !empty($products['id']) ? $products['product_description'] : '' }}
                                        </textarea> --}}
                                        <input type="text" class="form-control" id="product_description"
                                            name="product_description"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['product_description'] : old('product_description') }}">
                                        @error('product_description')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="product_image">Product Thumble Image:</label>
                                        <input type="file" class="form-control-file" id="product_image"
                                            name="product_image" style="width: 100%">
                                        @error('product_image')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mt-5">
                                        <label for="product_video">Product Video: <small>(Optional)</small></label>
                                        <input type="file" class="form-control-file" id="product_video"
                                            name="product_video">
                                        @error('product_video')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <button type="submit" class="btn btn-primary mr-2 w-100" id="Add_p">
                                        @if ($title == 'Add Product')
                                            Add Product
                                        @else
                                            Update Product
                                        @endif
                                    </button>
                                </div>
                            </div>
                            <!-- <button class="btn btn-light">Cancel</button>  -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            var maxField = 10; //Input fields increment limitation
            var addButton = $('.add_button'); //Add button selector
            var wrapper = $('.field_wrapper'); //Input field wrapper
            var fieldHTML =
                '<div><input type="text" name="field_name[]" value=""/><a href="javascript:void(0);" class="remove_button"><img src="remove-icon.png"/></a></div>'; //New input field html
            var x = 1; //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function() {
                //Check maximum number of input fields
                if (x < maxField) {
                    x++; //Increment field counter
                    $(wrapper).append(fieldHTML); //Add field html
                }
            });

            //Once remove button is clicked
            $(wrapper).on('click', '.remove_button', function(e) {
                e.preventDefault();
                $(this).parent('div').remove(); //Remove field html
                x--; //Decrement field counter
            });
        });
    </script> --}}

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            alert();
            function get_value(class_name) {
                var value = [];
                $("." + class_name).each(function() {

                    filter.push($(this).val());

                });
                return value;
            }

            var color = get_value('color');
            var size = get_value('size');
            $.ajax({
                url: 'admin/add-edit-product',
                type : "post",
                data : {
                    color:color,
                    size:size
                },
                success: function(data){
                    alert(data);
                }, error: function(data){
                    alert("Error");
                }
            })
        })
    </script> --}}

@endsection

@php
    use App\Models\Products_filter;

    $productFilters = Products_filter::productFilters();
    // var_dump($proFilterCatIds)  ;
@endphp

@extends('admin.layouts.layout')

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
                                    <div class="form-group">
                                        <label for="section_id">Product Category:</label>
                                        <select name="section_id" id="section_id" class="form-control">
                                            <option disabled selected> Select Product Category</option>
                                            @foreach ($getSection as $sectionType)
                                                <option value="{{ $sectionType['id'] }}"
                                                    {{ isset($products['category_id']) && $products['category_id'] == $sectionType['id'] ? 'selected' : '' }}
                                                    class="sectionType" disabled>
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
                                        @include("admin.catelogue_management.product.select_filter")
                                    </div>
                                    <div class="form-group">
                                        <label for="brand_id">Product Brand:</label>
                                        <select name="brand_id" id="brand_id" class="form-control">
                                            <option disabled selected> Select Product Brand</option>
                                            @foreach ($getBrand as $brand)
                                                <option value="{{ $brand['id'] }}"
                                                    {{ isset($products['brand_id']) && $products['brand_id'] == $brand['id'] ? 'selected' : '' }}>
                                                    {{ $brand['name'] }}
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
                                        <label for="product_color">Product Color:</label>
                                        <input type="text" class="form-control" id="product_color" name="product_color"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['product_color'] : old('product_color') }}">
                                        @error('product_color')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_price">Product Price:</label>
                                        <input type="text" class="form-control" id="product_price" name="product_price"
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
                                        <label for="product_description">Product Description:</label>
                                        <input type="text" class="form-control" id="product_description"
                                            name="product_description"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['product_description'] : old('product_description') }}">
                                        @error('product_description')
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
                                        <label for="meta_keywords">Meta Keywords:</label>
                                        <input type="text" class="form-control" id="meta_keywords"
                                            name="meta_keywords"
                                            value="{{ isset($products['id']) && !empty($products['id']) ? $products['meta_keywords'] : old('meta_keywords') }}">
                                        @error('meta_keywords')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_image">Product Image:</label>
                                        <input type="file" class="form-control" id="product_image"
                                            name="product_image">
                                        @error('product_image')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="product_video">Product Video:</label>
                                        <input type="file" class="form-control" id="product_video"
                                            name="product_video">
                                        @error('product_video')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary mr-2 w-100">
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

@endsection

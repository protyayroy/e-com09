@extends('customer.layouts.layout')

@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Shop</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="listing.html">Shop</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Shop-Page -->
    <div class="page-shop u-s-p-t-80">
        <div class="container">
            <!-- Shop-Intro -->
            <div class="shop-intro">
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <a href="index.html">Home</a>
                    </li>
                    <li class="has-separator">
                        <a href="shop-v1-root-category.html">Men Clothing </a>
                    </li>
                    <li class="is-marked">
                        <a href="listing.html">T-Shirts</a>
                    </li>
                </ul>
            </div>
            <!-- Shop-Intro /- -->
            <div class="row">
                <!-- Shop-Left-Side-Bar-Wrapper -->
                @include('customer.listing-product.sidebar')
                <!-- Shop-Left-Side-Bar-Wrapper /- -->
                <!-- Shop-Right-Wrapper -->
                <div class="col-lg-9 col-md-9 col-sm-12">
                    <!-- Page-Bar -->
                    <div class="page-bar clearfix">
                        <div class="shop-settings">
                            <a id="list-anchor">
                                <i class="fas fa-th-list"></i>
                            </a>
                            <a id="grid-anchor" class="active">
                                <i class="fas fa-th"></i>
                            </a>
                        </div>
                        <!-- Toolbar Sorter 1  -->
                        <form name="sort-list" id="sort-list">
                            <div class="toolbar-sorter">
                                <div class="select-box-wrapper">
                                    <input type="hidden" name="url" id="url" value="{{ $url }}">
                                    <label class="sr-only" for="sort">Sort By</label>
                                    <select class="select-box" id="sort" name="sort">
                                        {{-- <option selected="selected" value="">Sort By: Best Selling</option> --}}
                                        <option selected="selected" value="" disabled>Select Your Filter</option>
                                        <option value="letest">Sort By: Latest Product</option>
                                        <option value="lowest_price">Sort By: Lowest Price</option>
                                        <option value="highest_price">Sort By: Highest Price</option>
                                        <option value="a-z">Sort By: Product Name A-Z</option>
                                        <option value="z-a">Sort By: Product Name Z-A</option>
                                    </select>
                                </div>
                            </div>
                        </form>
                        <!-- //end Toolbar Sorter 1  -->
                        <!-- Toolbar Sorter 2  -->
                        <div class="toolbar-sorter-2">
                            <div class="select-box-wrapper">
                                <label class="sr-only" for="show-records">Show Records Per Page</label>
                                <select class="select-box" id="show-records">
                                    <option selected="selected" value="">Show:
                                        {{ $products->count() }}
                                    </option>
                                    {{-- <option value="">Show: 16</option>
                                    <option value="">Show: 28</option> --}}
                                </select>
                            </div>
                        </div>
                        <!-- //end Toolbar Sorter 2  -->
                    </div>
                    <!-- Page-Bar /- -->
                    <!-- Row-of-Product-Container -->
                    <div class="row product-container grid-style">
                        {{-- {{$products->count() }} --}}

                        @include("customer.listing-product.product")
                    </div>
                    <div>
                        {{ $categoryDetails['categoryDetails']['description'] }}
                    </div>
                    <!-- Row-of-Product-Container /- -->
                </div>
                <!-- Shop-Right-Wrapper /- -->

                <!-- Shop-Pagination -->
                <div class="pagination-area">
                    <div class="pagination-number">
                        <ul>
                            <li style="display: none">
                                <a href="shop-v1-root-category.html" title="Previous">
                                    <i class="fa fa-angle-left"></i>
                                </a>
                            </li>
                            <li class="active">
                                <a href="shop-v1-root-category.html">1</a>
                            </li>
                            <li>
                                <a href="shop-v1-root-category.html">2</a>
                            </li>
                            <li>
                                <a href="shop-v1-root-category.html">3</a>
                            </li>
                            <li>
                                <a href="shop-v1-root-category.html">...</a>
                            </li>
                            <li>
                                <a href="shop-v1-root-category.html">10</a>
                            </li>
                            <li>
                                <a href="shop-v1-root-category.html" title="Next">
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Shop-Pagination /- -->
            </div>
        </div>
    </div>
@endsection

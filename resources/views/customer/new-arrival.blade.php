@php
    use App\Models\Product;

@endphp

@extends('customer.layouts.layout')

@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>New Arrivals</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="listing-without-filters.html">New Arrivals</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Custom-Deal-Page -->
    <div class="page-deal u-s-p-t-80">
        <div class="container">
            <div class="deal-page-wrapper">
                <h1 class="deal-heading">New Arrivals</h1>
                <h6 class="deal-has-total-items">27 Items</h6>
            </div>
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
                <div class="toolbar-sorter">
                    <div class="select-box-wrapper">
                        <label class="sr-only" for="sort-by">Sort By</label>
                        <select class="select-box" id="sort-by">
                            <option selected="selected" value="">Sort By: Best Selling</option>
                            <option value="">Sort By: Latest</option>
                            <option value="">Sort By: Lowest Price</option>
                            <option value="">Sort By: Highest Price</option>
                            <option value="">Sort By: Best Rating</option>
                        </select>
                    </div>
                </div>
                <!-- //end Toolbar Sorter 1  -->
                <!-- Toolbar Sorter 2  -->
                <div class="toolbar-sorter-2">
                    <div class="select-box-wrapper">
                        <label class="sr-only" for="show-records">Show Records Per Page</label>
                        <select class="select-box" id="show-records">
                            <option selected="selected" value="">Show: 8</option>
                            <option value="">Show: 16</option>
                            <option value="">Show: 28</option>
                        </select>
                    </div>
                </div>
                <!-- //end Toolbar Sorter 2  -->
            </div>
            <!-- Page-Bar /- -->
            <!-- Row-of-Product-Container -->
            <div class="row product-container grid-style">

                @foreach ($products as $product)
                    @php
                        $newPriceAndDiscount = Product::newPrice($product['id']);
                    @endphp

                    <div class="product-item col-lg-3 col-md-6 col-sm-6">
                        <div class="item">
                            <div class="image-container">
                                <a class="item-img-wrapper-link" href="{{ url('single-product/' . $product['id']) }}">
                                    <img class="img-fluid"
                                        src="{{ url('images/product_image/midium_img/' . $product['product_image']) }}"
                                        alt="Product">
                                </a>
                                <div class="item-action-behaviors">
                                    <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick
                                        Look
                                    </a>
                                    <a class="item-mail" href="javascript:void(0)">Mail</a>
                                    <a class="item-addwishlist" href="javascript:void(0)">Add to
                                        Wishlist</a>
                                    <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                </div>
                            </div>
                            <div class="item-content">
                                <div class="what-product-is">
                                    <ul class="bread-crumb">
                                        <li>
                                            <a href="shop-v1-root-category.html">{{ $product['product_code'] }}</a>
                                        </li>
                                    </ul>
                                    <h6 class="item-title">
                                        <a href="{{ url('single-product/' . $product['id']) }}">
                                            {{ $product['product_name'] }}
                                        </a>
                                    </h6>
                                    <div class="item-stars">
                                        <div class='star' title="0 out of 5 - based on 0 Reviews">
                                            <span style='width:0'></span>
                                        </div>
                                        <span>(0)</span>
                                    </div>
                                </div>
                                <div class="price-template">
                                    <div class="item-new-price">
                                        &#x9F3; {{ $newPriceAndDiscount['getNewPrice'] }}
                                    </div>
                                    @if ($newPriceAndDiscount['discountPrice'] > 0)
                                        <div class="item-old-price">
                                            &#x9F3; {{ $product['product_price'] }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="tag new">
                                <span>NEW</span>
                            </div>
                        </div>
                    </div>
                @endforeach
                {{-- <div class="product-item col-lg-3 col-md-6 col-sm-6">
                    <div class="item">
                        <div class="image-container">
                            <a class="item-img-wrapper-link" href="single-product.html">
                                <img class="img-fluid" src="images/product/product@3x.jpg" alt="Product">
                            </a>
                            <div class="item-action-behaviors">
                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick Look</a>
                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                <a class="item-addwishlist" href="javascript:void(0)">Add to Wishlist</a>
                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                            </div>
                        </div>
                        <div class="item-content">
                            <div class="what-product-is">
                                <ul class="bread-crumb">
                                    <li class="has-separator">
                                        <a href="shop-v1-root-category.html">Product Code</a>
                                    </li>
                                    <li class="has-separator">
                                        <a href="listing.html">Tops</a>
                                    </li>
                                    <li>
                                        <a href="shop-v3-sub-sub-category.html">Hoodies</a>
                                    </li>
                                </ul>
                                <h6 class="item-title">
                                    <a href="single-product.html">Product Name</a>
                                </h6>
                                <div class="item-description">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                                        incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud
                                        exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute
                                        irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur.
                                    </p>
                                </div>
                                <div class="item-stars">
                                    <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                        <span style='width:67px'></span>
                                    </div>
                                    <span>(23)</span>
                                </div>
                            </div>
                            <div class="price-template">
                                <div class="item-new-price">
                                    $100.00
                                </div>
                                <div class="item-old-price">
                                    $120.00
                                </div>
                            </div>
                        </div>
                        <div class="tag new">
                            <span>NEW</span>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!-- Row-of-Product-Container /- -->
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
    <!-- Custom-Deal-Page -->
@endsection

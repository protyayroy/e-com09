@php
    use App\Models\Product;
@endphp

@extends('customer.layouts.layout')

@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Detail</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="single-product.html">Detail</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Single-Product-Full-Width-Page -->
    <div class="page-detail u-s-p-t-80">
        <div class="container">
            <div id="product_details">
                @include('customer.single-product.group_product')
            </div>

            <!-- Different-Product-Section -->
            <div class="detail-different-product-section u-s-p-t-80">
                <!-- Similar-Products -->
                <section class="section-maker">
                    <div class="container">
                        <div class="sec-maker-header text-center">
                            <h3 class="sec-maker-h3">Similar Products</h3>
                        </div>
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                @if (count($relatedProducts) > 0)
                                    @foreach ($relatedProducts as $relatedProduct)
                                        @php
                                            $newPriceAndDiscount = Product::newPrice($relatedProduct['id']);
                                        @endphp
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link"
                                                href="{{ url('single-product/' . $relatedProduct['id']) }}">
                                                <img class="img-fluid"
                                                    src="{{ url('images/product_image/large_img/' . $relatedProduct['product_image']) }}"
                                                    alt="{{ url('images/product_image/large_img/' . $relatedProduct['product_image']) }}">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick
                                                    Look</a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to
                                                    Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="shop-v1-root-category.html">Product Code</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a
                                                        href="{{ url('single-product/' . $relatedProduct['id']) }}">{{ $relatedProduct['product_name'] }}</a>
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
                                                        &#x9F3; {{ $relatedProduct['product_price'] }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                    @endforeach
                                @else
                                    <div>
                                        <h3>
                                            No products found
                                        </h3>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Similar-Products /- -->
                <!-- Recently-View-Products  -->
                <section class="section-maker">
                    <div class="container">
                        <div class="sec-maker-header text-center">
                            <h3 class="sec-maker-h3">Recently View</h3>
                        </div>
                        <div class="slider-fouc">
                            <div class="products-slider owl-carousel" data-item="4">
                                {{-- <div class="item">
                                    <div class="image-container">
                                        <a class="item-img-wrapper-link" href="single-product.html">
                                            <img class="img-fluid"
                                                src="{{ asset('customer') }}/images/product/product@3x.jpg"
                                                alt="Product">
                                        </a>
                                        <div class="item-action-behaviors">
                                            <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick
                                                Look</a>
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
                                            </ul>
                                            <h6 class="item-title">
                                                <a href="single-product.html">Maire Battlefield Jeep Men's Jacket</a>
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
                                                &#x9F3; 100.00
                                            </div>
                                            <div class="item-old-price">
                                                $120.00
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tag hot">
                                        <span>HOT</span>
                                    </div>
                                </div> --}}
                                {{-- @if (count($getViewProducts) > 0) --}}
                                @foreach ($getViewProducts as $viewProduct)
                                    @php
                                        $newPriceAndDiscount = Product::newPrice($viewProduct['id']);
                                    @endphp
                                    <div class="item">
                                        <div class="image-container">
                                            <a class="item-img-wrapper-link"
                                                href="{{ url('single-product/' . $viewProduct['id']) }}">
                                                <img class="img-fluid"
                                                    src="{{ url('images/product_image/large_img/' . $viewProduct['product_image']) }}"
                                                    alt="{{ url('images/product_image/large_img/' . $viewProduct['product_image']) }}">
                                            </a>
                                            <div class="item-action-behaviors">
                                                <a class="item-quick-look" data-toggle="modal" href="#quick-view">Quick
                                                    Look</a>
                                                <a class="item-mail" href="javascript:void(0)">Mail</a>
                                                <a class="item-addwishlist" href="javascript:void(0)">Add to
                                                    Wishlist</a>
                                                <a class="item-addCart" href="javascript:void(0)">Add to Cart</a>
                                            </div>
                                        </div>
                                        <div class="item-content">
                                            <div class="what-product-is">
                                                <ul class="bread-crumb">
                                                    <li class="has-separator">
                                                        <a href="shop-v1-root-category.html">Product Code</a>
                                                    </li>
                                                </ul>
                                                <h6 class="item-title">
                                                    <a
                                                        href="{{ url('single-product/' . $viewProduct['id']) }}">{{ $viewProduct['product_name'] }}</a>
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
                                                        &#x9F3; {{ $viewProduct['product_price'] }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="tag new">
                                            <span>NEW</span>
                                        </div>
                                    </div>
                                @endforeach
                                {{-- @else --}}
                                {{-- <div>
                                        <h3>
                                            No products found
                                        </h3>
                                    </div> --}}
                                {{-- @endif --}}
                            </div>
                        </div>
                    </div>
                </section>
                <!-- Recently-View-Products /- -->
            </div>
            <!-- Different-Product-Section /- -->
        </div>
    </div>
    <!-- Single-Product-Full-Width-Page /- -->
@endsection

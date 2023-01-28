<!DOCTYPE html>
<html class="no-js" lang="en-US">

<head>
    <meta charset="UTF-8">
    <!--[if IE]>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <![endif]-->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Laravel Multi Vendor E-commerce Template - By Stack Developers Youtube Channel</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Standard Favicon -->
    {{-- <link href="{{ asset('customer') }}/favicon.ico" rel="shortcut icon"> --}}
    <!-- Base Google Font for Web-app -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <!-- Google Fonts for Banners only -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:400,800" rel="stylesheet">
    <!-- Bootstrap 4 -->
    <link rel="stylesheet" href="{{ asset('customer') }}/css/bootstrap.min.css">
    <!-- Font Awesome 5 -->
    <link rel="stylesheet" href="{{ asset('customer') }}/css/fontawesome.min.css">
    <!-- Ion-Icons 4 -->
    <link rel="stylesheet" href="{{ asset('customer') }}/css/ionicons.min.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="{{ asset('customer') }}/css/animate.min.css">
    <!-- Owl-Carousel -->
    <link rel="stylesheet" href="{{ asset('customer') }}/css/owl.carousel.min.css">
    <!-- Jquery-Ui-Range-Slider -->
    <link rel="stylesheet" href="{{ asset('customer') }}/css/jquery-ui-range-slider.min.css">
    <!-- Utility -->
    <link rel="stylesheet" href="{{ asset('customer') }}/css/utility.css">
    <!-- Main -->
    <link rel="stylesheet" href="{{ asset('customer') }}/css/bundle.css">
</head>

<body>

    <!-- app -->
    <div id="app">

        <!-- Header -->
        @include('customer.layouts.header')
        <!-- Header /- -->

        @yield('content')

        <!-- Footer -->
        @include('customer.layouts.footer')
        <!-- Footer /- -->

        <!-- Dummy Selectbox -->
        <div class="select-dummy-wrapper">
            <select id="compute-select">
                <option id="compute-option">All</option>
            </select>
        </div>
        <!-- Dummy Selectbox /- -->
        <!-- Responsive-Search -->
        <div class="responsive-search-wrapper">
            <button type="button" class="button ion ion-md-close" id="responsive-search-close-button"></button>
            <div class="responsive-search-container">
                <div class="container">
                    <p>Start typing and press Enter to search</p>
                    <form class="responsive-search-form">
                        <label class="sr-only" for="search-text">Search</label>
                        <input id="search-text" type="text" class="responsive-search-field"
                            placeholder="PLEASE SEARCH">
                        <i class="fas fa-search"></i>
                    </form>
                </div>
            </div>
        </div>
        <!-- Responsive-Search /- -->
        <!-- Newsletter-Modal -->

        {{-- <div id="newsletter-modal" class="modal fade">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="button dismiss-button ion ion-ios-close" data-dismiss="modal"></button>
                <div class="modal-body u-s-p-x-0">
                    <div class="row align-items-center u-s-m-x-0">
                        <div class="col-lg-6 col-md-6 col-sm-12 u-s-p-x-0">
                            <div class="newsletter-image">
                                <a target="_blank" rel="nofollow" href="https://youtube.com/stackdevelopers" class="banner-hover effect-dark-opacity">
                                    <img class="img-fluid" src="{{ asset('customer') }}/images/banners/stack-developers-modal-popup.png" alt="Newsletter Image">
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12">
                            <div class="newsletter-wrapper">
                                <h1>New to
                                    <span>Stack Developers</span> ?
                                    <br>Subscribe to our Newsletter</h1>
                                <h5>Get latest product update...</h5>
                                <form>
                                    <div class="u-s-m-b-35">
                                        <input type="text" class="newsletter-textfield" placeholder="Enter Your Email">
                                    </div>
                                    <div class="u-s-m-b-35">
                                        <button class="button button-primary d-block w-100">Subscribe</button>
                                    </div>
                                </form>
                                <h6>Be the first for getting special deals and offers, Send directly to your inbox.</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

        <!-- Newsletter-Modal /- -->
        <!-- Quick-view-Modal -->
        <div id="quick-view" class="modal fade">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <button type="button" class="button dismiss-button ion ion-ios-close"
                        data-dismiss="modal"></button>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <!-- Product-zoom-area -->
                                <div class="zoom-area">
                                    <img id="zoom-pro-quick-view" class="img-fluid"
                                        src="{{ asset('customer') }}/images/product/product@4x.jpg"
                                        data-zoom-image="images/product/product@4x.jpg" alt="Zoom Image">
                                    <div id="gallery-quick-view" class="u-s-m-t-10">
                                        <a class="active" data-image="images/product/product@4x.jpg"
                                            data-zoom-image="images/product/product@4x.jpg">
                                            <img src="{{ asset('customer') }}/images/product/product@2x.jpg"
                                                alt="Product">
                                        </a>
                                        <a data-image="images/product/product@4x.jpg"
                                            data-zoom-image="images/product/product@4x.jpg">
                                            <img src="{{ asset('customer') }}/images/product/product@2x.jpg"
                                                alt="Product">
                                        </a>
                                        <a data-image="images/product/product@4x.jpg"
                                            data-zoom-image="images/product/product@4x.jpg">
                                            <img src="{{ asset('customer') }}/images/product/product@2x.jpg"
                                                alt="Product">
                                        </a>
                                        <a data-image="images/product/product@4x.jpg"
                                            data-zoom-image="images/product/product@4x.jpg">
                                            <img src="{{ asset('customer') }}/images/product/product@2x.jpg"
                                                alt="Product">
                                        </a>
                                        <a data-image="images/product/product@4x.jpg"
                                            data-zoom-image="images/product/product@4x.jpg">
                                            <img src="{{ asset('customer') }}/images/product/product@2x.jpg"
                                                alt="Product">
                                        </a>
                                        <a data-image="images/product/product@4x.jpg"
                                            data-zoom-image="images/product/product@4x.jpg">
                                            <img src="{{ asset('customer') }}/images/product/product@2x.jpg"
                                                alt="Product">
                                        </a>
                                    </div>
                                </div>
                                <!-- Product-zoom-area /- -->
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12">
                                <!-- Product-details -->
                                <div class="all-information-wrapper">
                                    <div class="section-1-title-breadcrumb-rating">
                                        <div class="product-title">
                                            <h1>
                                                <a href="single-product.html">Product Name</a>
                                            </h1>
                                        </div>
                                        <ul class="bread-crumb">
                                            <li class="has-separator">
                                                <a href="index.html">Home</a>
                                            </li>
                                            <li class="has-separator">
                                                <a href="shop-v1-root-category.html">Men Clothing </a>
                                            </li>
                                            <li class="has-separator">
                                                <a href="listing.html">Tops</a>
                                            </li>
                                            <li class="is-marked">
                                                <a href="shop-v3-sub-sub-category.html">Hoodies</a>
                                            </li>
                                        </ul>
                                        <div class="product-rating">
                                            <div class='star' title="4.5 out of 5 - based on 23 Reviews">
                                                <span style='width:67px'></span>
                                            </div>
                                            <span>(23)</span>
                                        </div>
                                    </div>
                                    <div class="section-2-short-description u-s-p-y-14">
                                        <h6 class="information-heading u-s-m-b-8">Description:</h6>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                                            cillum dolore eu fugiat nulla pariatur.
                                        </p>
                                    </div>
                                    <div class="section-3-price-original-discount u-s-p-y-14">
                                        <div class="price">
                                            <h4>$100.00</h4>
                                        </div>
                                        <div class="original-price">
                                            <span>Original Price:</span>
                                            <span>$120.00</span>
                                        </div>
                                        <div class="discount-price">
                                            <span>Discount:</span>
                                            <span>15%</span>
                                        </div>
                                        <div class="total-save">
                                            <span>Save:</span>
                                            <span>$20</span>
                                        </div>
                                    </div>
                                    <div class="section-4-sku-information u-s-p-y-14">
                                        <h6 class="information-heading u-s-m-b-8">Sku Information:</h6>
                                        <div class="availability">
                                            <span>Availability:</span>
                                            <span>In Stock</span>
                                        </div>
                                        <div class="left">
                                            <span>Only:</span>
                                            <span>50 left</span>
                                        </div>
                                    </div>
                                    <div class="section-5-product-variants u-s-p-y-14">
                                        <h6 class="information-heading u-s-m-b-8">Product Variants:</h6>
                                        <div class="color u-s-m-b-11">
                                            <span>Available Color:</span>
                                            <div class="color-variant select-box-wrapper">
                                                <select class="select-box product-color">
                                                    <option value="1">Heather Grey</option>
                                                    <option value="3">Black</option>
                                                    <option value="5">White</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="sizes u-s-m-b-11">
                                            <span>Available Size:</span>
                                            <div class="size-variant select-box-wrapper">
                                                <select class="select-box product-size">
                                                    <option value="">Male 2XL</option>
                                                    <option value="">Male 3XL</option>
                                                    <option value="">Kids 4</option>
                                                    <option value="">Kids 6</option>
                                                    <option value="">Kids 8</option>
                                                    <option value="">Kids 10</option>
                                                    <option value="">Kids 12</option>
                                                    <option value="">Female Small</option>
                                                    <option value="">Male Small</option>
                                                    <option value="">Female Medium</option>
                                                    <option value="">Male Medium</option>
                                                    <option value="">Female Large</option>
                                                    <option value="">Male Large</option>
                                                    <option value="">Female XL</option>
                                                    <option value="">Male XL</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                                        <form action="#" class="post-form">
                                            <div class="quick-social-media-wrapper u-s-m-b-22">
                                                <span>Share:</span>
                                                <ul class="social-media-list">
                                                    <li>
                                                        <a href="#">
                                                            <i class="fab fa-facebook-f"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fab fa-twitter"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fab fa-google-plus-g"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fas fa-rss"></i>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="#">
                                                            <i class="fab fa-pinterest"></i>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="quantity-wrapper u-s-m-b-22">
                                                <span>Quantity:</span>
                                                <div class="quantity">
                                                    <input type="text" class="quantity-text-field" value="1">
                                                    <a class="plus-a" data-max="1000">&#43;</a>
                                                    <a class="minus-a" data-min="1">&#45;</a>
                                                </div>
                                            </div>
                                            <div>
                                                <button class="button button-outline-secondary" type="submit">Add to
                                                    cart</button>
                                                <button
                                                    class="button button-outline-secondary far fa-heart u-s-m-l-6"></button>
                                                <button
                                                    class="button button-outline-secondary far fa-envelope u-s-m-l-6"></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <!-- Product-details /- -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Quick-view-Modal /- -->
    </div>
    <!-- app /- -->
    <!--[if lte IE 9]>
<div class="app-issue">
    <div class="vertical-center">
        <div class="text-center">
            <h1>You are using an outdated browser.</h1>
            <span>This web app is not compatible with following browser. Please upgrade your browser to improve your security and experience.</span>
        </div>
    </div>
</div>
<style> #app {
    display: none;
} </style>
<![endif]-->
    <!-- NoScript -->
    <noscript>
        <div class="app-issue">
            <div class="vertical-center">
                <div class="text-center">
                    <h1>JavaScript is disabled in your browser.</h1>
                    <span>Please enable JavaScript in your browser or upgrade to a JavaScript-capable browser.</span>
                </div>
            </div>
        </div>
        <style>
            #app {
                display: none;
            }
        </style>
    </noscript>
    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('send', 'pageview')
    </script>

    <script src="https://www.google-analytics.com/analytics.js" async defer></script>
    <!-- Modernizr-JS -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/vendor/modernizr-custom.min.js"></script>
    <!-- NProgress -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/nprogress.min.js"></script>
    <!-- jQuery -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/jquery.min.js"></script>
    <!-- Bootstrap JS -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/bootstrap.min.js"></script>
    <!-- Popper -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/popper.min.js"></script>
    <!-- ScrollUp -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/jquery.scrollUp.min.js"></script>
    <!-- Elevate Zoom -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/jquery.elevatezoom.min.js"></script>
    <!-- jquery-ui-range-slider -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/jquery-ui.range-slider.min.js"></script>
    <!-- jQuery Slim-Scroll -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/jquery.slimscroll.min.js"></script>
    <!-- jQuery Resize-Select -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/jquery.resize-select.min.js"></script>
    <!-- jQuery Custom Mega Menu -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/jquery.custom-megamenu.min.js"></script>
    <!-- jQuery Countdown -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/jquery.custom-countdown.min.js"></script>
    <!-- Owl Carousel -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/owl.carousel.min.js"></script>
    <!-- Main -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/app.js"></script>

    <!-- Custom js -->
    <script type="text/javascript" src="{{ asset('customer') }}/js/custom.js"></script>

    {{-- @yield('jquery') --}}

    @include('customer.layouts.script')


</body>

</html>

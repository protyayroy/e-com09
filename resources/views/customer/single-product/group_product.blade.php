<!-- Product-Detail -->
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12">
        <!-- Product-zoom-area -->
        <div class="zoom-area">
            <img id="zoom-pro" class="img-fluid"
                src="{{ url('images/product_image/large_img/' . $products['product_image']) }}"
                data-zoom-image="{{ url('images/product_image/large_img/' . $products['product_image']) }}"
                alt="Zoom Image">
            <div id="gallery" class="u-s-m-t-10">
                <a class="active" data-image="{{ url('images/product_image/large_img/' . $products['product_image']) }}"
                    data-zoom-image="{{ url('images/product_image/midium_img/' . $products['product_image']) }}">
                    <img src="{{ url('images/product_image/midium_img/' . $products['product_image']) }}"
                        alt="Product">
                </a>
                @foreach ($product_images as $image)
                    <a data-image="{{ url('images/product_image/large_img/' . $image['image']) }}"
                        data-zoom-image="{{ url('images/product_image/large_img/' . $image['image']) }}">
                        <img src="{{ url('images/product_image/large_img/' . $image['image']) }}" alt="Product">
                    </a>
                @endforeach
            </div>
        </div>
        <!-- Product-zoom-area /- -->
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12">
        <!-- Product-details -->
        <div class="all-information-wrapper">

            @if (Session::has('error_msg'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error:</strong>
                    @php
                        echo Session('error_msg');
                    @endphp !
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if (Session::has('success_msg'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success:</strong> {{ Session('success_msg') }}!
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="section-1-title-breadcrumb-rating">
                <div class="product-title">
                    <h1>
                        <a href="{{ url('single-product/' . $products['id']) }}">{{ $products['product_name'] }}</a>
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
                <p>{{ $products['meta_description'] }}
                </p>
            </div>
            <form action="{{ url('add-to-cart') }}" method="post">
                @csrf
                <div class="dynamic_price">
                    <div class="section-3-price-original-discount u-s-p-y-14">
                        <div class="price">
                            <h4>&#x9F3; {{ $newPriceAndDiscount['getNewPrice'] }}</h4>
                        </div>
                        <div class="original-price">
                            <span>Original Price:</span>
                            <span>&#x9F3; {{ $products['product_price'] }}</span>
                        </div>
                        <div class="discount-price">
                            <span>Discount:</span>
                            <span>{{ $products['product_discount'] }}%</span>
                        </div>
                        <div class="total-save">
                            <span>Save:</span>
                            <span>&#x9F3; {{ $newPriceAndDiscount['discountPrice'] }}</span>
                        </div>
                    </div>
                    <div class="section-4-sku-information u-s-p-y-14">
                        <h6 class="information-heading u-s-m-b-8">Sku Information:</h6>
                        <div class="availability">
                            <span>Availability:</span>
                            @if ($products['stock'] > 0)
                                <span>In Stock</span>
                            @else
                                <span class="text-danger">Out of stock</span>
                            @endif
                        </div>
                        <div class="left">
                            <span>Only:</span>
                            <span>{{ $products['stock'] }} left</span>
                        </div>
                    </div>
                </div>
                <div class="section-5-product-variants u-s-p-y-14">
                    <h6 class="information-heading u-s-m-b-8">Product Variants:</h6>
                    @if (count($product_colors) > 0)
                        <div class="color u-s-m-b-11">
                            <span class="d-block mb-2">Available Product Color:</span>
                            {{-- <div class="color-variant select-box-wrapper">
                                    <select class="select-box product-color">
                                        <option value="{{ $products['product_color'] }}">{{ $products['product_color'] }}
                                        </option>
                                        @foreach ($product_colors as $color)
                                            <option value="{{ $color['product_color'] }}">{{ $color['product_color'] }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div> --}}{{-- {{ url('single-product/'.$color['id']) }} --}}
                            @foreach ($product_colors as $color)
                                <a href="javascript:" id="same_product" pro_val="{{ $color['id'] }}">
                                    <img src="{{ url('images/product_image/midium_img/' . $color['product_image']) }}"
                                        alt="" style="height: 70px;">
                                </a>
                            @endforeach
                        </div>
                    @endif

                    @if (!empty($products['attribute'][0]))
                        <div class="sizes u-s-m-b-11">
                            <span>Available Size:</span>

                            <div class="size-variant select-box-wrapper">
                                <select class="select-box product-size" name="size">
                                    <option value="" selected> Select Size</option>
                                    @foreach ($products['attribute'] as $attr)
                                        <option value="{{ $attr['size'] }}" attribute_id="{{ $attr['id'] }}">
                                            {{ $attr['size'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="section-6-social-media-quantity-actions u-s-p-y-14">
                    <div class="post-form">
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

                                <input type="number" id="quantity" name="quantity" min="1"
                                    max="{{ $products['stock'] }}" class="quantity-text-field" value="1">

                                <input type="hidden" name="product_id" value="{{ $products['id'] }}">
                                <input type="hidden" name="product_price" id="save_price"
                                    value="{{ $newPriceAndDiscount['getNewPrice'] }}">
                                <input type="hidden" name="letest_stock" id="get_stock"
                                    value="{{ $products['stock'] }}">
                                {{-- <input type="text" class="quantity-text-field" name="quantity" value="1"> --}}
                                {{-- <a class="plus-a" id="quantity" data-max="{{ $products['stock'] }}">&#43;</a>
                            <a class="minus-a" data-min="1">&#45;</a> --}}
                            </div>
                        </div>
                        <div>
                            <button class="button button-outline-secondary">Add to cart</button>
                            <button class="button button-outline-secondary far fa-heart u-s-m-l-6"></button>
                            <button class="button button-outline-secondary far fa-envelope u-s-m-l-6"></button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- Product-details /- -->
    </div>
</div>
<!-- Product-Detail /- -->
<!-- Detail-Tabs -->
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="detail-tabs-wrapper u-s-p-t-80">
            <div class="detail-nav-wrapper u-s-m-b-30">
                <ul class="nav single-product-nav justify-content-center">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#description">Description</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#specification">Specifications</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#review">Reviews (15)</a>
                    </li>
                </ul>
            </div>
            <div class="tab-content">
                <!-- Description-Tab -->
                <div class="tab-pane fade active show" id="description">
                    <div class="description-whole-container">
                        <p class="desc-p u-s-m-b-26">
                            {{ $products['product_description'] }}
                        </p>
                        <img class="desc-img img-fluid u-s-m-b-26"
                            src="{{ url('images/product_image/large_img/' . $products['product_image']) }}"
                            alt="Product" width="500px" height="500px">
                        @if (!empty($products['product_video']))
                            <iframe class="desc-iframe u-s-m-b-45" width="710" height="400"
                                src="{{ url('images/product_image/large_img/' . $products['product_video']) }}"
                                allowfullscreen></iframe>
                        @endif
                    </div>
                </div>
                <!-- Description-Tab /- -->
                <!-- Specifications-Tab -->
                <div class="tab-pane fade" id="specification">
                    <div class="specification-whole-container">
                        <div class="spec-ul u-s-m-b-50">
                            <h4 class="spec-heading">Key Features</h4>
                            <ul>
                                <li>Heather Grey</li>
                                <li>Black</li>
                                <li>White</li>
                            </ul>
                        </div>
                        <div class="u-s-m-b-50">
                            <h4 class="spec-heading">What's in the Box?</h4>
                            <h3 class="spec-answer">1 x hoodie</h3>
                        </div>
                        <div class="spec-table u-s-m-b-50">
                            <h4 class="spec-heading">General Information</h4>
                            <table>
                                <tr>
                                    <td>Sku</td>
                                    <td>AY536FA08JT86NAFAMZ</td>
                                </tr>
                            </table>
                        </div>
                        <div class="spec-table u-s-m-b-50">
                            <h4 class="spec-heading">Product Information</h4>
                            <table>
                                <tr>
                                    <td>Main Material</td>
                                    <td>Cotton</td>
                                </tr>
                                <tr>
                                    <td>Color</td>
                                    <td>Heather Grey, Black, White</td>
                                </tr>
                                <tr>
                                    <td>Sleeves</td>
                                    <td>Long Sleeve</td>
                                </tr>
                                <tr>
                                    <td>Top Fit</td>
                                    <td>Regular</td>
                                </tr>
                                <tr>
                                    <td>Print</td>
                                    <td>Not Printed</td>
                                </tr>
                                <tr>
                                    <td>Neck</td>
                                    <td>Round Neck</td>
                                </tr>
                                <tr>
                                    <td>Pieces Count</td>
                                    <td>1 piece</td>
                                </tr>
                                <tr>
                                    <td>Occasion</td>
                                    <td>Casual</td>
                                </tr>
                                <tr>
                                    <td>Shipping Weight (kg)</td>
                                    <td>0.5</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- Specifications-Tab /- -->
                <!-- Reviews-Tab -->
                <div class="tab-pane fade" id="review">
                    <div class="review-whole-container">
                        <div class="row r-1 u-s-m-b-26 u-s-p-b-22">
                            <div class="col-lg-6 col-md-6">
                                <div class="total-score-wrapper">
                                    <h6 class="review-h6">Average Rating</h6>
                                    <div class="circle-wrapper">
                                        <h1>4.5</h1>
                                    </div>
                                    <h6 class="review-h6">Based on 23 Reviews</h6>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="total-star-meter">
                                    <div class="star-wrapper">
                                        <span>5 Stars</span>
                                        <div class="star">
                                            <span style='width:0'></span>
                                        </div>
                                        <span>(0)</span>
                                    </div>
                                    <div class="star-wrapper">
                                        <span>4 Stars</span>
                                        <div class="star">
                                            <span style='width:67px'></span>
                                        </div>
                                        <span>(23)</span>
                                    </div>
                                    <div class="star-wrapper">
                                        <span>3 Stars</span>
                                        <div class="star">
                                            <span style='width:0'></span>
                                        </div>
                                        <span>(0)</span>
                                    </div>
                                    <div class="star-wrapper">
                                        <span>2 Stars</span>
                                        <div class="star">
                                            <span style='width:0'></span>
                                        </div>
                                        <span>(0)</span>
                                    </div>
                                    <div class="star-wrapper">
                                        <span>1 Star</span>
                                        <div class="star">
                                            <span style='width:0'></span>
                                        </div>
                                        <span>(0)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row r-2 u-s-m-b-26 u-s-p-b-22">
                            <div class="col-lg-12">
                                <div class="your-rating-wrapper">
                                    <h6 class="review-h6">Your Review is matter.</h6>
                                    <h6 class="review-h6">Have you used this product before?</h6>
                                    <div class="star-wrapper u-s-m-b-8">
                                        <div class="star">
                                            <span id="your-stars" style='width:0'></span>
                                        </div>
                                        <label for="your-rating-value"></label>
                                        <input id="your-rating-value" type="text" class="text-field"
                                            placeholder="0.0">
                                        <span id="star-comment"></span>
                                    </div>
                                    <form>
                                        <label for="your-name">Name
                                            <span class="astk"> *</span>
                                        </label>
                                        <input id="your-name" type="text" class="text-field"
                                            placeholder="Your Name">
                                        <label for="your-email">Email
                                            <span class="astk"> *</span>
                                        </label>
                                        <input id="your-email" type="text" class="text-field"
                                            placeholder="Your Email">
                                        <label for="review-title">Review Title
                                            <span class="astk"> *</span>
                                        </label>
                                        <input id="review-title" type="text" class="text-field"
                                            placeholder="Review Title">
                                        <label for="review-text-area">Review
                                            <span class="astk"> *</span>
                                        </label>
                                        <textarea class="text-area u-s-m-b-8" id="review-text-area" placeholder="Review"></textarea>
                                        <button class="button button-outline-secondary">Submit Review</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Get-Reviews -->
                        <div class="get-reviews u-s-p-b-22">
                            <!-- Review-Options -->
                            <div class="review-options u-s-m-b-16">
                                <div class="review-option-heading">
                                    <h6>Reviews
                                        <span> (15) </span>
                                    </h6>
                                </div>
                                <div class="review-option-box">
                                    <div class="select-box-wrapper">
                                        <label class="sr-only" for="review-sort">Review Sorter</label>
                                        <select class="select-box" id="review-sort">
                                            <option value="">Sort by: Best Rating</option>
                                            <option value="">Sort by: Worst Rating</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <!-- Review-Options /- -->
                            <!-- All-Reviews -->
                            <div class="reviewers">
                                <div class="review-data">
                                    <div class="reviewer-name-and-date">
                                        <h6 class="reviewer-name">John</h6>
                                        <h6 class="review-posted-date">10 May 2018</h6>
                                    </div>
                                    <div class="reviewer-stars-title-body">
                                        <div class="reviewer-stars">
                                            <div class="star">
                                                <span style='width:67px'></span>
                                            </div>
                                            <span class="review-title">Good!</span>
                                        </div>
                                        <p class="review-body">
                                            Good Quality...!
                                        </p>
                                    </div>
                                </div>
                                <div class="review-data">
                                    <div class="reviewer-name-and-date">
                                        <h6 class="reviewer-name">Doe</h6>
                                        <h6 class="review-posted-date">10 June 2018</h6>
                                    </div>
                                    <div class="reviewer-stars-title-body">
                                        <div class="reviewer-stars">
                                            <div class="star">
                                                <span style='width:67px'></span>
                                            </div>
                                            <span class="review-title">Well done!</span>
                                        </div>
                                        <p class="review-body">
                                            Cotton is good.
                                        </p>
                                    </div>
                                </div>
                                <div class="review-data">
                                    <div class="reviewer-name-and-date">
                                        <h6 class="reviewer-name">Tim</h6>
                                        <h6 class="review-posted-date">10 July 2018</h6>
                                    </div>
                                    <div class="reviewer-stars-title-body">
                                        <div class="reviewer-stars">
                                            <div class="star">
                                                <span style='width:67px'></span>
                                            </div>
                                            <span class="review-title">Well done!</span>
                                        </div>
                                        <p class="review-body">
                                            Excellent condition
                                        </p>
                                    </div>
                                </div>
                                <div class="review-data">
                                    <div class="reviewer-name-and-date">
                                        <h6 class="reviewer-name">Johnny</h6>
                                        <h6 class="review-posted-date">10 March 2018</h6>
                                    </div>
                                    <div class="reviewer-stars-title-body">
                                        <div class="reviewer-stars">
                                            <div class="star">
                                                <span style='width:67px'></span>
                                            </div>
                                            <span class="review-title">Bright!</span>
                                        </div>
                                        <p class="review-body">
                                            Cotton
                                        </p>
                                    </div>
                                </div>
                                <div class="review-data">
                                    <div class="reviewer-name-and-date">
                                        <h6 class="reviewer-name">Alexia C. Marshall</h6>
                                        <h6 class="review-posted-date">12 May 2018</h6>
                                    </div>
                                    <div class="reviewer-stars-title-body">
                                        <div class="reviewer-stars">
                                            <div class="star">
                                                <span style='width:67px'></span>
                                            </div>
                                            <span class="review-title">Well done!</span>
                                        </div>
                                        <p class="review-body">
                                            Good polyester Cotton
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- All-Reviews /- -->
                            <!-- Pagination-Review -->
                            <div class="pagination-review-area">
                                <div class="pagination-review-number">
                                    <ul>
                                        <li style="display: none">
                                            <a href="single-product.html" title="Previous">
                                                <i class="fas fa-angle-left"></i>
                                            </a>
                                        </li>
                                        <li class="active">
                                            <a href="single-product.html">1</a>
                                        </li>
                                        <li>
                                            <a href="single-product.html">2</a>
                                        </li>
                                        <li>
                                            <a href="single-product.html">3</a>
                                        </li>
                                        <li>
                                            <a href="single-product.html">...</a>
                                        </li>
                                        <li>
                                            <a href="single-product.html">10</a>
                                        </li>
                                        <li>
                                            <a href="single-product.html" title="Next">
                                                <i class="fas fa-angle-right"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Pagination-Review /- -->
                        </div>
                        <!-- Get-Reviews /- -->
                    </div>
                </div>
                <!-- Reviews-Tab /- -->
            </div>
        </div>
    </div>
</div>
<!-- Detail-Tabs /- -->

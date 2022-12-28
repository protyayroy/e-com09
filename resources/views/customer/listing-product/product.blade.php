@foreach ($products as $product)
    <div class="product-item col-lg-4 col-md-6 col-sm-6">
        <div class="item">
            <div class="image-container">
                <a class="item-img-wrapper-link" href="single-product.html">
                    <img class="img-fluid" img src="{{ url('images/product_image/' . $product['product_image']) }}"
                        alt="{{ $product['product_image'] }}">
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
                            <a href="shop-v1-root-category.html">{{ $product['product_code'] }}</a>
                        </li>
                        <li class="has-separator">
                            <a href="listing.html">{{ $product['brand_id'] }}</a>
                        </li>
                        <li>
                            <a href="shop-v3-sub-sub-category.html">Hoodies</a>
                        </li>
                    </ul>
                    <h6 class="item-title">
                        <a href="single-product.html">{{ $product['product_name'] }}</a>
                    </h6>
                    <div class="item-description">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                            tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam,
                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. Duis aute irure dolor in reprehenderit in voluptate velit
                            esse
                            cillum dolore eu fugiat nulla pariatur.
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
                        {{ $product['product_price'] }}
                    </div>
                    <div class="item-old-price">
                        {{-- $120.00 --}}
                    </div>
                </div>
            </div>
            <div class="tag new">
                <span>NEW</span>
            </div>
        </div>
    </div>
@endforeach

@php
    $cartItems = cartItem(Cookie::get('new_cookie_id'));
@endphp

@foreach ($cartItems as $cartItem)
    @foreach ($cartItem['cartItems'] as $item)
        <li class="clearfix">
            <a href="single-product.html">
                <img src="{{ url('images/product_image/midium_img/' . $item->cart->product_image) }}" alt="Product">
                <span class="mini-item-name">{{ $item->cart->product_name }}</span>
                <span class="mini-item-price">&#x9F3; {{ $item['sell_price'] }}</span>
                <span class="mini-item-quantity"> x {{ $item['quantity'] }} </span>
            </a>
        </li>
    @endforeach
@endforeach

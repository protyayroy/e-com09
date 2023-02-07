@php
    use App\Models\ProductAttribute;
@endphp

@foreach ($carts as $cart)
    @php
        $productAttr = ProductAttribute::where(['product_id' => $cart['product_id'], 'size' => $cart['size']])->first();
        if (!empty($productAttr['stock'])) {
            $stock = $productAttr['stock'];
            // $stock_id = $productAttr['id'];
        } else {
            $stock = $cart->cart->stock;
            // $product_id = $cart->cart->id;
        }
    @endphp
    <tr>
        <td>
            <div class="cart-anchor-image">
                <a href="{{ url('single-product/' . $cart->cart->id) }}">
                    <img src="{{ url('images/product_image/midium_img/' . $cart->cart->product_image) }}"
                        alt="{{ $cart->cart->product_image }}" style="height: 80px;width: 100px">
                </a>
            </div>
        </td>
        <td>
            {{-- <h6>{{ $cart->cart->product_name }}</h6> --}}
            <p class="my-0"> <span class="text-dark" style="font-size: 14px">Name:</span>
                <small>{{ $cart->cart->product_name }}</small>
            </p>
            <p class="my-0"> <span class="text-dark" style="font-size: 14px">Size:</span>
                <small>{{ $cart->size }}</small>
            </p>
            <p class="my-0"> <span class="text-dark" style="font-size: 14px">Color:</span>
                <small>{{ $cart->cart->product_color }}</small>
            </p>
        </td>
        <td>
            <div class="cart-price">
                &#x9F3; {{ $cart->sell_price }}
            </div>
        </td>
        <td>
            <div class="cart-quantity">
                <div class="quantity">
                    <input type="text" class="quantity-text-field" id="quantity" value="{{ $cart->quantity }}">
                    <a class="plus-a cart_update" data-max="{{ $stock }}" data-cart_id="{{ $cart->id }}"
                        data-stock="{{ $stock }}">&#43;</a>
                    <a class="minus-a cart_update" data-min="1" data-cart_id="{{ $cart->id }}"
                        data-stock="{{ $stock }}">&#45;</a>
                </div>
            </div>
        </td>
        <td>
            <div class="cart-price">
                &#x9F3; {{ $cart->quantity * $cart->sell_price }}
            </div>
        </td>
        <td>
            <div class="action-wrapper">
                <button type="submit" class="button button-outline-secondary fas fa-trash text-danger" id="delete-cart"
                    data-id="{{ $cart->id }}"></button>
            </div>
        </td>
    </tr>
@endforeach

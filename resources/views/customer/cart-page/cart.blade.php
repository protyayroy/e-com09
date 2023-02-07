@php
    use App\Models\ProductAttribute;
@endphp

@extends('customer.layouts.layout')

@section('content')
    <!-- Cart-Page -->
    <div class="page-cart u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-dismissible d-none" id="d-none" role="alert" style="border-radius: 5px">
                        @php
                            echo '<span id="message"></span>';
                        @endphp
                        <button type="button" class="close" id="close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <!-- Products-List-Wrapper -->
                        <div class="table-wrapper u-s-m-b-60">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Product Image</th>
                                        <th>Product Details</th>
                                        <th>Product Price</th>
                                        <th>Product Quantity</th>
                                        <th>Subtotal</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="cart_items">
                                    @include('customer.cart-page.cart-items')
                                </tbody>
                            </table>
                        </div>
                        <!-- Products-List-Wrapper /- -->
                        <!-- Coupon -->
                        <div class="coupon-continue-checkout u-s-m-b-60">
                            <div class="coupon-area">
                                <h6>Enter your coupon code if you have one.</h6>
                                <div class="coupon-field">
                                    <label class="sr-only" for="coupon-code">Apply Coupon</label>
                                    <input id="coupon-code" type="text" class="text-field" placeholder="Coupon Code">
                                    <button type="submit" class="button">Apply Coupon</button>
                                </div>
                            </div>
                            <div class="button-area">
                                <a href="{{ url('/') }}" class="continue">Continue Shopping</a>
                                <a href="{{ url('checkout') }}" class="checkout">Proceed to Checkout</a>
                            </div>
                        </div>
                        <!-- Coupon /- -->
                    </form>
                    <!-- Billing -->
                    <div class="calculation u-s-m-b-60">
                        <div class="table-wrapper-2">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="2">Cart Totals</th>
                                    </tr>
                                </thead>
                                @foreach ($cartTotals as $total)
                                    <tbody>
                                        <tr>
                                            <td>
                                                <h3 class="calc-h3 u-s-m-b-0">Subtotal</h3>
                                            </td>
                                            <td>
                                                <span class="calc-text total">&#x9F3; {{ $total['totalCartPrice'] }}</span>
                                            </td>
                                        </tr>
                                        {{-- <tr>
                                        <td>
                                            <h3 class="calc-h3 u-s-m-b-8">Shipping</h3>
                                            <div class="calc-choice-text u-s-m-b-4">Flat Rate: Not Available</div>
                                            <div class="calc-choice-text u-s-m-b-4">Free Shipping: Not Available</div>
                                            <a data-toggle="collapse" href="#shipping-calculation"
                                                class="calc-anchor u-s-m-b-4">Calculate Shipping
                                            </a>
                                            <div class="collapse" id="shipping-calculation">
                                                <form>
                                                    <div class="select-country-wrapper u-s-m-b-8">
                                                        <div class="select-box-wrapper">
                                                            <label class="sr-only" for="select-country">Choose your
                                                                country
                                                            </label>
                                                            <select class="select-box" id="select-country">
                                                                <option selected="selected" value="">Choose your
                                                                    country...
                                                                </option>
                                                                <option value="">United Kingdom (UK)</option>
                                                                <option value="">United States (US)</option>
                                                                <option value="">United Arab Emirates (UAE)</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="select-state-wrapper u-s-m-b-8">
                                                        <div class="select-box-wrapper">
                                                            <label class="sr-only" for="select-state">Choose your state
                                                            </label>
                                                            <select class="select-box" id="select-state">
                                                                <option selected="selected" value="">Choose your
                                                                    state...
                                                                </option>
                                                                <option value="">Alabama</option>
                                                                <option value="">Alaska</option>
                                                                <option value="">Arizona</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="town-city-div u-s-m-b-8">
                                                        <label class="sr-only" for="town-city"></label>
                                                        <input type="text" id="town-city" class="text-field"
                                                            placeholder="Town / City">
                                                    </div>
                                                    <div class="postal-code-div u-s-m-b-8">
                                                        <label class="sr-only" for="postal-code"></label>
                                                        <input type="text" id="postal-code" class="text-field"
                                                            placeholder="Postcode / Zip">
                                                    </div>
                                                    <div class="update-totals-div u-s-m-b-8">
                                                        <button class="button button-outline-platinum">Update
                                                            Totals</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </td>
                                        <td>
                                        </td>
                                    </tr> --}}
                                        <tr>
                                            <td>
                                                <h3 class="calc-h3 u-s-m-b-0" id="tax-heading">Tax</h3>
                                                <span> (estimated for your country)</span>
                                            </td>
                                            <td>
                                                <span class="calc-text">&#x9F3; 0.00</span>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <h3 class="calc-h3 u-s-m-b-0">Total</h3>
                                            </td>
                                            <td>
                                                <span class="calc-text total">&#x9F3; {{ $total['totalCartPrice'] }}</span>
                                            </td>
                                        </tr>
                                    </tbody>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <!-- Billing /- -->
                </div>
            </div>
        </div>
    </div>
    <!-- Cart-Page /- -->
@endsection

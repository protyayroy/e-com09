<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\View;

class CartController extends Controller
{
    // VIEW CART
    public function cart()
    {
        $cartTotals = Cart::cartItem(Cookie::get('new_cookie_id'));
        return view('customer.cart-page.cart', [
            'carts' => Cart::with('cart')->where('cookie_id', Cookie::get('new_cookie_id'))->get()
        ], compact('cartTotals'));
    }

    // UPDATE CART BY AJAX
    public function updateCart(Request $request)
    {
        // print_r($request->all());
        if (($request->stock < $request->quantity) || ($request->quantity < 1)) {

            $carts = Cart::with('cart')->where('cookie_id', Cookie::get('new_cookie_id'))->get();

            return response()->json([
                'status' => false,
                "error_msg" => "<strong>Error :</strong> Your given quantity is out of limit or negative. Please keep it between <b> 1-" . $request->stock . "</b> item's !",
                'view' => (string)View::make("customer.cart-page.cart-items")->with(compact('carts')),
                'mini_cart' => (string)View::make("customer.layouts.header-cart-list"),
                'countCartItems' => countCartItem(Cookie::get('new_cookie_id')),
                'cartTotalPrice' => cartTotalPrice(Cookie::get('new_cookie_id'))
            ]);
        } else {
            $cart = Cart::where('id', $request->cart_id)->update([
                'quantity' => $request->quantity
            ]);

            $carts = Cart::with('cart')->where('cookie_id', Cookie::get('new_cookie_id'))->get();

            return response()->json([
                'status' => true,
                "success_msg" => "<strong>Success :</strong> Quantity updated successfully", 'view' => (string)View::make("customer.cart-page.cart-items")->with(compact('carts')),
                'cartItems' => cartItem(Cookie::get('new_cookie_id')),
                'mini_cart' => (string)View::make("customer.layouts.header-cart-list"),
                'countCartItems' => countCartItem(Cookie::get('new_cookie_id')),
                'cartTotalPrice' => cartTotalPrice(Cookie::get('new_cookie_id'))
            ]);
        }
    }

    // DELETE CART ITEM
    public function delete($id)
    {
        $delete = Cart::find($id)->delete();

        if ($delete) {
            $carts = Cart::with('cart')->where('cookie_id', Cookie::get('new_cookie_id'))->get();

            return response()->json([
                'status' => true,
                "success_msg" => "<strong>Success :</strong> Item deleted successfully !",
                'view' => (string)View::make("customer.cart-page.cart-items")->with(compact('carts')),
                'cartItems' => cartItem(Cookie::get('new_cookie_id')),
                'mini_cart' => (string)View::make("customer.layouts.header-cart-list"),
                'countCartItems' => countCartItem(Cookie::get('new_cookie_id')),
                'cartTotalPrice' => cartTotalPrice(Cookie::get('new_cookie_id'))
            ]);
        }
    }

    // Checkout
    public function checkout()
    {
        return view('customer.checkout');
    }
}

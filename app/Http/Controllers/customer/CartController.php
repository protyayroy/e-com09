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
    public function cart(){
        return view('customer.cart', [
            'carts' => Cart::with('cart')->where('cookie_id', Cookie::get('new_cookie_id'))->get()
        ]);
    }

    // UPDATE CART BY AJAX
    public function updateCart(Request $request){
        // print_r($request->all());
        if(($request->stock < $request->quantity) || ($request->quantity < 1)){
            return response()->json(['status' => false, "error_msg" => "<strong>Error :</strong> Your given quantity is out of limit or negative. Please keep it between 1-".$request->stock." item's !"]);
        }else{
            $cart = Cart::where('id', $request->cart_id)->update([
                'quantity' => $request->quantity
            ]);

            $carts = Cart::with('cart')->where('cookie_id', Cookie::get('new_cookie_id'))->get();

            return response()->json(['status' => true, "success_msg" => "<strong>Success :</strong> Quantity updated successfully", 'view' => (string)View::make("customer.cart")->with(compact('carts'))]);
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    public function cart(){
        return $this->belongsTo('App\Models\Product', 'product_id', 'id')->select('id','product_name','product_image','stock','product_color');
    }

    public static function cartItem($cookie_id){
        $countCartItems = Cart::where('cookie_id', $cookie_id)->count();
        $cartItems = Cart::with('cart')->where('cookie_id', $cookie_id)->get();
        $totalCartPrice = 0;
        foreach($cartItems as $cartItem){
            $sub_sell_price = $cartItem['sell_price']*$cartItem['quantity'];
            $totalCartPrice += $sub_sell_price;
        }
        return (array(['cartItems' => $cartItems, 'countCartItems' => $countCartItems, 'totalCartPrice' => $totalCartPrice]));
        // return $countCartItems;
    }
}

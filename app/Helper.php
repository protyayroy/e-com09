<?php

use App\Models\Cart;

function countCartItem($cookie_id)
{
    $countCartItems = Cart::where('cookie_id', $cookie_id)->sum('quantity');
    return $countCartItems;
}

function cartTotalPrice($cookie_id)
{
    $cartItems = Cart::with('cart')->where('cookie_id', $cookie_id)->get();
    $totalCartPrice = 0;
    foreach ($cartItems as $cartItem) {
        $sub_sell_price = $cartItem['sell_price'] * $cartItem['quantity'];
        $totalCartPrice += $sub_sell_price;
    }
    return $totalCartPrice;
}

function cartItem($cookie_id)
{
    $cartItems = Cart::with('cart')->where('cookie_id', $cookie_id)->get();
    // $totalCartPrice = 0;
    // foreach($cartItems as $cartItem){
    //     $sub_sell_price = $cartItem['sell_price']*$cartItem['quantity'];
    //     $totalCartPrice += $sub_sell_price;
    // }
    return (array(['cartItems' => $cartItems]));
    // return $countCartItems;
}





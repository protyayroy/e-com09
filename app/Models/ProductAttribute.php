<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    public static function getAttributePrice($id){
        $attr = ProductAttribute::where('id', $id)->first();

        $discount = Product::select('product_discount')->where('id', $attr['product_id'])->first();

        $discountPrice = ($discount['product_discount']*$attr['price'])/100;
        $getNewPrice = ($attr['price']-$discountPrice);

        return (array('getNewPrice' => $getNewPrice, 'discountPrice' => $discountPrice, 'discount' => $discount['product_discount'], 'original_price' => $attr['price'], 'stock' => $attr['stock']));
        // return $attr['product_id'];
    }

}

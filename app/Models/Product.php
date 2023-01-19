<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    use HasFactory;

    // PRODUCT RELATION WITH SECTION
    public function section(){
        return $this->belongsTo('App\Models\Section')->select('id', 'name')->where('status', 1);
    }

    // PRODUCT RELATION WITH CATEGORY
    public function category(){
        return $this->belongsTo('App\Models\Category')->select('id', 'name')->where('status', 1);
    }

    // PRODUCT RELATION WITH BRAND
    public function brand(){
        return $this->belongsTo('App\Models\Brand')->select('id', 'name')->where('status', 1);
    }

    // ATTRIBUTE RELATION WITH PRODUCT
    public function attribute(){
        return $this->hasMany('App\Models\ProductAttribute');
    }

    // NEW PRICE AFTER DISCOUNT A PRODUCT
    public static function newPrice($id){
        $oldPrice = Product::select('product_price','product_discount')->where(['id' => $id, 'status' => 1])->first();
        $discountPrice = ($oldPrice['product_discount']*$oldPrice['product_price'])/100;
        $getNewPrice = ($oldPrice['product_price']-$discountPrice);

        return (array('getNewPrice' => $getNewPrice, 'discountPrice' => $discountPrice));
    }

    // GET RELATED/SIMILLER PRODUCT
    public static function relatedProduct($id){
        $product = Product::where('id' , $id)->first();
        $category_id = $product['category_id'];
        $arent_id = Category::select('parent_id')->where('id', $category_id)->first();
        $url = Category::select('url')->where('id', $arent_id['parent_id'])->first();

        $categoryDetails = Category::getCatIds($url['url']);
        return $categoryDetails['catIds'];
    }

}

<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Products_filter;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use Illuminate\Support\Str;

class IndexController extends Controller
{
    public function index()
    {
        return view("customer.index");
    }

    public function listing(Request $request)
    {
        $url = Route::getFacadeRoot()->current()->uri();

        $categoryDetails = Category::getCatIds($url);

        // echo "<pre>";
        // print_r($categoryDetails) ;

        $products = Product::whereIn("category_id" , $categoryDetails['catIds']);


        if($request->ajax()){
            $data = $request->all();
            // print_r($data);
            // die;
            $_GET['sort'] = $data['sort'];

            if(isset($_GET['sort']) && !empty($_GET['sort'])){

                if($_GET['sort'] == "letest"){
                    $products = $products->orderby("id", "DESC");
                }elseif($_GET['sort'] == "lowest_price"){
                    $products = $products->orderby("product_price", "DESC");
                }elseif($_GET['sort'] == "highest_price"){
                    $products = $products->orderby("product_price", "ASC");
                }elseif($_GET['sort'] == "a-z"){
                    $products = $products->orderby("product_name", "ASC");
                }elseif($_GET['sort'] == "z-a"){
                    $products = $products->orderby("product_name", "DESC");
                }

                $products = $products->get();

                return view("customer.listing-product.product", compact('products','url'));
            }
        }else{
            $products = $products->get();
            return view("customer.listing-product.listing", compact('products','url','categoryDetails'));
        };

    }

    

}

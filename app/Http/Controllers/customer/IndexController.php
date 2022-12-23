<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
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

    public function listing()
    {
        $url = Route::getFacadeRoot()->current()->uri();

        $categoryDetails = Category::with("subcategory")->where('url',$url)->first()->toArray();

        $catIds = array();
        $catIds[] = $categoryDetails["id"];
        foreach($categoryDetails["subcategory"] as $key=>$subCat){
            // echo "<pre>";
            // print_r($subCat["id"]) ;
            $catIds[] = $subCat["id"];
        }

        $products = Product::whereIn("category_id" , $catIds)->get();

        if(isset($_GET['sort']) && ($_GET['sort'] == "lowest_price")){
            // $products = $products->orderBy("product.id", "DESC");
            echo "ok"; die;
        }

            // echo "<pre>";
            // print_r($product);
        // $url = Str::random(10);

        // echo $url;
        // die;


        return view("customer.listing", compact('products'));
    }
}

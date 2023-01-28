<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Recent_view;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\ProductAttribute;
use App\Models\Products_filter;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Nette\Utils\Random;

class IndexController extends Controller
{
    public function index()
    {
        return view("customer.index", [
            'products' => Product::where('status', 1)->orderBy('id', 'DESC')->get()
        ]);
    }

    public function listing(Request $request)
    {
        $url = Route::getFacadeRoot()->current()->uri();

        $categoryDetails = Category::getCatIds($url);

        // echo "<pre>";
        // print_r($categoryDetails) ;
        // die();

        $products = Product::whereIn("category_id", $categoryDetails['catIds']);
        // ->orderBy("product_price", "DESC")->get()->toArray();

        // echo "<pre>";
        // print_r($products) ;
        // die();

        $productColors = Product::select('product_color')->whereIn("category_id", $categoryDetails['catIds'])->distinct()->get();

        $productBrands = Product::with('brand')->select('brand_id')->whereIn("category_id", $categoryDetails['catIds'])->distinct()->get()->toArray();

        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";
            // print_r($data);

            // echo "nxt";

            // FILTER FOR BRAND
            if (isset($data['brand']) && !empty($data['brand'])) {
                $products->whereIn('brand_id', $data['brand']);
            }

            // FILTER FOR COLOR
            if (isset($data['color']) && !empty($data['color'])) {
                $products->whereIn('product_color', $data['color']);
            }

            // die;
            // DYNAMIK FILTER FOR CHECKED VALUE
            $productFilters = Products_filter::productFilters();
            foreach ($productFilters as $key => $filter) {

                // return ($data[$filter['filter_column']]);

                if (isset($data[$filter['filter_column']]) && !empty($data[$filter['filter_column']])) {
                    $products->whereIn($filter['filter_column'], $data[$filter['filter_column']]);
                }
            }

            // die;

            // FILTER FOR SORT VALUE
            $_GET['sort'] = $data['sort'];
            if (isset($_GET['sort']) && !empty($_GET['sort'])) {

                if ($_GET['sort'] == "letest") {
                    $products = $products->orderby("id", "DESC");
                } elseif ($_GET['sort'] == "lowest_price") {
                    $products = $products->orderby("product_price", "ASC");
                } elseif ($_GET['sort'] == "highest_price") {
                    $products = $products->orderby("product_price", "DESC");
                } elseif ($_GET['sort'] == "a-z") {
                    $products = $products->orderby("product_name", "ASC");
                } elseif ($_GET['sort'] == "z-a") {
                    $products = $products->orderby("product_name", "DESC");
                }
            }

            $products = $products->get();

            return view("customer.listing-product.product", compact('products', 'url', 'productColors', 'productBrands'));
        } else {
            $products = $products->orderby("products.id", "DESC")->get();
            return view("customer.listing-product.listing", compact('products', 'url', 'categoryDetails', 'productColors', 'productBrands'));
        };
    }

    // public function getUserIpAddr(Request $request)
    // {
    //     // $value = $request->cookie('name');
    //     // dd($value);
    //     $cookie = Cookie::get('cookie_id');
    //     if($cookie){
    //         $unique = $cookie;
    //     }
    //     else{
    //         $unique = Str::random(7).rand(1,1000);
    //         Cookie::queue('cookie_id', $unique, 43200);
    //     }

    //     dd($cookie);

    //     $ipAddress = $request->ip();

    //     $ipaddress = '';
    //     if (isset($_SERVER['HTTP_CLIENT_IP']))
    //         $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    //     else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
    //         $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    //     else if (isset($_SERVER['HTTP_X_FORWARDED']))
    //         $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    //     else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
    //         $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    //     else if (isset($_SERVER['HTTP_FORWARDED']))
    //         $ipaddress = $_SERVER['HTTP_FORWARDED'];
    //     else if (isset($_SERVER['REMOTE_ADDR']))
    //         $ipaddress = $_SERVER['REMOTE_ADDR'];
    //     else
    //         $ipaddress = 'UNKNOWN';
    //     return $ipaddress;
    // }

    // VIEW SINGLE PRODUCT
    public function singleProduct(Request $request, $id)
    {
        // CREAT COOKIE FOR USER
        if (empty(Cookie::get('new_cookie_id'))) {
            $randId = Str::random(20) . rand(1, 1000);
            $munite = 43200;
            Cookie::queue('new_cookie_id', $randId, $munite);
        }

        // NEW PRODUCT INSERT IN RECENT_VIEW TABLE
        $cookie_id = Cookie::get('new_cookie_id');
        $getRecentViewProduct = Recent_view::where('cookie_id', $cookie_id)->get();
        $getViewProductIds = array();
        foreach ($getRecentViewProduct as $getViewProductId) {
            $getViewProductIds[] = $getViewProductId['product_id'];
        }
        // dd($getViewProductIds);
        $getViewProducts = Product::where('id', '!=', $id)->whereIn('id', $getViewProductIds)->inRandomOrder()->get();

        $recentViewProduct = Recent_view::where(['cookie_id' => $cookie_id, 'product_id' => $id])->first();
        if (empty($recentViewProduct)) {
            $recentView = new Recent_view;

            $recentView->cookie_id = $cookie_id;
            $recentView->product_id = $id;
            $recentView->save();
            if ($getRecentViewProduct->count() > 5) {
                $ViewProduct = Recent_view::where('cookie_id', $cookie_id)->orderby('id', 'ASC')->first();
                $ViewProduct->delete();
            }
        }

        $newPriceAndDiscount = Product::newPrice($id);

        if ($request->ajax()) {

            $products = Product::with('attribute')->find($id);
            // dd($products['product_group_code']);
            $product_images = Product_image::where('product_id', $id)->get();
            $product_colors = Product::select('id', 'product_color', 'product_image')->where('product_group_code', $products['product_group_code'])->where('id', '!=', $id)->get();

            return view('customer.single-product.group_product', compact('products', 'product_colors', 'product_images', 'newPriceAndDiscount'));
        }

        $products = Product::with('attribute')->find($id);
        // dd($products['product_group_code']);
        $product_images = Product_image::where('product_id', $id)->get();
        $product_colors = Product::select('id', 'product_color', 'product_image')->where('product_group_code', $products['product_group_code'])->where('id', '!=', $id)->get();

        // GET CATEGORIES FOR RELATED PRODUCT
        $catIds = Product::relatedProduct($id);
        $relatedProducts = Product::where('id', '!=', $id)->where('product_group_code', '!=', $products['product_group_code'])->whereIn('category_id', $catIds)->inRandomOrder()->get();
        // foreach($relatedProducts)
        // $relatedProductsPrice = Product::newPrice($id);

        return view('customer.single-product.single-product', compact('products', 'product_colors', 'product_images', 'newPriceAndDiscount', 'relatedProducts', 'getViewProducts'));
    }

    // GET PRICE ACCODING TO CHANGING PRODUCT SIZE
    public function getPriceBySize($attr_id)
    {
        $newPriceAndDiscount = ProductAttribute::getAttributePrice($attr_id);

        // print_r($newPriceAndDiscount);

        return $newPriceAndDiscount;
        // $products = Product::with('attribute')->find($id);
        // // dd($products['product_group_code']);
        // $product_images = Product_image::where('product_id', $id)->get();
        // $product_colors = Product::select('id', 'product_color', 'product_image')->where('product_group_code', $products['product_group_code'])->where('id', '!=', $id)->get();

        // return view('customer.single-product.group_product', compact('products', 'product_colors', 'product_images', 'newPriceAndDiscount'));
    }

    //  ADD TO CART
    public function addToCart(Request $request)
    {
        $data = $request->all();
        $cookie_id = Cookie::get('new_cookie_id');
        // dd($request->all());

        if ($data['quantity'] > $data['letest_stock']) {
            return back()->with('error_msg', "<b>". $data['letest_stock'] . "</b> Item's are avaleable for this product. Please give right quantity to buy this product");
        } else {

            if (isset($data['size'])) {
                $size = $data['size'];
            }else{
                $size = '';
            }

            // UPDATE QUANTITY IF THAT PRODUCT ALREADY EXIST
            $updateCart = Cart::where(['cookie_id' => $cookie_id, 'product_id' => $data['product_id'], 'size' => $size])->first();

            if (!empty($updateCart)) {
                $quantity = $updateCart['quantity'] + $data['quantity'];
                if ($quantity > $data['letest_stock']) {
                    return back()->with('error_msg',"You have already add <b>".$updateCart['quantity']."</b> Item's in your cart. And <b>". $data['letest_stock'] . "</b> Item's are avaleable. Please give right quantity to buy this product");
                }else{
                    $updateCart->quantity = $quantity;
                    $updateCart->sell_price = $data['product_price'];
                    $updateCart->save();

                    return back()->with('success_msg', "This item quantity successfully updated in Cart");
                }
            } else {
                $request->validate([
                    'cookie_id' => 'unique:carts,cookie_id'
                ]);

                $cart = new Cart;

                if (isset(auth()->user()->id)) {
                    $cart->user_id = auth()->user()->id;
                }

                $cart->cookie_id = $cookie_id;
                $cart->product_id = $data['product_id'];
                $cart->size = $size;
                $cart->quantity = $data['quantity'];
                $cart->sell_price = $data['product_price'];
                $cart->save();

                return back()->with('success_msg', "This item successfully added in Cart");
            }
        }
    }

    
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Main_image_color;
use App\Models\Product;
use App\Models\Product_image;
use App\Models\ProductAttribute;
use App\Models\Section;
use App\Models\Products_filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    //  VIEW PRODUCT
    public function product()
    {
        $adminType = Auth::guard('admin')->user();
        // echo $adminType;
        // die;
        if($adminType['status'] == 1){
            if(($adminType['type'] == 'Vendor')){
                $products = Product::with('section', 'brand', 'category')->where(['vendor_id' => $adminType['vendor_id']])->get()->toArray();
            }else if(($adminType['type'] == 'Admin') || ($adminType['type'] == 'Super-Admin')){
                $products = Product::with('section', 'brand', 'category')->get()->toArray();
            }
            return view('admin.catelogue_management.product.product', compact('products'));
        }else{
            return redirect('admin/login')->with('error_msg', 'You should login first!');
        }
    }

    //  UPDATE PRODUCT STATUS
    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo '<pre/>'; print_r ($data['status']); die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Product::where('id', $data['status_id'])->update(['status' => $status]);

            return response()->json([
                'status' => $status,
                'status_id' => $data['status_id']
            ]);
        }
    }

    //  ADD-EDIT PRODUCT
    public function productAddEdit(Request $request, $id = null)
    {
        // dd($request->all());
        if ($id == "") {
            $title = 'Add Product';
            $products = new Product;
            $message = "Product has been inserted successfully";
            $image = "";
        } else {
            $title = 'Edit Product';
            $products = Product::with('section', 'brand', 'category')->find($id);
            $message = "Product has been updateed successfully";
            $image = $products->product_image;
        }

        if ($request->isMethod('post')) {

            $productsGroupCodes = Product::select('product_group_code')->where('admin_id', '!=', Auth::guard('admin')->user()->id)->get()->toArray();
            // dd($products);
            foreach ($productsGroupCodes as $productsGroupCode) {
                // ADD DIFFERENT PRODUCT PRODUCT GROUP CODE FOR DIFFERENT VENDOR
                if ($request->product_group_code != $productsGroupCode['product_group_code']) {

                    // PRODUCT THUMBEL IMAGE UPLOAD
                    if ($request->hasFile('product_image')) {
                        $image_tmp = $request->file('product_image');
                        if ($image_tmp->isValid()) {
                            // DELETE PREVIOUS IMAGE
                            $previous_image_path_large = 'images/product_image/large_img' . $products->product_image;
                            $previous_image_path_medium = 'images/product_image/midium_img' . $products->product_image;
                            if (File::exists($previous_image_path_large)) {
                                File::delete($previous_image_path_large);
                                File::delete($previous_image_path_medium);
                            }
                            // GET FULL IMAGE NAME WITH EXTENTION
                            $image_full_name = $image_tmp->getClientOriginalName();

                            // GET IMAGE NAME WITHOUT EXTENSION
                            $image_first_name = pathinfo($image_full_name, PATHINFO_FILENAME);

                            // GET IMAGE EXTENSION
                            $extention = $image_tmp->getClientOriginalExtension();

                            // TO GET UNIQUE IMAGE NAME
                            $unique = Str::random(10);

                            // SET UNIQUE IMAGE NAME
                            $image_name = $image_first_name . $unique . '.' . $extention;

                            // SET IMAGE PATH
                            // $small_image_path = 'images/product_image/small_img/' . $image_name;
                            $midium_image_path = 'images/product_image/midium_img/' . $image_name;
                            $large_image_path = 'images/product_image/large_img/' . $image_name;


                            // Image::make($image_tmp)->resize(68, 68)->save($small_image_path);
                            Image::make($image_tmp)->resize(255, 255)->save($midium_image_path);
                            Image::make($image_tmp)->resize(1500, 1500)->save($large_image_path);
                        }
                    } else {
                        $image_name = $image;
                    }

                    $productFilters = Products_filter::productFilters();
                    foreach ($productFilters as $filter) {
                        // echo $request->{$filter['filter_column']};
                        $filterAvailable = Products_filter::filterAvailable($filter['id'], $request->section_id);
                        if ($filterAvailable == 'Yes') {
                            if (isset($request->{$filter['filter_column']})) {
                                // echo "ok";
                                $products->{$filter['filter_column']} = $request->{$filter['filter_column']};
                            }
                        }
                    }
                    // die;
                    $getSectionId = Category::find($request->section_id);
                    $section_id = $getSectionId->section_id;
                    // echo $section_id . '---'; echo $request->section_id; die; rand(1, 9999).'.'.
                    $products->section_id = $section_id;
                    $products->category_id = $request->section_id;
                    $products->brand_id = $request->brand_id;
                    $products->vendor_id = Auth::guard('admin')->user()->vendor_id;
                    $products->admin_id = Auth::guard('admin')->user()->id;
                    $products->admin_type = Auth::guard('admin')->user()->type;
                    $products->product_name = $request->product_name;
                    $products->product_code = $request->product_code;
                    $products->product_group_code = $request->product_group_code;
                    $products->product_color = $request->product_color;
                    $products->product_price = $request->product_price;
                    $products->product_discount = $request->product_discount;
                    $products->product_weight = $request->product_weight;
                    $products->stock = $request->stock;
                    $products->stock_limit_alert = $request->stock_limit_alert;
                    $products->product_description = $request->product_description;
                    $products->meta_title = $request->meta_title;
                    $products->meta_description = $request->meta_description;
                    $products->meta_keywords = $request->meta_keywords;
                    $products->status = 1;
                    $products->product_image = $image_name;
                    $products->product_video = '';
                    $products->is_feature = 'No';

                    $products->save();

                    return redirect('admin/product')->with('success_msg', $message);
                } else {
                    return back()->with(['error_msg' => "Your product group code is similler other vendor product. Please give correct group code or new group code"]);
                }
            }
        }

        $getSection = Section::with('sectioncategory')->get()->toArray();
        $getBrand = Brand::where('status', 1)->get()->toArray();
        $filterCategories = Category::where('status', 1)->get()->toArray();

        return view('admin.catelogue_management.product.add-edit-product', compact('title', 'products', 'getSection', 'getBrand', 'filterCategories'));
    }

    public function filter(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $category_id = $data['category_id'];
            return response()->json([
                'view' => (string)View::make("admin.catelogue_management.product.select_filter")->with(compact('category_id'))
            ]);
        }
    }

    //  DELETE PRODUCT && PRODUCT ALL IMAGE
    public function destroy($id)
    {
        $products = Product::where('id', $id)->first();
        // DELETE PREVIOUS IMAGE
        $previous_large_image_path = 'images/product_image/large_img/' . $products->product_image;
        if (File::exists($previous_large_image_path)) {
            File::delete($previous_large_image_path);
        }

        $previous_midium_image_path = 'images/product_image/midium_img/' . $products->product_image;
        if (File::exists($previous_midium_image_path)) {
            File::delete($previous_midium_image_path);
        }


        $product_images = Product_image::where('product_id', $id)->get();
        foreach ($product_images as $image) {
            // DELETE PREVIOUS IMAGE
            $previous_large_image_path = 'images/product_image/large_img/' . $image->image;
            if (File::exists($previous_large_image_path)) {
                File::delete($previous_large_image_path);
            }
        }

        $products->delete();
        Product_image::where('product_id', $id)->delete();

        return back()->with('success_msg', 'The Product has been deleted successfully');
    }
}

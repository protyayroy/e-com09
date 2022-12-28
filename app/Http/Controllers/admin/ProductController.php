<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Section;
use App\Models\Products_filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

use Intervention\Image\Exception\NotSupportedException;
// use Intervention\Image\Image;
// use Image;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
    //  VIEW PRODUCT
    public function product()
    {
        return view('admin.catelogue_management.product.product', [
            'products' => Product::with('section', 'brand', 'category')->get()->toArray()
        ]);
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
        // Session::put('title', 'product');
        // echo Session::get('title'); die;
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
            // dd($request->all());

            if ($request->hasFile('product_image')) {
                $image_tmp = $request->file('product_image');
                if ($image_tmp->isValid()) {
                    // DELETE PREVIOUS IMAGE
                    $previous_image_path = 'images/product_image/' . $products->product_image;
                    if (File::exists($previous_image_path)) {
                        File::delete($previous_image_path);
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
                    $image_path = 'images/product_image/' . $image_name;
                    Image::make($image_tmp)->resize(100, 100)->save($image_path);
                }
            } else {
                $image_name = $image;
            }
            // dd($image);

            $productFilters = Products_filter::productFilters();
            foreach ($productFilters as $filter) {
                // echo $request->{$filter['filter_column']};
                $filterAvailable = Products_filter::filterAvailable($filter['id'], $request->section_id);
                if ($filterAvailable == 'Yes') {
                    if (isset($request->{$filter['filter_column']})) {
                        echo "ok";
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
            $products->product_color = $request->product_color;
            $products->product_price = $request->product_price;
            $products->product_discount = $request->product_discount;
            $products->product_weight = $request->product_weight;
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

    //  DELETE PRODUCT
    public function destroy($id)
    {
        Product::find($id)->delete();
        return back()->with('success_msg', 'The Product has been deleted successfully');
    }
}

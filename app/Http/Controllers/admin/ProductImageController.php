<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Product_image;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductImageController extends Controller
{
    //  VIEW PRODUCT GALLARY IMAGE
    public function gallary($product_id)
    {
        $gallary = Product_image::where('product_id', $product_id)->get();
        $products = Product::with('category', 'brand')->where('id', $product_id)->first()->toArray();
        return view('admin.catelogue_management.product.gallary_image.product-gallary', compact('gallary', 'products'));
    }

    public function addGallary(Request $request, $product_id)
    {
        // ADD MULTIPLE IMAGE / GALLARY IMAGE
        if ($request->hasFile('product_gallery_image')) {
            $multiple_image_tmp = $request->file('product_gallery_image');

            foreach ($multiple_image_tmp as $image_tmp) {
                if ($image_tmp->isValid()) {
                    // GET FULL IMAGE NAME WITH EXTENTION
                    $image_full_name = $image_tmp->getClientOriginalName();

                    // GET IMAGE NAME WITHOUT EXTENSION
                    $image_first_name = pathinfo($image_full_name, PATHINFO_FILENAME);

                    // GET IMAGE EXTENSION
                    $extention = $image_tmp->getClientOriginalExtension();

                    // TO GET UNIQUE IMAGE NAME
                    $unique = Str::random(10);

                    // SET UNIQUE IMAGE NAME
                    $multiple_image_name = $image_first_name . $unique . '.' . $extention;

                    // SET IMAGE PATH
                    // $small_image_path = 'images/product_image/small_img/' . $multiple_image_name;
                    $large_image_path = 'images/product_image/large_img/' . $multiple_image_name;
                    // $midium_image_path = 'images/product_image/midium_img' . $multiple_image_name;

                    // RESIZE && SAVE IMAGE
                    // Image::make($image_tmp)->resize(68, 68)->save($small_image_path);
                    Image::make($image_tmp)->resize(1500, 1500)->save($large_image_path);
                    // Image::make($image_tmp)->resize(255, 255)->save($midium_image_path);

                    $product_img = new Product_image;
                    $product_img->product_id = $request->product_id;
                    $product_img->image = $multiple_image_name;
                    $product_img->save();
                }
            }

            return back()->with(['success_msg' => 'Gallary image has been added successfully']);
        } else {
            echo "no";
        }
    }

    public function editGallary(Request $request, $gallary_id)
    {
        // dd($request->all());
        // ADD MULTIPLE IMAGE / GALLARY IMAGE
        if ($request->hasFile('edit_product_gallery_image')) {
            $multiple_image_tmp = $request->file('edit_product_gallery_image');
            if ($multiple_image_tmp->isValid()) {

                $product_img = Product_image::find($gallary_id);
                // DELETE PREVIOUS IMAGE
                $previous_large_image_path = 'images/product_image/large_img/' . $product_img->image;
                if (File::exists($previous_large_image_path)) {
                    File::delete($previous_large_image_path);
                }
                // GET FULL IMAGE NAME WITH EXTENTION
                $image_full_name = $multiple_image_tmp->getClientOriginalName();

                // GET IMAGE NAME WITHOUT EXTENSION
                $image_first_name = pathinfo($image_full_name, PATHINFO_FILENAME);

                // GET IMAGE EXTENSION
                $extention = $multiple_image_tmp->getClientOriginalExtension();

                // TO GET UNIQUE IMAGE NAME
                $unique = Str::random(10);

                // SET UNIQUE IMAGE NAME
                $multiple_image_name = $image_first_name . $unique . '.' . $extention;

                // SET IMAGE PATH
                // $small_image_path = 'images/product_image/small_img/' . $multiple_image_name;
                $large_image_path = 'images/product_image/large_img/' . $multiple_image_name;
                // $midium_image_path = 'images/product_image/midium_img' . $multiple_image_name;

                // RESIZE && SAVE IMAGE
                // Image::make($image_tmp)->resize(68, 68)->save($small_image_path);
                Image::make($multiple_image_tmp)->resize(1500, 1500)->save($large_image_path);
                // Image::make($image_tmp)->resize(255, 255)->save($midium_image_path);
            }
            // $product_img = Product_image::where('id',  $gallary_id)->first();
            $product_img->image = $multiple_image_name;
            $product_img->save();
            return back()->with(['success_msg' => 'Gallary image has been updated successfully']);
        } else {
            echo "no";
        }
    }

    //  DELETE PRODUCT GALLARY IMAGE
    public function destroy($product_id, $gallary_id)
    {
        $data = Product_image::find($gallary_id);
        // dd($data);
        // DELETE PREVIOUS IMAGE
        $previous_large_image_path = 'images/product_image/large_img/' . $data->image;
        if (File::exists($previous_large_image_path)) {
            File::delete($previous_large_image_path);
        }
        $data->delete();
        // dd($data);
        return redirect()->back()->with('success_msg', 'The gallary image has been deleted successfully');
    }
}

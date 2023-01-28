<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    //  VIEW BRAND
    public function brand()
    {
        return view('admin.catelogue_management.brand.brand', [
            'brands' => Brand::get()->toArray()
        ]);
    }

    //  UPDATE BRAND STATUS
    public function updateBrandStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo '<pre/>'; print_r ($data['status']); die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Brand::where('id', $data['status_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'status_id' => $data['status_id']]);
        }
    }

    //  ADD-EDIT BRAND
    public function brandAddEdit(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Brand";
            $message = 'Brand has been added successfully';
            $image_name = "";
            $brand = new Brand;
        } else {
            $title = "Edit Brand";
            $brand = Brand::find($id);
            $image_name = $brand->logo;
            $message = 'Brand has been updated successfully';
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required'
            ]);

            // UPLOAD BRAND LOGO
            if($request->hasFile('logo')){
                $image_tmp = $request->file('logo');

                if ($image_tmp->isValid()) {
                    // DELETE PREVIOUS IMAGE
                    $previous_image_path = 'images/brand_logo/' . $brand->product_image;
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
                    $image_path = 'images/brand_logo/' . $image_name;

                    Image::make($image_tmp)->resize(100, 100)->save($image_path);
                }

            }

            $brand->name = $request->name;
            $brand->admin_id = Auth::guard('admin')->user()->id;
            $brand->logo = $image_name;
            if(Auth::guard('admin')->user()->type == "Vendor"){
                $brand->status = 0;
            }else{
                $brand->status = 1;
            }
            $brand->save();
            return redirect('admin/brand')->with('success_msg', $message);
        }

        return view('admin.catelogue_management.brand.add-edit-brand', compact('title', 'brand'));
    }

    //  DELETE BRAND
    public function destroy($id)
    {
        Brand::find($id)->delete();
        return back()->with('success_msg', 'The Brand has been deleted successfully');

    }
}

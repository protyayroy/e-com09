<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

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
            $brand = new Brand;
        } else {
            $title = "Edit Brand";
            $brand = Brand::find($id);
            $message = 'Brand has been updated successfully';
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required'
            ]);
            $brand->name = $request->name;
            $brand->status = 1;
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

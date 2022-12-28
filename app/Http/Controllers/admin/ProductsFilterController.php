<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Products_filter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsFilterController extends Controller
{
    //  VIEW FILTER
    public function filter()
    {
        return view('admin.catelogue_management.filter.filter', [
            'filters' => Products_filter::get()->toArray()
        ]);
    }

    //  UPDATE FILTER STAT US
    public function updateFilterStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo '<pre/>'; print_r ($data['status']); die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Products_filter::where('id', $data['status_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'status_id' => $data['status_id']]);
        }
    }

    //  ADD-EDIT FILTER
    public function filterAddEdit(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Products Filter";
            $message = 'Filter has been added successfully';
            $filter = new Products_filter;
        } else {
            $title = "Edit Products Filter";
            $filter = Products_filter::find($id);
            $message = 'Products Filter has been updated successfully';
        }
        if ($request->isMethod('post')) {
            $request->validate([
                // 'name' => 'required'
            ]);

            // $catIds = array();
            // $catIds = json_encode(json_decode($request->cat_ids));
            // foreach($catIds as $key => $value){
            // $catIds = $value.",";
            // }
            // dd($catIds);
            $catIds = implode(",", $request->cat_ids);

            $filter->filter_name = $request->filter_name;
            $filter->filter_column = $request->filter_column;
            $filter->cat_ids = $catIds;
            $filter->status = 1;
            $filter->save();

            // ADD FILTER COLUMN IN PRODUCT TABLE
            DB::statement('Alter table products add '.$request->filter_column.' varchar(255) after product_description');
            
            return redirect('admin/filter')->with('success_msg', $message);
        }

        $categories = Category::with('subcategory')->where("status", 1)->where("parent_id", 0)->get();
        // dd($categories);
        return view('admin.catelogue_management.filter.add-edit-filter', compact('title', 'filter','categories'));
    }

    //  DELETE FILTER
    public function destroy($id)
    {
        Products_filter::find($id)->delete();
        return back()->with('success_msg', 'This products filter has been deleted successfully');

    }
}

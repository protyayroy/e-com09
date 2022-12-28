<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Products_filter;
use App\Models\Products_filters_value;
use Illuminate\Http\Request;

class ProductsFiltersValueController extends Controller
{
    //  VIEW BRAND
    public function filterValue()
    {
        return view('admin.catelogue_management.filter.filter_value.filter_value', [
            'filterValues' => Products_filters_value::get()->toArray()
        ]);
    }

    //  UPDATE BRAND STATUS
    public function updateFilterValueStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo '<pre/>'; print_r ($data['status']); die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Products_filters_value::where('id', $data['status_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'status_id' => $data['status_id']]);
        }
    }

    //  ADD-EDIT BRAND
    public function filterValueAddEdit(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Filter Value";
            $message = 'Filter Value has been added successfully';
            $filterValue = new Products_filters_value;
        } else {
            $title = "Edit Filter Value";
            $filterValue = Products_filters_value::find($id);
            $message = 'Filter Value has been updated successfully';
        }
        if ($request->isMethod('post')) {
            $request->validate([
                'filter_id' => 'required',
                'filter_value' => 'required'
            ]);
            $filterValue->filter_id = $request->filter_id;
            $filterValue->filter_value = $request->filter_value;
            $filterValue->status = 1;
            $filterValue->save();
            return redirect('admin/filter-value')->with('success_msg', $message);
        }

        $filters = Products_filter::where('status', 1)->get();

        return view('admin.catelogue_management.filter.filter_value.add-edit-filter_value', compact('title', 'filterValue','filters'));
    }

    //  DELETE BRAND
    public function destroy($id)
    {
        Products_filters_value::find($id)->delete();
        return back()->with('success_msg', 'The Brand has been deleted successfully');

    }
}

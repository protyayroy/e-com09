<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    //  VIEW CATEGORY
    public function category()
    {
        // $data = Category::with('section')->get()->toArray();
        // dd($data);
        return view('admin.catelogue_management.category.category', [
            'categories' => Category::with('section', 'parentcategory')->get()->toArray()
        ]);
    }

    //  ADD-EDIT CATEGORY
    public function categoryAddEdit(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Add Category";
            $message = 'Category has been added successfully';
            $category = new Category;
            $image = "";
        } else {
            $title = "Edit Category";
            $category = Category::find($id);
            $message = 'Category has been updated successfully';
            $image = $category->image;
        }

        // $category = Category::with('parentcategory')->where('status', 1)->get()->toArray();
        // dd($category);
        if ($request->isMethod('post')) {

            if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if($image_tmp->isValid()){
                    // DELETE PREVIOUS IMAGE
                    $previous_image_path = 'images/category_image/'.$category->image;
                    if(File::exists($previous_image_path)){
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
                    $image_name = $image_first_name.$unique.'.'.$extention;

                    // SET IMAGE PATH
                    $image_path = 'images/category_image/'.$image_name;
                    Image::make($image_tmp)->resize(100, 100)->save($image_path);
                }
            } else{
                $image_name = $image;
            }
            // dd($image_name);
            $request->validate([
                'name' => 'required|regex:/^[a-zA-Z\s\-\p{Arabic}_]+$/u'
            ]);

            $category->section_id = $request->section_id;
            $category->parent_id = $request->parent_id;
            $category->name = $request->name;
            $category->discount = $request->discount;
            $category->description = $request->description;
            $category->url = $request->url;
            $category->meta_title = $request->meta_title;
            $category->meta_description = $request->meta_description;
            $category->meta_keywords = $request->meta_keywords;
            $category->image = $image_name;
            $category->status = 1;
            $category->save();
            return redirect('admin/category')->with('success_msg', $message);
        }

        $sections = Section::get()->toArray();
        $getCategories = Category::with('section','subcategory')->where('parent_id', 0)->get()->toArray();
        // dd($getCategories);
        return view('admin.catelogue_management.category.add-edit-category', compact('title', 'category', 'sections', 'getCategories'));



    }

    //  UPDATE CATEGORY STATUS
    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo '<pre/>'; print_r ($data['status']); die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['status_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'status_id' => $data['status_id']]);
        }
    }

    //  CHANGE CATEGORY TYPE
    public function changeCategoryType($id)
    {
        $getCategories = Category::with('subcategory')->where(['parent_id'=> 0, 'section_id'=> $id])->get()->toArray();
        // print_r($getCategories); die;
        return view('admin.catelogue_management.category.appendCategoryLabel', compact('getCategories'));
    }

    //  DELETE CATEGORY changeCategoryType
    public function destroy($id)
    {
        Category::find($id)->delete();
        return back()->with('success_msg', 'The Category has been deleted successfully');
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class SectionController extends Controller
{
    public function section()
    {
        return view('admin.catelogue_management.section.section', [
            'sections' => Section::get()->toArray()
        ]);
    }

    //  UPDATE SECTION STATUS
    public function updateSectionStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo '<pre/>'; print_r ($data['status']); die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Section::where('id', $data['status_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'status_id' => $data['status_id']]);
        }
    }

    //  ADD-EDIT SECTION
    public function sectionAddEdit(Request $request, $id=null)
    {
        // Session::put('section', 'active');
        if ($id == "") {
            $title = "Add Section";
            $message = 'Section has been added successfully';
            $section = new Section;
            $image_name = "";
        } else {
            $title = "Edit Section";
            $section = Section::find($id);
            $image_name = $section->image;
            $message = 'Section has been updated successfully';
        }
        // $section = $section->toArray();
        // dd($section);
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|regex:/^[a-zA-Z0-9\p{Arabic}_]+$/u'
            ]);
            // UPLOAD BRAND LOGO
            if($request->hasFile('image')){
                $image_tmp = $request->file('image');

                if ($image_tmp->isValid()) {
                    // DELETE PREVIOUS IMAGE
                    $previous_image_path = 'images/section_img/' . $section->image;
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
                    $image_path = 'images/section_img/' . $image_name;

                    Image::make($image_tmp)->resize(100, 100)->save($image_path);
                }

            }

            $section->admin_id = Auth::guard('admin')->user()->id;
            $section->name = $request->name;
            $section->image = $image_name;
            if(Auth::guard('admin')->user()->type == "Vendor"){
                $section->status = 0;
            }else{
                $section->status = 1;
            }
            $section->save();
            return redirect('admin/section')->with('success_msg', $message);
        }

        return view('admin.catelogue_management.section.add-edit-section', compact('title', 'section'));
    }

    //  DELETE SECTION
    public function destroy($id)
    {
        // echo("hii") ; die;
        Section::find($id)->delete();
        return back()->with('success_msg', 'The Section has been deleted successfully');

        // if($request->ajax()){
        //     $data = $request->all();
        //     // echo $data['delete_id'];
        //     Section::find($data['delete_id'])->delete();

        // }
        // Section::find($delete_id)->delete();
        // return response()->json(['success_msg' => 'deleted']);

    }
}

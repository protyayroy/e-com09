<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Section;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Support\Facades\Session;

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
        } else {
            $title = "Edit Section";
            $section = Section::find($id);
            $message = 'Section has been updated successfully';
        }
        // $section = $section->toArray();
        // dd($section);
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|regex:/^[a-zA-Z0-9\p{Arabic}_]+$/u'
            ]);
            $section->name = $request->name;
            $section->status = 1;
            $section->save();
            return redirect('admin/section')->with('success_msg', $message);
        }

        return view('admin.catelogue_management.section.add-edit-section', compact('title', 'section'));
    }

    //  DELETE SECTION
    public function destroy($id)
    {
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

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Sub_banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class BannerController extends Controller
{
    // VIEW ALL SLIDER IMAGE
    public function slider()
    {
        return view("admin.banner_management.slider-banner", [
            'slider_banners' => Banner::all()
        ]);
    }

    // ADD SLIDER IMAGE FOR BANNER
    public function addSlider(Request $request)
    {
        // dd($request->all());
        if ($request->post()) {
            $request->validate([
                'title' => 'required',
                'slider_image' => 'required'
            ]);
            // UPLOAD SLIDER BANNER
            if ($request->hasFile('slider_image')) {
                $image_tmp = $request->file('slider_image');
                if ($image_tmp->isValid()) {
                    // DELETE PREVIOUS IMAGE
                    // $previous_image_path = 'images/brand_logo/' . $brand->product_image;
                    // if (File::exists($previous_image_path)) {
                    //     File::delete($previous_image_path);
                    // }


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
                    $image_path = 'images/banner_image/slider_img/' . $image_name;

                    Image::make($image_tmp)->resize(1920, 720)->save($image_path);
                }
            }

            $slider = new Banner;
            $slider->admin_id = Auth::guard('admin')->user()->id;
            $slider->banner_title = $request->title;
            $slider->image = $image_name;
            $slider->save();

            return back()->with('success_msg', "Slider Banner Image upload successfully");
        }
    }

    // UPDATE SLIDER IMAGE FOR BANNER
    public function updateSlider(Request $request, $slider_id)
    {
        $slider = Banner::where('id', $slider_id)->first();
        if ($request->post()) {

            $request->validate([
                'edit_slider_image' => 'required'
            ]);

            // UPDATE SLIDER BANNER
            if ($request->hasFile('edit_slider_image')) {
                $image_tmp = $request->file('edit_slider_image');
                if ($image_tmp->isValid()) {
                    // DELETE PREVIOUS IMAGE
                    $previous_image_path = 'images/banner_image/slider_img/' . $slider->image;
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
                    $image_path = 'images/banner_image/slider_img/' . $image_name;

                    Image::make($image_tmp)->resize(1920, 720)->save($image_path);
                }
            }


            $slider->image = $image_name;
            $slider->save();

            return back()->with('success_msg', "Slider Banner Image update successfully");
        }
    }

    // DELETE SLIDER IMAGE
    public function destroy_slider($slider_id)
    {
        $data = Banner::find($slider_id);

        $previous_slider_image_path = 'images/banner_image/slider_img/' . $data->image;
        if (File::exists($previous_slider_image_path)) {
            File::delete($previous_slider_image_path);
        }
        $data->delete();

        return redirect()->back()->with('success_msg', 'Your Slider image has been deleted successfully');
    }

    // VIEW ALL SUB-BANNER IMAGE
    public function subBanner()
    {
        return view("admin.banner_management.sub-banner", [
            'subBanners' => Sub_banner::all()
        ]);
    }

    // ADD SLIDER IMAGE FOR BANNER
    public function addSubBanner(Request $request)
    {
        // dd($request->all());
        if ($request->post()) {
            $request->validate([
                'title' => 'required',
                'subBanner_image' => 'required'
            ]);
            // UPLOAD SLIDER BANNER
            if ($request->hasFile('subBanner_image')) {
                $image_tmp = $request->file('subBanner_image');
                if ($image_tmp->isValid()) {
                    // DELETE PREVIOUS IMAGE
                    // $previous_image_path = 'images/brand_logo/' . $brand->product_image;
                    // if (File::exists($previous_image_path)) {
                    //     File::delete($previous_image_path);
                    // }


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
                    $image_path = 'images/banner_image/sub_banner_img/' . $image_name;

                    Image::make($image_tmp)->resize(1110, 226)->save($image_path);
                }
            }

            $sub_banner = new Sub_banner;
            $sub_banner->admin_id = Auth::guard('admin')->user()->id;
            $sub_banner->sub_banner_title = $request->title;
            $sub_banner->image = $image_name;
            $sub_banner->save();

            return back()->with('success_msg', "Sub-Banner Image upload successfully");
        }
    }

    // UPDATE SLIDER IMAGE FOR BANNER
    public function updateSubBanner(Request $request, $subBanner_id)
    {
        $slider = Sub_banner::where('id', $subBanner_id)->first();
        if ($request->post()) {

            $request->validate([
                'edit_subBanner_image' => 'required'
            ]);

            // UPDATE SLIDER BANNER
            if ($request->hasFile('edit_subBanner_image')) {
                $image_tmp = $request->file('edit_subBanner_image');
                if ($image_tmp->isValid()) {
                    // DELETE PREVIOUS IMAGE
                    $previous_image_path = 'images/banner_image/sub_banner_img/' . $slider->image;
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
                    $image_path = 'images/banner_image/sub_banner_img/' . $image_name;

                    Image::make($image_tmp)->resize(1920, 720)->save($image_path);
                }
            }


            $slider->image = $image_name;
            $slider->save();

            return back()->with('success_msg', "Sub-Banner Image update successfully");
        }
    }

    // DELETE SLIDER IMAGE
    public function destroy_subBanner($subBanner_id)
    {
        $data = Sub_banner::find($subBanner_id);

        $previous_subBanner_image_path = 'images/banner_image/sub_banner_img/' . $data->image;
        if (File::exists($previous_subBanner_image_path)) {
            File::delete($previous_subBanner_image_path);
        }
        $data->delete();

        return redirect()->back()->with('success_msg', 'Your Sub-Banner image has been deleted successfully');
    }


}

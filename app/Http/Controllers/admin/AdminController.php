<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use App\Models\Vendor_bank_detail;
use App\Models\Vendor_business_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    //  VENDOR DETAILS FOR ADMIN VIEW
    public function viewVendorDetails($id)
    {
        $personal = Vendor::with('bank', 'business')->where('id', $id)->first()->toArray();
        $vendor = Admin::where('vendor_id', $id)->first()->toArray();

        return view('admin.admin_management.vendorDetails', compact('personal', 'vendor'));
    }

    //  ADMIN MANAGEMENT
    public function adminManagement($type = null)
    {
        if ($type == 'Admin' || $type == 'Subadmin' || $type == 'Vendor') {
            $admins = Admin::where('type', $type)->get()->toArray();
            $title = $type . 's';
            return view('admin.admin_management.management')->with(compact('type', 'admins', 'title'));
        } else {
            $admins = Admin::get()->toArray();
            $title = $type . ' Admins,Subadmins,Vendors';
            return view('admin/admin_management/management')->with(compact('type', 'admins', 'title'));
        }
    }

    //  UPDATE ADMIN STATUS
    public function updateAdminStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo '<pre/>'; print_r ($data['status']); die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Admin::where('vendor_id', $data['status_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'status_id' => $data['status_id']]);
        }
    }

    // ADD/EDIT VENDOR PERSONAL/BANK/BUSINESS DETAILS
    public function addEditVendorDetails(Request $request, $slug)
    {
        if ($slug == 'personal') {
            if ($request->isMethod('post')) {
                $request->validate([
                    'name' => 'required',
                    'mobile' => 'required|numeric',
                    'address' => 'required',
                    'city' => 'required',
                    'state' => 'required',
                    'country' => 'required',
                    'pincode' => 'required'
                ], [
                    'name.required' => 'Name is required',
                    'mobile.required' => 'Mobile number is required',
                ]);
                $admin = Admin::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first()->toArray();
                if ($request->hasFile('image')) {
                    // Previous image delete
                    $previous_img = 'images/admin/' . $admin['image'];
                    if (File::exists($previous_img)) {
                        File::delete($previous_img);
                    }
                    // New image upload
                    $img = $request->file('image');
                    $image = rand(111, 99999) . '.' . $img->getClientOriginalExtension();
                    $img->move(public_path('images/admin'), $image);
                } else {

                    $image = $admin['image'];
                }

                $data = $request->all();
                // echo '<pre>'; print_r($data); die;

                Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->update([
                    'name' => $data['name'],
                    'address' => $data['address'],
                    'city' => $data['city'],
                    'state' => $data['state'],
                    'country' => $data['country'],
                    'pincode' => $data['pincode'],
                    'mobile' => $data['mobile']
                ]);
                Admin::where('id', Auth::guard('admin')->user()->id)->update([
                    'name' => $data['name'],
                    'mobile' => $data['mobile'],
                    'image' => $image
                ]);

                return back()->with('success_msg', 'Your personal details has been submitted.');
            }
            // VIEW PERSONAL DETAILS
            return view('admin.vendors.personalDetails', [
                'slugs' => $slug,
                'personal' => Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first()->toArray()
            ]);
        } else if ($slug == 'business') {

            $vendor_business_details = Vendor_business_detail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first();
            if (!empty($vendor_business_details)) {
                $vendor_business_details = $vendor_business_details;
            } else {
                $vendor_business_details = new Vendor_business_detail;
            }
            // UPDATE BUSINESS DETAILS
            if ($request->isMethod('post')) {
                $request->validate([
                    'shop_name' => 'required',
                    'shop_email' => 'required|email',
                    'shop_address' => 'required',
                    'shop_city' => 'required',
                    'shop_state' => 'required',
                    'shop_country' => 'required',
                    'shop_pincode' => 'required',
                    'shop_mobile' => 'required|numeric',
                    'shop_website' => 'required',
                    'address_proof' => 'required',
                    'business_license_number' => 'required',
                    'gst_number' => 'required',
                    'pan_number' => 'required'
                ]);

                if ($request->hasFile('address_proof_image')) {
                    // Previous image delete
                    $previous_img = 'images/address_proof_image/' . $vendor_business_details['address_proof_image'];
                    if (File::exists($previous_img)) {
                        File::delete($previous_img);
                    }
                    // New image upload
                    $img = $request->file('address_proof_image');
                    $image = rand(111, 99999) . '.' . $img->getClientOriginalExtension();
                    $img->move(public_path('images/address_proof_image'), $image);
                } else {

                    $image = $vendor_business_details['address_proof_image'];
                }

                $data = $request->all();

                $vendor_business_details->vendor_id = Auth::guard('admin')->user()->vendor_id;
                $vendor_business_details->shop_name = $data['shop_name'];
                $vendor_business_details->shop_email = $data['shop_email'];
                $vendor_business_details->shop_address = $data['shop_address'];
                $vendor_business_details->shop_city = $data['shop_city'];
                $vendor_business_details->shop_state = $data['shop_state'];
                $vendor_business_details->shop_country = $data['shop_country'];
                $vendor_business_details->shop_pincode = $data['shop_pincode'];
                $vendor_business_details->shop_mobile = $data['shop_mobile'];
                $vendor_business_details->shop_website = $data['shop_website'];
                $vendor_business_details->address_proof = $data['address_proof'];
                $vendor_business_details->business_license_number = $data['business_license_number'];
                $vendor_business_details->gst_number = $data['gst_number'];
                $vendor_business_details->pan_number = $data['pan_number'];
                $vendor_business_details->address_proof_image = $image;
                $vendor_business_details->save();

                return back()->with('success_msg', 'Business details has been submitted');
            }


            // VIEW BUSINESS DETAILS
            return view('admin.vendors.businessDetails', [
                'slugs' => $slug,
                'business' => $vendor_business_details
            ]);
        } else if ($slug == 'bank') {
            // UPDATE BUSINESS DETAILS
            $vendor_bank_details = Vendor_bank_detail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first();

            if (!empty($vendor_bank_details)) {
                $vendor_bank_details = $vendor_bank_details;
            } else {
                $vendor_bank_details = new Vendor_bank_detail;
            }


            if ($request->isMethod('post')) {
                $request->validate([
                    'account_holder_name' => 'required',
                    'bank_name' => 'required',
                    'account_number' => 'required',
                    'bank_ifsc_code' => 'required'
                ]);

                $data = $request->all();
                // echo '<pre>'; print_r($data); die;

                $vendor_bank_details->vendor_id = Auth::guard('admin')->user()->vendor_id;
                $vendor_bank_details->account_holder_name = $data['account_holder_name'];
                $vendor_bank_details->bank_name = $data['bank_name'];
                $vendor_bank_details->account_number = $data['account_number'];
                $vendor_bank_details->bank_ifsc_code = $data['bank_ifsc_code'];
                $vendor_bank_details->save();

                return back()->with('success_msg', 'Bank details has been submitted');
            }

            // VIEW BUSINESS DETAILS
            return view('admin.vendors.bankDetails', [
                'slugs' => $slug,
                'bank' => $vendor_bank_details
            ]);
        }
    }

    //  VIEW DASHBOARD
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    //  UPDATE ADMIN PROFILE && VIEW PROFILE
    public function updateAdminProfile(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|regex:/^[a-zA-Z0-9\p{Arabic}_]+ [a-zA-Z0-9\p{Arabic}_]+$/u',
                'mobile' => 'required|numeric'
            ], [
                'name.required' => 'Name is required',
                'mobile.required' => 'Mobile number is required',
            ]);

            $admin = Admin::where('id', Auth::guard('admin')->user()->id)->first()->toArray();
            if ($request->hasFile('image')) {
                // Previous image delete
                $previous_img = 'images/admin/' . $admin['image'];
                if (File::exists($previous_img)) {
                    File::delete($previous_img);
                }
                // New image upload
                $img = $request->file('image');
                $image = rand(111, 99999) . '.' . $img->getClientOriginalExtension();
                $img->move(public_path('images/admin'), $image);
            } else {

                $image = $admin['image'];
            }

            $data = $request->all();
            // echo "<pre>"; var_dump($image); die;
            Admin::where('email', Auth::guard('admin')->user()->email)->update([
                'name' => $data['name'],
                'mobile' => $data['mobile'],
                'image' => $image
            ]);
            return back()->with('success_msg', 'Profile has been updated');
        }

        return view('admin.setting.update-profile')->with([
            'admins' => Admin::where('email', Auth::guard('admin')->user()->email)->first()->toArray()
        ]);
    }

    //  UPDATE ADMIN PASSWORD && VIEW PAGE
    public function changeAdminPassword(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->validate([
                'current_password' => 'required',
                'new_password' => 'required',
                'confirm_password' => 'required'
            ], [
                'current_password.required' => 'Current password is required',
                'new_password.required' => 'New password is required',
                'confirm_password.required' => 'Confirm password is required',
            ]);
            $data = $request->all();

            // echo '<br><br><br>';echo '<pre>'; print_r($data);
            if (Hash::check($data['current_password'], Auth::guard('admin')->user()->password)) {
                if ($data['new_password'] !== $data['confirm_password']) {
                    return back()->with('error', 'Confirm password does not match');
                } else {
                    Admin::where('id', Auth::guard('admin')->user()->id)->update([
                        'password' => bcrypt($data['confirm_password'])
                    ]);
                    return redirect()->back()->with('success', 'Password update successful');
                }
            } else {
                return back()->with('error', 'Password does not match');
            }
        }

        return view('admin.setting.change-password');
    }

    //  CHECKING ADMIN PASSWORD IF IT WRONG OR RIGHT
    public function checkAdminPassword(Request $request)
    {
        $data = $request->all();
        // echo "<pre>"; print_r($data); die;
        if ($data['password'] == "") {
            return "";
        } else if (Hash::check($data['password'], Auth::guard('admin')->user()->password)) {
            return 'true';
        } else {
            return 'false';
        }
    }

    //  LOGIN ADMIN
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            if (Auth::guard('admin')->attempt([
                'email' => $data['email'], 'password' => $data['password']
            ])) {
                return redirect('/admin/dashboard');
            } else {
                return redirect()->back()->with('error_msg', 'Invalid Email or Password');
            }
        }
        return view('admin.login');
    }

    //  LOGOUT ADMIN
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }
}

<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function vendor()
    {
        return view("customer.vendor.vendor-login-registration");
    }

    // USER REGISTRATION
    public function registration(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:8',
            'confirm_password' => 'required',
            // 'terms' => 'accepted'
        ], [
            // 'terms.accepted' => 'Terms and Condition must be accepted.'
        ]);

        if ($validator->passes()) {
            if ($request->password === $request->confirm_password) {

                $vendor = new Vendor;
                $vendor->name = $request->name;
                $vendor->email =  $request->email;
                $vendor->password = Hash::make($request->password);
                $vendor->status = 0;
                $vendor->save();

                $adminData = new Admin;
                $adminData->name = $vendor->name;
                $adminData->type = "Vendor";
                $adminData->vendor_id = $vendor->id;
                $adminData->email = $vendor->email;
                $adminData->password = $vendor->password;
                $adminData->email_confirmation = "No";
                $adminData->status = 0;
                $adminData->save();

                $email = $request->email;
                $messageData = [
                    'name' => $request->name,
                    'code' => base64_encode($email)
                ];
                Mail::send('mails.vendor_confirmation', $messageData, function ($message) use ($email) {
                    $message->to($email)->subject('Confirm your e-com09 vendor account');
                });

                return response()->json([
                    "status" => true, "success_msg" => "Please confirm your Mail to login your E-com09 Vendor account!"
                ]);
            } else {
                return response()->json([
                    "status" => false, "error_msg" => "Confirm password doesn't match!"
                ]);
            }
        } else {
            return response()->json([
                "status" => "validation", "errors" => $validator->messages()
            ]);
        }
    }

    // VENDOR ACCOUNT CONFORMATION BY MAIL
    public function confirm($code)
    {
        // dd($code);
        // $countVendor = Admin::where('email', base64_decode($code))->count();
        $adminData = Admin::where('email', base64_decode($code))->first();
        if (!empty($adminData)) {
            // $vendor = Vendor::where('email', base64_decode($code))->first();
            // $vendor->status = 1;
            // $vendor->save();

            // $adminData = new Admin;
            // $adminData->name = $vendor->name;
            // $adminData->type = "Vendor";
            // $adminData->vendor_id = $vendor->id;
            // $adminData->email = $vendor->email;
            // $adminData->password = $vendor->password;
            // $adminData->status = 0;
            // $adminData = Admin::where('email', base64_decode($code))->first();

            $adminData->email_confirmation = "Yes";
            $adminData->save();

            return redirect('vendor/login-registration')->with('success_msg', "<strong>Success:</strong> Your account is activated. Now you can Login!");
        }
    }

    // VENDOR LOGIN
    public function login(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->passes()) {

            if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
                $vendor = Admin::where(['email' => $request->email, 'password' => Hash::check(Auth::guard('admin')->user()->password, $request->password)])->first();
                if ($vendor->email_confirmation == "Yes") {
                    return response()->json([
                        "status" => true, "url" => url('admin/dashboard')
                    ]);
                } else {
                    return response()->json([
                        "status" => false, "error_msg" => "Your account is not active. Please confirm your email!"
                    ]);
                }
            } else {
                return response()->json([
                    "status" => false, "error_msg" => "Your Email or Password doesn't match!"
                ]);
            }
        } else {
            return response()->json([
                "status" => "validation", "errors" => $validator->messages()
            ]);
        }
    }
}

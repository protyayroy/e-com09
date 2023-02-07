<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UserAccount extends Controller
{
    // VIEW USER LOGIN/REGISTRATION PAGE
    public function viewPage()
    {
        if (Auth::check() < 1) {

            return view('customer.user-login-registration');
        } else {
            return redirect('/cart');
        }
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
                // $status = 0;
                // User::create([
                //     'name' => $request->name,
                //     'email' => $request->email,
                //     'password' => Hash::make($request->password),
                //     'status' => $status,
                // ]);

                $user = new User;
                $user->name = $request->name;
                $user->email =  $request->email;
                $user->password = Hash::make($request->password);
                $user->status = 0;
                $user->save();


                $email = $request->email;
                $messageData = [
                    'name' => $request->name,
                    'code' => base64_encode($email)
                ];
                Mail::send('mails.user_confirmation', $messageData, function($message)use($email){
                    $message->to($email)->subject('Confirm your e-com09 account');
                });

                // Mail::send('Html.view', $data, function ($message) {
                //     $message->from('john@johndoe.com', 'John Doe');
                //     $message->sender('john@johndoe.com', 'John Doe');
                //     $message->to('john@johndoe.com', 'John Doe');
                //     $message->cc('john@johndoe.com', 'John Doe');
                //     $message->bcc('john@johndoe.com', 'John Doe');
                //     $message->replyTo('john@johndoe.com', 'John Doe');
                //     $message->subject('Subject');
                //     $message->priority(3);
                //     $message->attach('pathToFile');
                // });

                return response()->json([
                    "status" => true, "success_msg" => "Please confirm your Mail to activate your account!"
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

    // USER LOGIN
    public function login(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->passes()) {

            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                if (Auth::user()->status == 1) {
                    // return redirect('/cart')->back();
                    return response()->json([
                        "status" => true, "url" => url('/cart')
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

    // USER ACCOUNT CONFORMATION BY MAIL
    public function confirm($code){
        $user = User::where('email', base64_decode($code))->count();
        if($user > 0){
            User::where('email', base64_decode($code))->update(['status' => 1]);
            return redirect('user/login-registration')->with('success_msg', "<strong>Success:</strong> Your account is activated. Now you can Login!");
        }
    }

    // USER LOGOUT
    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect('user/login-registration');
    }
}

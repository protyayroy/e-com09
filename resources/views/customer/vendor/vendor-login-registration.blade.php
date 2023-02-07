@extends('customer.layouts.layout')

@section('content')
    <!-- Page Introduction Wrapper -->
    <div class="page-style-a">
        <div class="container">
            <div class="page-intro">
                <h2>Account</h2>
                <ul class="bread-crumb">
                    <li class="has-separator">
                        <i class="ion ion-md-home"></i>
                        <a href="index.html">Home</a>
                    </li>
                    <li class="is-marked">
                        <a href="account.html">Account</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Page Introduction Wrapper /- -->
    <!-- Account-Page -->
    <div class="page-account u-s-p-t-80">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    @if (Session::has('success_msg'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{-- <strong>Success:</strong> {{ Session('success_msg') }}! --}}
                            @php
                                echo Session('success_msg');
                            @endphp
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif
                </div>
                <!-- Login -->
                <div class="col-lg-6">
                    <div class="login-wrapper">

                        <div class="alert alert-dismissible d-none login_message" role="alert" style="border-radius: 5px">
                            @php
                                echo '<span id="login_message"></span>';
                            @endphp
                            <button type="button" class="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <h2 class="account-h2 u-s-m-b-20">Login</h2>
                        <h6 class="account-h6 u-s-m-b-30">Welcome back! Sign in to your account.</h6>
                        <form action="javascript:" method="get" id="vendor_login_form">
                            @csrf
                            <div class="u-s-m-b-30">
                                <label for="user-name-email">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" id="user-name-email" class="text-field" placeholder="Email"
                                    name="email">
                                <small id="login_email" class="text-danger click_hide"></small>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="login-password">Password
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="login-password" class="text-field" placeholder="Password"
                                    name="password">
                                <small id="login_password" class="text-danger click_hide"></small>
                            </div>
                            {{-- <div class="group-inline u-s-m-b-30">
                                <div class="group-1">
                                    <input type="checkbox" class="check-box" id="remember-me-token">
                                    <label class="label-text" for="remember-me-token">Remember me</label>
                                </div>
                                <div class="group-2 text-right">
                                    <div class="page-anchor">
                                        <a href="lost-password.html">
                                            <i class="fas fa-circle-o-notch u-s-m-r-9"></i>Lost your password?</a>
                                    </div>
                                </div>
                            </div> --}}
                            <div class="m-b-45">
                                <button class="button button-outline-secondary w-100">Login</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Login /- -->
                <!-- Register -->
                <div class="col-lg-6">
                    <div class="reg-wrapper">

                        <div class="alert alert-dismissible d-none reg_message" role="alert"
                            style="border-radius: 5px">
                            @php
                                echo '<span id="reg_message"></span>';
                            @endphp
                            <button type="button" class="close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <h2 class="account-h2 u-s-m-b-20">Register</h2>
                        <h6 class="account-h6 u-s-m-b-30">Registering for this site allows you to access your order status
                            and history.</h6>
                        <form action="javascript:" method="post" id="vendor_reg_form">
                            @csrf
                            <div class="u-s-m-b-30">
                                <label for="user-name">Username
                                    <span class="astk">*</span>
                                </label>
                                <input type="text" id="user-name" class="text-field" placeholder="Username"
                                    name="name" value="{{ old('name') }}">

                                <small id="reg_name" class="text-danger click_hide"></small>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="email">Email
                                    <span class="astk">*</span>
                                </label>
                                <input type="email" id="email" class="text-field" placeholder="Email" name="email"
                                    value="{{ old('email') }}">

                                <small id="reg_email" class="text-danger click_hide"></small>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="password">Password
                                    <span class="astk">*</span> <small class="ml-2">(Password has to be minimum 8
                                        characters)</small>
                                </label>
                                <input type="password" id="password" class="text-field" placeholder="Password"
                                    name="password">

                                <small id="reg_password" class="text-danger click_hide"></small>
                            </div>
                            <div class="u-s-m-b-30">
                                <label for="confirm_password">Confirm Password
                                    <span class="astk">*</span>
                                </label>
                                <input type="password" id="confirm_password" class="text-field"
                                    placeholder="Confirm Password" name="confirm_password">

                                <small id="reg_confirm_password" class="text-danger click_hide"></small>
                            </div>
                            <div class="u-s-m-b-30">
                                <input type="checkbox" class="check-box" id="accept" name="terms"
                                    value="{{ old('terms') }}">
                                <label class="label-text no-color" for="accept">I’ve read and accept the
                                    <a href="terms-and-conditions.html" class="text-primary">terms & conditions</a>
                                </label>
                                <div>

                                    <small id="reg_accept" class="text-danger click_hide"></small>
                                </div>
                            </div>
                            <div class="u-s-m-b-45">
                                <button class="button button-primary w-100">Register</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Register /- -->
            </div>
        </div>
    </div>
    <!-- Account-Page /- -->
@endsection

@extends('admin.layouts.layout')

@section('title', '| Settings')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card offset-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Change Password</h4>
                    @if(Session::has('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error: </strong> {{ Session('error') }}!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    @if(Session::has('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success: </strong> {{ Session('success') }}!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <form class="forms-sample" action="{{ url ('admin/change-password') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label>Name:</label>
                            <input value="{{ Auth::guard('admin')->user()->name }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="current_password">Current Password:</label>
                            <input type="password" class="form-control" id="current_password" name="current_password" placeholder="Enter Current Password">
                            <span class="err_password"></span>
                            @error('current_password')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="new_password">New Password:</label>
                            <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password">
                            @error('new_password')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Confirm Password:</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Enter Confirm Password">
                            @error('confirm_password')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Change Password</button>
                        <!-- <button class="btn btn-light">Cancel</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
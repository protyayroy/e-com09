@extends('admin.layouts.layout')

@section('title', '| Settings')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card offset-1">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Profile</h4>

                    @if(Session::has('success_msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success:</strong> {{ Session('success_msg') }}!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <form class="forms-sample" action="{{ url ('admin/update-profile') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label>Email:</label>
                            <input value="{{ $admins['email'] }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label>Role:</label>
                            <input value="{{ $admins['type'] }}" class="form-control" readonly>
                        </div>
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input value="{{ $admins['name'] }}" class="form-control" id="name" name="name">
                            @error('name')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="mobile">Mobile Number:</label>
                            <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $admins['mobile'] }}">
                            <span class="err_password"></span>
                            @error('mobile')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Profile Picture:</label>
                            <input type="file" class="form-control" id="image" name="image">
                            @error('image')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Update Profile</button>
                        <!-- <button class="btn btn-light">Cancel</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
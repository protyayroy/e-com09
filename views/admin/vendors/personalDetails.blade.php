@extends('admin.layouts.layout')

@section('title', '| Personal Details')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Personal Details</h4>
                    @if(Session::has('success_msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success:</strong> {{ Session('success_msg') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif

                    <form class="forms-sample" action="{{ url ('admin/details/'.$slugs) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email:</label>
                                    <input value="{{ $personal['email'] }}" class="form-control" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name:</label>
                                    <input value="{{ $personal['name'] }}" class="form-control" id="name" name="name" type="text">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address">Address:</label>
                                    <input value="{{ $personal['address'] }}" class="form-control" id="address" name="address" type="text">
                                    @error('address')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="city">City:</label>
                                    <input value="{{ $personal['city'] }}" class="form-control" id="city" name="city" type="text">
                                    @error('city')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="state">State:</label>
                                    <input value="{{ $personal['state'] }}" class="form-control" id="state" name="state" type="text">
                                    @error('state')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="country">Country:</label>
                                    <input value="{{ $personal['country'] }}" class="form-control" id="country" name="country" type="text">
                                    @error('country')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pincode">Pincode:</label>
                                    <input value="{{ $personal['pincode'] }}" class="form-control" id="pincode" name="pincode" type="text">
                                    @error('pincode')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="mobile">Mobile Number:</label>
                                    <input type="text" class="form-control" id="mobile" name="mobile" value="{{ $personal['mobile'] }}">
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
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%;">Update Personal Details</button>
                        <!-- <button class="btn btn-light">Cancel</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

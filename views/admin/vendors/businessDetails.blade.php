@extends('admin.layouts.layout')

@section('title', '| Business Details')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Business Details</h4>
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
                                    <label for="shop_name">Shop Name:</label>
                                    <input value="{{ $business['shop_name'] }}" class="form-control" id="shop_name" name="shop_name" type="text">
                                    @error('shop_name')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="shop_email">Shop Email:</label>
                                    <input value="{{ $business['shop_email'] }}" class="form-control" id="shop_email" name="shop_email" type="email">
                                    @error('shop_email')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="shop_address">Shop Address:</label>
                                    <input value="{{ $business['shop_address'] }}" class="form-control" id="shop_address" name="shop_address" type="text">
                                    @error('shop_address')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="shop_city">Shop city:</label>
                                    <input value="{{ $business['shop_city'] }}" class="form-control" id="shop_city" name="shop_city" type="text">
                                    @error('shop_city')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="shop_state">Shop State:</label>
                                    <input value="{{ $business['shop_state'] }}" class="form-control" id="shop_state" name="shop_state" type="text">
                                    @error('shop_state')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="shop_pincode">Shop Pincode:</label>
                                    <input value="{{ $business['shop_pincode'] }}" class="form-control" id="shop_pincode" name="shop_pincode">
                                    @error('shop_pincode')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="shop_country">Shop Country:</label>
                                    <input type="text" class="form-control" id="shop_country" name="shop_country" value="{{ $business['shop_country'] }}">
                                    @error('shop_country')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="shop_pincode">Shop Pincode:</label>
                                    <input type="text" class="form-control" id="shop_pincode" name="shop_pincode" value="{{ $business['shop_pincode'] }}">
                                    @error('shop_pincode')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="shop_mobile">Shop Mobile:</label>
                                    <input type="text" class="form-control" id="shop_mobile" name="shop_mobile" value="{{ $business['shop_mobile'] }}">
                                    @error('shop_mobile')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="shop_website">Shop Website:</label>
                                    <input type="text" class="form-control" id="shop_website" name="shop_website" value="{{ $business['shop_website'] }}">
                                    @error('shop_website')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address_proof">Shop Address Proof:</label>
                                    <input type="text" class="form-control" id="address_proof" name="address_proof" value="{{ $business['address_proof'] }}">
                                    @error('address_proof')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="business_license_number">Business License Number:</label>
                                    <input type="text" class="form-control" id="business_license_number" name="business_license_number" value="{{ $business['business_license_number'] }}">
                                    @error('business_license_number')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="gst_number">GST Number:</label>
                                    <input type="text" class="form-control" id="gst_number" name="gst_number" value="{{ $business['gst_number'] }}">
                                    @error('gst_number')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="pan_number">Pan Number:</label>
                                    <input type="text" class="form-control" id="pan_number" name="pan_number" value="{{ $business['pan_number'] }}">
                                    @error('pan_number')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="address_proof_image">Address Proof Image:</label>
                                    <input type="file" class="form-control" id="address_proof_image" name="address_proof_image">
                                    @error('address_proof_image')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" style="width:100%;">Update Business Details</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
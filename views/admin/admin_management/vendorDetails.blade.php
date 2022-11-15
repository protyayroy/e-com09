@extends('admin.layouts.layout')

@section('title', '| Vendor Details')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Personal Details</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Name:</th>
                                <td>{{ $personal['name']}}</td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td>{{ $personal['email']}}</td>
                            </tr>
                            <tr>
                                <th>Address:</th>
                                <td>{{ $personal['address']}}</td>
                            </tr>
                            <tr>
                                <th>City:</th>
                                <td>{{ $personal['city']}}</td>
                            </tr>
                            <tr>
                                <th>State:</th>
                                <td>{{ $personal['state']}}</td>
                            </tr>
                            <tr>
                                <th>Country:</th>
                                <td>{{ $personal['country']}}</td>
                            </tr>
                            <tr>
                                <th>Pincode</th>
                                <td>{{ $personal['pincode']}}</td>
                            </tr>
                            <tr>
                                <th>Mobile:</th>
                                <td>{{ $personal['mobile']}}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Bank Details</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Account Holder Name:</th>
                                <td>{{ $bank['account_holder_name']}}</td>
                            </tr>
                            <tr>
                                <th>Bank Name:</th>
                                <td>{{ $bank['bank_name']}}</td>
                            </tr>
                            <tr>
                                <th>Account Number:</th>
                                <td>{{ $bank['account_number']}}</td>
                            </tr>
                            <tr>
                                <th>Bank IFIC Number:</th>
                                <td>{{ $bank['bank_ifsc_code']}}</td>
                            </tr>
                        </table>
                    </div>
                    <div class="row vendor_img mt-5">
                        <div class="col-md-6">
                            <div class="title mb-2">
                                <h4>
                                    {{ $personal['name']}} Image:
                                </h4>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="image">
                                <a href="{{ url('images/admin/'.$vendor['image']) }}" target="_blank">
                                    <img height="200px" src="{{ url('images/admin/'.$vendor['image']) }}" alt="$vendor['image']">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Business Details</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <tr>
                                <th>Shop Name:</th>
                                <td>{{ $business['shop_name']}}</td>
                            </tr>
                            <tr>
                                <th>Shop Email:</th>
                                <td>{{ $business['shop_email']}}</td>
                            </tr>
                            <tr>
                                <th>Shop Address:</th>
                                <td>{{ $business['shop_address']}}</td>
                            </tr>
                            <tr>
                                <th>Shop City:</th>
                                <td>{{ $business['shop_city']}}</td>
                            </tr>
                            <tr>
                                <th>Shop State:</th>
                                <td>{{ $business['shop_state']}}</td>
                            </tr>
                            <tr>
                                <th>Shop Country:</th>
                                <td>{{ $business['shop_country']}}</td>
                            </tr>
                            <tr>
                                <th>Shop Pincode</th>
                                <td>{{ $business['shop_pincode']}}</td>
                            </tr>
                            <tr>
                                <th>Mobile:</th>
                                <td>{{ $business['shop_mobile']}}</td>
                            </tr>
                            <tr>
                                <th>Shop Website:</th>
                                <td>{{ $business['shop_website']}}</td>
                            </tr>
                            <tr>
                                <th>Address Proof:</th>
                                <td>{{ $business['address_proof']}}</td>
                            </tr>
                            <tr>
                                <th>Business License Number:</th>
                                <td>{{ $business['business_license_number']}}</td>
                            </tr>
                            <tr>
                                <th>GST number:</th>
                                <td>{{ $business['gst_number']}}</td>
                            </tr>
                            <tr>
                                <th>Pan Number:</th>
                                <td>{{ $business['pan_number']}}</td>
                            </tr>
                            <tr>
                                <th>Address Proof Image:</th>
                                <td class="address_proof_image">
                                    <img src="{{ url('images/address_proof_image/'.$business['address_proof_image']) }}" alt="{{ $business['address_proof_image'] }}">
                                    <a href="{{ url('images/address_proof_image/'.$business['address_proof_image']) }}" target="_blank" class="ml-5 text-danger" style="font-size: 16px;">
                                        View Image
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
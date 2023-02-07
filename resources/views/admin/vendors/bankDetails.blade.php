@extends('admin.layouts.layout')

@section('title', '| Bank Details')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Update Bank Details</h4>
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

                        <div class="form-group">
                            <label for="account_holder_name">Accout Holder Name:</label>
                            <input value="{{ $bank['account_holder_name'] }}" class="form-control" id="account_holder_name" name="account_holder_name" type="text">
                            @error('account_holder_name')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bank_name">Bank Name:</label>
                            <input value="{{ $bank['bank_name'] }}" class="form-control" id="bank_name" name="bank_name" type="text">
                            @error('bank_name')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="account_number">Account Number:</label>
                            <input value="{{ $bank['account_number'] }}" class="form-control" id="account_number" name="account_number" type="text">
                            @error('account_number')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="bank_ifsc_code">Bank IFIC Code:</label>
                            <input value="{{ $bank['bank_ifsc_code'] }}" class="form-control" id="bank_ifsc_code" name="bank_ifsc_code" type="text">
                            @error('bank_ifsc_code')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Update Bank Details</button>
                        <!-- <button class="btn btn-light">Cancel</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

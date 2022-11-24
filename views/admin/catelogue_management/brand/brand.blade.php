@extends('admin.layouts.layout')

@section('title', '| Brand Management')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Brands</h4>
                    @if(Session::has('success_msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success:</strong> {{ Session('success_msg') }}!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <a href="{{ url('admin/add-edit-brand') }}" class="btn btn-success block float-right mb-4">Add Brand</a>
                    <div class="clr"></div>
                    <div class="table-responsive">
                        <table id="bootstrap_datatable" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th> #Id </th>
                                    <th> Name: </th>
                                    <th> Status: </th>
                                    <th> Action: </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($brands as $brand)
                                <tr>
                                    <td> {{ $loop->index + 1 }} </td>
                                    <td> {{ $brand['name'] }} </td>
                                    <td class="status_collum">
                                        @if($brand['status'] == 1)
                                        <a href="javascript:void(0)" class="change_status text-primary" id="brand-{{ $brand['id'] }}" status_id="{{ $brand['id'] }}" status_path="brand">
                                            <i class="mdi mdi-checkbox-marked-circle" status="Active"></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="change_status text-primary" id="brand-{{ $brand['id'] }}" status_id="{{ $brand['id'] }}" status_path="brand">
                                            <i class="mdi mdi-checkbox-blank-circle-outline" status="Inactive"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td class="action_collum">
                                        <a href="{{ url('admin/add-edit-brand/'.$brand['id']) }}" class="text-info">
                                            <i class="mdi mdi-table-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="delete_row text-danger" delete_id="{{ $brand['id'] }}" delete_path="brand">
                                            <i class="mdi mdi-delete-forever"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

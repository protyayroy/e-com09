@extends('admin.layouts.layout')

@section('title', '| Admin Management')

@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <div class="table-responsive">
                        <table id="bootstrap_datatable" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        @if($type != 'All')
                                        {{ $type }}s
                                        @else
                                        {{ $type }}
                                        @endif
                                    </th>
                                    <th> Name: </th>
                                    <th> Role: </th>
                                    <th> Email: </th>
                                    <th> Mobile: </th>
                                    <th> Status: </th>

                                    @if($type == 'Vendor' || $type == 'All')
                                    <th> Details: </th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($admins as $admin)
                                <tr>
                                    <td class="py-1">
                                        <img src="{{ url('images/admin/'.$admin['image']) }}" alt="image">
                                    </td>
                                    <td> {{ $admin['name'] }} </td>
                                    <td> {{ $admin['type'] }} </td>
                                    <td> {{ $admin['email'] }} </td>
                                    <td> {{ $admin['mobile'] }} </td>
                                    <td class="status_collum">
                                        @if($admin['status'] == 1)
                                        <a href="javascript:void(0)" class="change_status" id="admin-{{ $admin['vendor_id'] }}" status_id="{{ $admin['vendor_id'] }}" status_path="admin">
                                            <i class="mdi mdi-checkbox-marked-circle" status="Active"></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="change_status" id="admin-{{ $admin['vendor_id'] }}" status_id="{{ $admin['vendor_id'] }}" status_path="admin">
                                            <i class="mdi mdi-checkbox-blank-circle-outline" status="Inactive"></i>
                                        </a>
                                        @endif
                                    </td>

                                    @if($type == 'Vendor' || $type == 'All')
                                    <td>

                                        @if( $admin['type'] == 'Vendor')
                                        <a href="{{ url('admin/vendor-details/'.$admin['vendor_id']) }}" class="vendor_details" target="_blank">
                                            <i class="mdi mdi-receipt"></i>
                                        </a>
                                        @endif

                                    </td>
                                    @endif

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
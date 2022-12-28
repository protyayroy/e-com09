@php
    use App\Models\Products_filter;
@endphp

@extends('admin.layouts.layout')

@section('title', '| Filter Value Management')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Filter Value</h4>
                    @if(Session::has('success_msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success:</strong> {{ Session('success_msg') }}!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <a href="{{ url('admin/filter') }}" class="btn btn-warning block mb-4">Back to Filter</a>
                    <a href="{{ url('admin/add-edit-filter-value') }}" class="btn btn-success block float-right mb-4">Add Filter Value</a>
                    <div class="clr"></div>
                    <div class="table-responsive">
                        <table id="bootstrap_datatable" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th> #Id </th>
                                    <th> Filter Ids: </th>
                                    <th> Filter Ids Name: </th>
                                    <th> Filter Value: </th>
                                    <th> Status: </th>
                                    <th> Action: </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($filterValues as $filterValue)
                                <tr>
                                    <td> {{ $loop->index + 1 }} </td>
                                    <td> {{ $filterValue['filter_id'] }} </td>
                                    <td>
                                        @php
                                            $filterName = Products_filter::filterName($filterValue['filter_id']);
                                            echo $filterName;
                                        @endphp
                                    </td>
                                    <td> {{ $filterValue['filter_value'] }} </td>
                                    <td class="status_collum">
                                        @if($filterValue['status'] == 1)
                                        <a href="javascript:void(0)" class="change_status text-primary" id="filter-value-{{ $filterValue['id'] }}" status_id="{{ $filterValue['id'] }}" status_path="filter-value">
                                            <i class="mdi mdi-checkbox-marked-circle" status="Active"></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="change_status text-primary" id="filter-value-{{ $filterValue['id'] }}" status_id="{{ $filterValue['id'] }}" status_path="filter-value">
                                            <i class="mdi mdi-checkbox-blank-circle-outline" status="Inactive"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td class="action_collum">
                                        <a href="{{ url('admin/add-edit-filter-value/'.$filterValue['id']) }}" class="text-info">
                                            <i class="mdi mdi-table-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="delete_row text-danger" delete_id="{{ $filterValue['id'] }}" delete_path="filter-value">
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

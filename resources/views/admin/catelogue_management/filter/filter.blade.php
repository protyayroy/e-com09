@php
    use App\Models\Category;

@endphp
@extends('admin.layouts.layout')

@section('title', '| Products Filter Management')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Products Filters</h4>
                        @if (Session::has('success_msg'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>Success:</strong> {{ Session('success_msg') }}!
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <a href="{{ url('admin/filter-value') }}" class="btn btn-info block mb-4">View
                            Filter Values</a>

                        <a href="{{ url('admin/add-edit-filter') }}" class="btn btn-success block float-right mb-4">Add
                            Filter Column in Products table</a>
                        <div class="clr"></div>
                        <div class="table-responsive">
                            <table id="bootstrap_datatable" class="table table-striped table-bordered nowrap"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th> #Id </th>
                                        <th> Filter Name: </th>
                                        <th> Filter Categories: </th>
                                        <th> Filter Column: </th>
                                        <th> Status: </th>
                                        <th> Action: </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($filters as $filter)
                                        <tr>
                                            <td> {{ $loop->index + 1 }} </td>
                                            <td> {{ $filter['filter_name'] }} </td>
                                            <td>
                                                @php
                                                    $catIds = explode(',', $filter['cat_ids']);
                                                    foreach ($catIds as $key => $value) {
                                                        $categoryName = Category::getCatName($value);
                                                        echo $categoryName.", ";
                                                    }
                                                @endphp
                                            </td>
                                            <td> {{ $filter['filter_column'] }} </td>
                                            <td class="status_collum">
                                                @if ($filter['status'] == 1)
                                                    <a href="javascript:void(0)" class="change_status text-primary"
                                                        id="filter-{{ $filter['id'] }}" status_id="{{ $filter['id'] }}"
                                                        status_path="filter">
                                                        <i class="mdi mdi-checkbox-marked-circle" status="Active"></i>
                                                    </a>
                                                @else
                                                    <a href="javascript:void(0)" class="change_status text-primary"
                                                        id="filter-{{ $filter['id'] }}" status_id="{{ $filter['id'] }}"
                                                        status_path="filter">
                                                        <i class="mdi mdi-checkbox-blank-circle-outline"
                                                            status="Inactive"></i>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="action_collum">
                                                <a href="{{ url('admin/add-edit-filter/' . $filter['id']) }}"
                                                    class="text-info">
                                                    <i class="mdi mdi-table-edit"></i>
                                                </a>
                                                <a href="javascript:void(0)" class="delete_row text-danger"
                                                    delete_id="{{ $filter['id'] }}" delete_path="filter">
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

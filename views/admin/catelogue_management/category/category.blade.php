@extends('admin.layouts.layout')

@section('title', '| Category Management')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Categories</h4>
                    @if(Session::has('success_msg'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success:</strong> {{ Session('success_msg') }}!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @endif
                    <a href="{{ url('admin/add-edit-category') }}" class="btn btn-success block float-right mb-4">Add Category</a>
                    <div class="clr"></div>
                    <div class="table-responsive">
                        <table id="bootstrap_datatable" class="table table-striped table-bordered nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th> #Id </th>
                                    <th> Name: </th>
                                    <th> parent id: </th>
                                    <th> Section: </th>
                                    <th> Discount: </th>
                                    <th> Image: </th>
                                    <th> Status: </th>
                                    <th> Action: </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($categories as $category)
                                <tr>
                                    <td> {{ $loop->index + 1 }} </td>
                                    <td> {{ $category['name'] }} </td>
                                    <td>
                                        @if($category['parent_id'] == 0)
                                        Root
                                        @else
                                        $category['parent_id']
                                        @endif
                                    </td>
                                    <td> {{ $category['section']['name'] }} </td>
                                    <td> {{ $category['discount'] }} </td>
                                    <td>
                                        <a href="">
                                            <img src="{{ url('images/category_img/'.$category['image']) }}" alt="{{ $category['image'] }}">
                                        </a>
                                    </td>
                                    <td class="status_collum">
                                        @if($category['status'] == 1)
                                        <a href="javascript:void(0)" class="change_status" id="category-{{ $category['id'] }}" status_id="{{ $category['id'] }}" status_path="category">
                                            <i class="mdi mdi-checkbox-marked-circle" status="Active"></i>
                                        </a>
                                        @else
                                        <a href="javascript:void(0)" class="change_status" id="category-{{ $category['id'] }}" status_id="{{ $category['id'] }}" status_path="category">
                                            <i class="mdi mdi-checkbox-blank-circle-outline" status="Inactive"></i>
                                        </a>
                                        @endif
                                    </td>
                                    <td class="action_collum">
                                        <a href="{{ url('admin/add-edit-category/'.$category['id']) }}">
                                            <i class="mdi mdi-table-edit"></i>
                                        </a>
                                        <a href="javascript:void(0)" class="delete_row" delete_id="{{ $category['id'] }}" delete_path="category">
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
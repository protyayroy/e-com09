@extends('admin.layouts.layout')

@section('title', '| Brand Management')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$title}}</h4>
                    <a href="{{ url('admin/brand') }}" class="btn btn-success float-right">Back</a>
                    <div class="clr"></div>
                    
                    <form class="forms-sample" action="@if(isset($brands['id']) && !empty($brands['id'])) {{ url('admin/add-edit-brand/'.$brands['id']) }} @else {{ url('admin/add-edit-brand') }}  @endif" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Brand Name:</label>
                            <input type="text" class="form-control" id="name" name="name" 
                            value="@if(isset($brands['id']) && !empty($brands['id'])) {{ $brands['name'] }} @else {{ old('name') }}  @endif">
                            @error('name')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">
                            @if($title == 'Add Brand')
                                Add Brand
                            @else
                                Update Brand
                            @endif
                        </button>
                        <!-- <button class="btn btn-light">Cancel</button>  -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
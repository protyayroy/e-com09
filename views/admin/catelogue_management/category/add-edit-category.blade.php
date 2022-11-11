@extends('admin.layouts.layout')

@section('title', '| Category Management')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <a href="{{ url('admin/category') }}" class="btn btn-success float-right">Back</a>
                    <div class="clr"></div>

                    <form class="forms-sample" action="@if(isset($categories['id']) && !empty($categories['id'])) {{ url('admin/add-edit-category/'.$categories['id']) }} @else {{ url('admin/add-edit-category') }}  @endif" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Category Name:</label>
                                    <input type="text" class="form-control" id="name" name="name" value="@if(isset($categories['id']) && !empty($categories['id'])) {{ $categories['name'] }} @else {{ old('name') }}  @endif">
                                    @error('name')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="section_id">Category Section:</label>
                                    <select name="section_id" id="section_id" class="form-control">
                                        
                                        <option value="" selected disabled>Please select a Section name</option>
                                        @foreach($sections as $section)

                                        <option value="" @if(isset($categories['id']) && !empty($categories['id'])) selected @endif>{{$section['name']}}</option>
                                        @endforeach

                                    </select>
                                    @error('name')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="discount">Category Discount:</label>
                                    <input type="text" class="form-control" id="discount" name="discount" value="@if(isset($categories['id']) && !empty($categories['id'])) {{ $categories['discount'] }} @else {{ old('discount') }}  @endif">
                                    @error('discount')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="description">Category Description:</label>
                                    <input type="text" class="form-control" id="description" name="description" value="@if(isset($categories['id']) && !empty($categories['id'])) {{ $categories['description'] }} @else {{ old('description') }}  @endif">
                                    @error('description')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="url">Category Url:</label>
                                    <input type="text" class="form-control" id="url" name="url" value="@if(isset($categories['id']) && !empty($categories['id'])) {{ $categories['url'] }} @else {{ old('url') }}  @endif">
                                    @error('url')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="meta_title">Category Meta Title:</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="@if(isset($categories['id']) && !empty($categories['id'])) {{ $categories['meta_title'] }} @else {{ old('meta_title') }}  @endif">
                                    @error('meta_title')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_description">Category Meta Description:</label>
                                    <input type="text" class="form-control" id="meta_description" name="meta_description" value="@if(isset($categories['id']) && !empty($categories['id'])) {{ $categories['meta_description'] }} @else {{ old('meta_description') }}  @endif">
                                    @error('meta_description')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meta_keywords">Category Meta Keywords:</label>
                                    <input type="text" class="form-control" id="meta_keywords" name="meta_keywords" value="@if(isset($categories['id']) && !empty($categories['id'])) {{ $categories['meta_keywords'] }} @else {{ old('meta_keywords') }}  @endif">
                                    @error('meta_keywords')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">Category Image:</label>
                                    <input type="file" class="form-control" id="image" name="image">
                                    @error('image')
                                    <div class="text-danger">{{ $message }}*</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-12 mt-2">
                                <button type="submit" class="btn btn-primary w-100">
                                    @if($title == 'Add Category')
                                    Add Category
                                    @else
                                    Update Category
                                    @endif
                                </button>
                            </div>
                        </div>
                        <!-- <button class="btn btn-light">Cancel</button>  -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
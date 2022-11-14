@extends('admin.layouts.layout')

@section('title', '| Section Management')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{ $title }}</h4>
                    <a href="{{ url('admin/section') }}" class="btn btn-success float-right">Back</a>
                    <div class="clr"></div>

                    <form class="forms-sample" action="{{ isset($section['id']) && !empty($section['id']) ? url('admin/add-edit-section/'.$section['id']) : url('admin/add-edit-section') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="name">Section Name:</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ isset($section['id']) && !empty($section['id']) ? $section['name'] : old('name') }}">
                            @error('name')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">
                            @if($title == 'Add Section')
                                Add Section
                            @else
                                Update Section
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

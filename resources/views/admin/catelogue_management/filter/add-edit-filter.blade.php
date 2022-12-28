@extends('admin.layouts.layout')

@section('title', '| Products Filter Management')

@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ $title }}</h4>
                        <a href="{{ url('admin/filter') }}" class="btn btn-warning float-right">Back</a>
                        <div class="clr"></div>
                        <form class="forms-sample"
                            action="{{ isset($filter['id']) && !empty($filter['id']) ? url('admin/add-edit-filter/' . $filter['id']) : url('admin/add-edit-filter') }}"
                            method="post">
                            @csrf
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="filter_name">Products Filter Name:</label>
                                        <input type="text" class="form-control" id="filter_name" name="filter_name"
                                            value="{{ isset($filter['id']) && !empty($filter['id']) ? $filter['filter_name'] : old('filter_name') }}">
                                        @error('name')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="filter_column">Products Filter Column Name:</label>
                                        <input type="text" class="form-control" id="filter_column" name="filter_column"
                                            value="{{ isset($filter['id']) && !empty($filter['id']) ? $filter['filter_column'] : old('filter_column') }}">
                                        @error('filter_column')
                                            <div class="text-danger">{{ $message }}*</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h4>Select Product Filter Category</h4>
                                    <div class="form-group">
                                        @foreach ($categories as $category)
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="checkbox" class="form-check-input" value="{{ $category['id'] }}" name="cat_ids[]">
                                                    {{ $category['name'] }}
                                                    <i class="input-helper"></i>
                                                    @foreach ($category['subcategory'] as $subcat)
                                                        <div class="form-check">
                                                            <label class="form-check-label ml-3">
                                                                <input type="checkbox" class="form-check-input" value="{{ $subcat['id'] }}" name="cat_ids[]">
                                                                {{ $subcat['name'] }}
                                                                <i class="input-helper"></i>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </label>
                                            </div>
                                        @endforeach
                                        {{-- <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="checkbox" class="form-check-input" checked="">
                                                Checked
                                                <i class="input-helper"></i></label>
                                        </div> --}}
                                    </div>
                                </div>
                                <div class="col-12">

                                    <button type="submit" class="btn btn-primary mr-2 w-100">
                                        @if ($title == 'Add Products Filter')
                                            Add Products Filter
                                        @else
                                            Update Products Filter
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

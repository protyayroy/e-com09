@extends('admin.layouts.layout')

@section('title', '| Filter Value Management')

@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">{{$title}}</h4>
                    <a href="{{ url('admin/filter-value') }}" class="btn btn-warning float-right">Back</a>
                    <div class="clr"></div>
                    <form class="forms-sample" action="{{ isset($filterValue['id']) && !empty($filterValue['id']) ? url('admin/add-edit-filter-value/'.$filterValue['id']) : url('admin/add-edit-filter-value') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <label for="filter_value">Filter Value:</label>
                            <select name="filter_id" id="filter_id" class="form-control">
                                <option selected disabled>Select Filter Name</option>
                                @foreach ($filters as $filter)
                                    <option value="{{ $filter['id'] }}" {{ (isset($filterValue['filter_id'])) && ($filterValue['filter_id'] == $filter['id']) ? 'selected' : '' }}>{{ $filter['filter_name'] }}</option>
                                @endforeach
                            </select>
                            @error('filter_id')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="filter_value">Filter Value:</label>
                            <input type="text" class="form-control" id="filter_value" name="filter_value"
                            value="{{ isset($filterValue['id']) && !empty($filterValue['id']) ? $filterValue['filter_value'] : old('filter_value') }}">
                            @error('filter_value')
                            <div class="text-danger">{{ $message }}*</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">
                            @if($title == 'Add Filter Value')
                                Add Filter Value
                            @else
                                Update Filter Value
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

@php
    use App\Models\Products_filter;

    $productFilters = Products_filter::productFilters();
    // var_dump($proFilterCatIds)  ;
    if(isset($products['category_id'])){
        $category_id = $products['category_id'];
    }
@endphp

@foreach ($productFilters as $filter)

    @if (isset($category_id))
        @php
            $filterAvailable = Products_filter::filterAvailable($filter['id'], $category_id);
            // print_r($filterAvailable) ;
        @endphp
        @if ($filterAvailable == 'Yes')
            @if (count($filter['getFilterValue']) > 0)
                <div class="form-group">
                    <label for="{{ $filter['filter_column'] }}">{{ $filter['filter_name'] }}:</label>
                    <select name="{{ $filter['filter_column'] }}" id="{{ $filter['filter_column'] }}" class="form-control">
                        <option disabled selected> Select {{ $filter['filter_column'] }} Type</option>
                        @foreach ($filter['getFilterValue'] as $filterValue)
                            <option {{ (isset($products['id'])) && ($products[$filter['filter_column']] == $filterValue['filter_value']) ? 'selected' : ''}}>&nbsp;{{ $filterValue['filter_value'] }}</option>
                        @endforeach
                    </select>
                    @error($filter['filter_column'])
                        <div class="text-danger">{{ $message }}*</div>
                    @enderror
                </div>
            @endif
        @endif
    @else
        {{-- @if (count($filter['getFilterValue']) > 0)
            <div class="form-group">
                <label for="{{ $filter['filter_column'] }}">{{ $filter['filter_name'] }}:</label>
                <select name="{{ $filter['filter_column'] }}" id="{{ $filter['filter_column'] }}" class="form-control">
                    <option disabled selected> Select {{ $filter['filter_column'] }} Type
                    </option>
                    @foreach ($filter['getFilterValue'] as $filterValue)
                        <option>&nbsp;{{ $filterValue['filter_value'] }}</option>
                    @endforeach
                </select>
                @error($filter['filter_column'])
                    <div class="text-danger">{{ $message }}*</div>
                @enderror
            </div>
        @endif --}}
    @endif
@endforeach

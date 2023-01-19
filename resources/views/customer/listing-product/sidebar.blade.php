@php
    use App\Models\Products_filter;

    $productFilters = Products_filter::productFilters();

@endphp

<div class="col-lg-3 col-md-3 col-sm-12">

    <div class="fetch-categories">
        <h3 class="title-name" style="font-size: 15px;color: #333">Browse Categories</h3>

        @foreach ($productFilters as $filter)
            @php
                // echo "<pre>";
                // var_dump($categoryDetails['categoryDetails']['id']);
                $filterAvailable = Products_filter::filterAvailable($filter['id'], $categoryDetails['categoryDetails']['id']);
                // print_r($filterAvailable) ;
            @endphp
            @if ($filterAvailable == 'Yes')
                @if (count($filter['getFilterValue']) > 0)
                    <div class="facet-filter-associates">
                        <h3 class="title-name" style="color: #444">{{ $filter['filter_name'] }}</h3>

                        <form class="facet-form" action="#" method="post">
                            <div class="associate-wrapper">
                                @foreach ($filter['getFilterValue'] as $filterValue)
                                    <input type="checkbox" class="check-box {{ $filter['filter_column'] }}"
                                        value="{{ $filterValue['filter_value'] }}"
                                        name="{{ $filter['filter_column'] }}[]" id="{{ $filterValue['filter_value'] }}">
                                    <label class="label-text"
                                        for="{{ $filterValue['filter_value'] }}">{{ $filterValue['filter_value'] }}
                                        <span class="total-fetch-items">(0)</span>
                                    </label>
                                @endforeach
                            </div>
                        </form>
                    </div>
                @endif
            @endif
        @endforeach
    </div>

    <!-- Fetch-Categories-from-Root-Category  /- -->
    <!-- Filters -->
    <!-- Filter-Size -->

    {{-- <div class="facet-filter-associates">
        <h3 class="title-name">Size</h3>
        <form class="facet-form" action="#" method="post">
            <div class="associate-wrapper">
                <input type="checkbox" class="check-box" id="cbs-01">
                <label class="label-text" for="cbs-01">Male 2XL
                    <span class="total-fetch-items">(2)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-02">
                <label class="label-text" for="cbs-02">Male 3XL
                    <span class="total-fetch-items">(2)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-03">
                <label class="label-text" for="cbs-03">Kids 4
                    <span class="total-fetch-items">(0)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-04">
                <label class="label-text" for="cbs-04">Kids 6
                    <span class="total-fetch-items">(0)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-05">
                <label class="label-text" for="cbs-05">Kids 8
                    <span class="total-fetch-items">(0)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-06">
                <label class="label-text" for="cbs-06">Kids 10
                    <span class="total-fetch-items">(2)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-07">
                <label class="label-text" for="cbs-07">Kids 12
                    <span class="total-fetch-items">(2)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-08">
                <label class="label-text" for="cbs-08">Female Small
                    <span class="total-fetch-items">(0)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-09">
                <label class="label-text" for="cbs-09">Male Small
                    <span class="total-fetch-items">(0)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-10">
                <label class="label-text" for="cbs-10">Female Medium
                    <span class="total-fetch-items">(0)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-11">
                <label class="label-text" for="cbs-11">Male Medium
                    <span class="total-fetch-items">(0)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-12">
                <label class="label-text" for="cbs-12">Female Large
                    <span class="total-fetch-items">(0)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-13">
                <label class="label-text" for="cbs-13">Male Large
                    <span class="total-fetch-items">(0)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-14">
                <label class="label-text" for="cbs-14">Female XL
                    <span class="total-fetch-items">(0)</span>
                </label>
                <input type="checkbox" class="check-box" id="cbs-15">
                <label class="label-text" for="cbs-15">Male XL
                    <span class="total-fetch-items">(0)</span>
                </label>
            </div>
        </form>
    </div> --}}

    <!-- Filter-Size -->
    <!-- Filter-Color -->
    <div class="facet-filter-associates">
        <h3 class="title-name">Color</h3>
        <form class="facet-form" action="#" method="post">
            <div class="associate-wrapper">
                @foreach ($productColors as $color)
                    <input type="checkbox" class="check-box product_color" id="{{ $color['product_color'] }}" value="{{ $color['product_color'] }}" name="color[]">
                    <label class="label-text" for="{{ $color['product_color'] }}">{{ $color['product_color'] }}
                        <span class="total-fetch-items">(0)</span>
                    </label>
                @endforeach
            </div>
        </form>
    </div>
    <!-- Filter-Color /- -->
    <!-- Filter-Brand -->
    <div class="facet-filter-associates">
        <h3 class="title-name">Brand</h3>
        <form class="facet-form" action="#" method="post">
            <div class="associate-wrapper">
                @foreach ($productBrands as $brand_id)
                    <input type="checkbox" class="check-box product_brand" id="{{ $brand_id['brand']['name'] }}" value="{{ $brand_id['brand_id'] }}">
                    <label class="label-text" for="{{ $brand_id['brand']['name'] }}">{{ $brand_id['brand']['name'] }}
                        <span class="total-fetch-items">(0)</span>
                    </label>
                @endforeach

            </div>
        </form>
    </div>
    <!-- Filter-Brand /- -->
    <!-- Filter-Price -->
    <div class="facet-filter-by-price">
        <h3 class="title-name">Price</h3>
        <form class="facet-form" action="#" method="post">
            <!-- Final-Result -->
            <div class="amount-result clearfix">
                <div class="price-from">$0</div>
                <div class="price-to">$3000</div>
            </div>
            <!-- Final-Result /- -->
            <!-- Range-Slider  -->
            <div class="price-filter"></div>
            <!-- Range-Slider /- -->
            <!-- Range-Manipulator -->
            <div class="price-slider-range" data-min="0" data-max="5000" data-default-low="0"
                data-default-high="3000" data-currency="$"></div>
            <!-- Range-Manipulator /- -->
            <button type="submit" class="button button-primary">Filter</button>
        </form>
    </div>
    <!-- Filter-Price /- -->
    <!-- Filter-Free-Shipping -->
    <div class="facet-filter-by-shipping">
        <h3 class="title-name">Shipping</h3>
        <form class="facet-form" action="#" method="post">
            <input type="checkbox" class="check-box" id="cb-free-ship">
            <label class="label-text" for="cb-free-ship">Free Shipping</label>
        </form>
    </div>
    <!-- Filter-Free-Shipping /- -->
    <!-- Filter-Rating -->
    <div class="facet-filter-by-rating">
        <h3 class="title-name">Rating</h3>
        <div class="facet-form">
            <!-- 5 Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:76px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">(0)</span>
            </div>
            <!-- 5 Stars /- -->
            <!-- 4 & Up Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:60px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">& Up (5)</span>
            </div>
            <!-- 4 & Up Stars /- -->
            <!-- 3 & Up Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:45px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">& Up (0)</span>
            </div>
            <!-- 3 & Up Stars /- -->
            <!-- 2 & Up Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:30px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">& Up (0)</span>
            </div>
            <!-- 2 & Up Stars /- -->
            <!-- 1 & Up Stars -->
            <div class="facet-link">
                <div class="item-stars">
                    <div class='star'>
                        <span style='width:15px'></span>
                    </div>
                </div>
                <span class="total-fetch-items">& Up (0)</span>
            </div>
            <!-- 1 & Up Stars /- -->
        </div>
    </div>
    <!-- Filter-Rating -->
    <!-- Filters /- -->
</div>

{{-- @section('jquery')

@endsection --}}

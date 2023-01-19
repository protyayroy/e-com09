@php
    use App\Models\Products_filter;

    $productFilters = Products_filter::productFilters();

@endphp

<script>
    $(document).ready(function() {

        $("#sort").on("change", function() {

            // this.form.submit();

            var color = get_filter('product_color');
            var brand = get_filter('product_brand');
            var sort = $(this).val();
            var url = $("#url").val();
            @foreach ($productFilters as $filters)
                var {{ $filters['filter_column'] }} = get_filter('{{ $filters['filter_column'] }}');
            @endforeach

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "post",
                data: {
                    sort: sort,
                    url: url,
                    color: color,
                    brand: brand,
                    @foreach ($productFilters as $filters)
                        {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                    @endforeach
                },
                success: function(data) {
                    // alert(data)
                    $(".grid-style").html(data);
                    $(".list-style").html(data);
                },
                error: function() {
                    alert("Error")
                }
            })
        });

        $(".product_brand").on("click", function() {
            var color = get_filter('product_color');
            var brand = get_filter('product_brand');
            var sort = $("#sort").val();
            var url = $("#url").val();
            @foreach ($productFilters as $filters)
                var {{ $filters['filter_column'] }} = get_filter('{{ $filters['filter_column'] }}');
            @endforeach
            // alert(color);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "post",
                data: {
                    sort: sort,
                    url: url,
                    color: color,
                    brand: brand,
                    @foreach ($productFilters as $filters)
                        {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                    @endforeach
                },
                success: function(data) {
                    // alert(data)
                    $(".grid-style").html(data);
                    $(".list-style").html(data);
                },
                error: function() {
                    alert("Error")
                }
            })
        })

        $(".product_color").on("click", function() {
            var color = get_filter('product_color');
            var brand = get_filter('product_brand');
            var sort = $("#sort").val();
            var url = $("#url").val();
            @foreach ($productFilters as $filters)
                var {{ $filters['filter_column'] }} = get_filter('{{ $filters['filter_column'] }}');
            @endforeach
            // alert(color);

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: "post",
                data: {
                    sort: sort,
                    url: url,
                    color: color,
                    brand: brand,
                    @foreach ($productFilters as $filters)
                        {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                    @endforeach
                },
                success: function(data) {
                    // alert(data)
                    $(".grid-style").html(data);
                    $(".list-style").html(data);
                },
                error: function() {
                    alert("Error")
                }
            })
        })

        @foreach ($productFilters as $filter)

            $('.{{ $filter['filter_column'] }}').on("click", function() {

                // alert();

                var color = get_filter('product_color');
                var brand = get_filter('product_brand');
                var url = $("#url").val();
                var sort = $("#sort option:selected").val();
                @foreach ($productFilters as $filters)
                    var {{ $filters['filter_column'] }} = get_filter(
                        '{{ $filters['filter_column'] }}');
                @endforeach
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: "post",
                    data: {
                        sort: sort,
                        url: url,
                        color: color,
                        brand: brand,
                        @foreach ($productFilters as $filters)
                            {{ $filters['filter_column'] }}: {{ $filters['filter_column'] }},
                        @endforeach
                    },
                    success: function(data) {
                        // alert(data)
                        $(".grid-style").html(data);
                        $(".list-style").html(data);
                    },
                    error: function() {
                        alert("Error")
                    }
                })
            })
        @endforeach

        // $('.fabric').on("click", function() {
        //     // alert('url');
        //     var url = $("#url").val();
        //     var sort = $("#sort").val();
        //     var fabric = get_filter('fabric');
        //     $.ajax({
        //         headers: {
        //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //         },
        //         url: url,
        //         type: "post",
        //         data: {
        //             sort: sort,
        //             url: url,
        //             fabric: fabric
        //         },
        //         success: function(data) {
        //             // alert(data)
        //             $(".grid-style").html(data);
        //             $(".list-style").html(data);
        //         },
        //         error: function() {
        //             alert("Error")
        //         }
        //     })
        // })

        // DYNAMIK PROCUCT CHANGE BY COLOR VARIANT
        $(document).on("click", "#same_product", function(e) {
            e.preventDefault()
            var pro_val = $(this).attr('pro_val');
            // alert(pro_val);
            // window.location = "/single-product/"+pro_val;
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/single-product/" + pro_val,
                type: "get",
                success: function(data) {
                    // alert(data);
                    $("body").html(data);
                },error: function() {
                    alert("Error");
                }
            })
        });

        // DYNAMIK PROCUCT PRICE CHANGE BY SIZE VARIANT
        $(document).on("change", ".product-size", function(e) {
            var product_id = $(this).attr('pro_val');
            alert(product_id);
        });
    })
</script>

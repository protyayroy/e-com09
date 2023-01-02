@php
    use App\Models\Products_filter;

    $productFilters = Products_filter::productFilters();

@endphp

<script>
    $(document).ready(function() {
        $("#sort").on("change", function() {

            // this.form.submit();
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

        @foreach ($productFilters as $filter)

            $('.{{ $filter['filter_column'] }}').on("click", function() {

                // alert();
                var url = $("#url").val();
                var sort = $("#sort").val();
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

    })
</script>

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
                    $("#product_details").html(data);
                },
                error: function() {
                    alert("Error");
                }
            })
        });


        // DYNAMIK PROCUCT PRICE CHANGE BY SIZE VARIANT
        $(document).on("change", ".product-size", function(e) {
            var attr_id = $('option:selected', this).attr('attribute_id');
            var size = $(this).val();
            // alert(attr_id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/get_attr_price/"+attr_id,
                type: "get",
                success: function(data){

                    $("#quantity").attr('max', data.stock);
                    $("#save_price").val(data.getNewPrice);
                    $("#get_stock").val(data.stock);

                    if(data.stock > 0){
                        var stock = "<span class=''> In Stock </span>";
                    }else{
                        var stock = "<span class='text-danger'> Out of stock </span>";
                    }
                    $(".dynamic_price").html('<div class="section-3-price-original-discount u-s-p-y-14"><div class="price"><h4>&#x9F3; '+data.getNewPrice+'</h4></div><div class="original-price"><span>Original Price:</span><span> &#x9F3; '+data.original_price+'</span></div><div class="discount-price"><span>Discount:</span><span> '+data.discount+'%</span></div><div class="total-save"><span>Save:</span><span> &#x9F3; '+data.discountPrice+'</span></div></div><div class="section-4-sku-information u-s-p-y-14"><h6 class="information-heading u-s-m-b-8">Sku Information:</h6><div class="availability"><span>Availability:</span>'+stock+'</div><div class="left"><span>Only:</span><span> '+data.stock+' left</span></div></div>');
                },error: function(){
                    alert("Error");
                }
            })
        });

        // CART UPDATE BY AJAX WITHOUT LOAD
        $(document).on("click", ".cart_update", function(){
            var quantity = $(this).closest('tr').find("#quantity").val();
            var cart_id = $(this).data('cart_id');
            var stock = $(this).data('max');
            // alert(stock_id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'update-cart',
                type: "post",
                data: {
                    quantity: quantity,
                    cart_id: cart_id,
                    stock: stock
                },
                success: function(data){
                    if (data.status == false) {
                        // alert(data.error_msg);
                        $("#message").html(data.error_msg);
                        $("#d-none").addClass('d-block alert-danger').fadeIn();
                        $("#d-none").removeClass('alert-success');
                    }
                    if (data.status == true) {
                        // $("#user_name").html('<label>Name *</label><input type="text" class="form-control" name="user_name" value="'+data.user_name+'" required>');
                        $("#d-none").addClass('d-block alert-success');
                        $("#d-none").removeClass('alert-danger');
                        $("#message").html(data.success_msg);
                        // $('body').html(data.view);
                        // alert(data.user_name);
                    }
                    // alert(data);
                    // $('body').html();
                },error: function(){
                    alert("Error");
                }
            })
        });

        // CART UPDATE BY AJAX WITHOUT LOAD
        $(document).on("keyup", "#quantity", function(){
            var quantity = $(this).val();
            var cart_id = $(this).closest('tr').find('.cart_update').data('cart_id');
            var stock = $(this).closest('tr').find('.cart_update').data('max');
            // alert(stock_id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: 'update-cart',
                type: "post",
                data: {
                    quantity: quantity,
                    cart_id: cart_id,
                    stock: stock
                },
                success: function(data){
                    if (data.status == false) {
                        $("#message").html(data.error_msg);
                        $("#d-none").addClass('d-block alert-danger').fadeIn();
                        $("#d-none").removeClass('alert-success');
                    }
                    if (data.status == true) {
                        $("#d-none").addClass('d-block alert-success');
                        $("#d-none").removeClass('alert-danger');
                        $("#message").html(data.success_msg);
                        // $('#ajax-load').html(data.view);
                        // alert(data.user_name);
                    }
                },error: function(){
                    alert("Error");
                }
            })
        });



        $("#close").click(function() {
            $("#d-none").removeClass('d-block');
        });

        // setInterval(() => {
        //     $("#d-none").removeClass('d-block').fadeOut()
        // }, 10000);


    })
</script>

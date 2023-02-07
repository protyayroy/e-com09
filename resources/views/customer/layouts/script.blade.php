@php
    use App\Models\Products_filter;

    $productFilters = Products_filter::productFilters();

@endphp

<script>
    $(document).ready(function() {

        // SORT BASE PROCUCT FILTER
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

        // BRAND BASE PROCUCT FILTER
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

        // COLOR BASE PROCUCT FILTER
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

        // DYNAMIK PROCUCT FILTER
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
                url: "/get_attr_price/" + attr_id,
                type: "get",
                success: function(data) {

                    $("#quantity").attr('max', data.stock);
                    $("#save_price").val(data.getNewPrice);
                    $("#get_stock").val(data.stock);

                    if (data.stock > 0) {
                        var stock = "<span class=''> In Stock </span>";
                    } else {
                        var stock = "<span class='text-danger'> Out of stock </span>";
                    }
                    $(".dynamic_price").html(
                        '<div class="section-3-price-original-discount u-s-p-y-14"><div class="price"><h4>&#x9F3; ' +
                        data.getNewPrice +
                        '</h4></div><div class="original-price"><span>Original Price:</span><span> &#x9F3; ' +
                        data.original_price +
                        '</span></div><div class="discount-price"><span>Discount:</span><span> ' +
                        data.discount +
                        '%</span></div><div class="total-save"><span>Save:</span><span> &#x9F3; ' +
                        data.discountPrice +
                        '</span></div></div><div class="section-4-sku-information u-s-p-y-14"><h6 class="information-heading u-s-m-b-8">Sku Information:</h6><div class="availability"><span>Availability:</span>' +
                        stock + '</div><div class="left"><span>Only:</span><span> ' +
                        data.stock + ' left</span></div></div>');
                },
                error: function() {
                    alert("Error");
                }
            })
        });

        // CART UPDATE BY AJAX WITHOUT LOAD
        $(document).on("click", ".cart_update", function() {
            $(".loader").show();
            var quantity = $(this).closest('tr').find("#quantity").val();
            var cart_id = $(this).data('cart_id');
            var stock = $(this).data('stock');

            if ($(this).hasClass('plus-a')) {
                if (quantity < $(this).data("max")) {
                    var quantity = parseInt(quantity) + 1;
                    $(this).closest('tr').find("#quantity").val(quantity);
                }
            }
            if ($(this).hasClass('minus-a')) {
                if ($(this).data("min") < quantity) {
                    var quantity = parseInt(quantity) - 1;
                    $(this).closest('tr').find("#quantity").val(quantity);
                }
            }

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
                success: function(data) {
                    if (data.status == false) {
                        // alert(data.error_msg);
                        $("#message").html(data.error_msg);
                        $("#d-none").addClass('d-block alert-danger').fadeIn();
                        $("#d-none").removeClass('alert-success');
                        // $('#cart_items').html(data.view);
                        // $('.total').html('&#x9F3; '+ data.price);
                        $('#cart_items').html(data.view);
                        $('.total').html('&#x9F3; ' + data.cartTotalPrice);
                        $('.mini-cart-list').html(data.mini_cart);
                        $('#cart_count').html(data.countCartItems);
                        $('.cart_total_price').html("&#x9F3; " + data.cartTotalPrice);
                    } else if (data.status == true) {
                        // $("#user_name").html('<label>Name *</label><input type="text" class="form-control" name="user_name" value="'+data.user_name+'" required>');
                        $("#d-none").addClass('d-block alert-success');
                        $("#d-none").removeClass('alert-danger');
                        $("#message").html(data.success_msg);
                        $('#cart_items').html(data.view);
                        $('.total').html('&#x9F3; ' + data.cartTotalPrice);
                        $('.mini-cart-list').html(data.mini_cart);
                        $('#cart_count').html(data.countCartItems);
                        $('.cart_total_price').html("&#x9F3; " + data.cartTotalPrice);
                        // alert(data.cartItems);
                    }
                },
                error: function() {
                    alert("Error");
                }
            })
        });

        // CART UPDATE BY AJAX WITHOUT LOAD
        $(document).on("keyup", "#quantity", function() {
            $(".loader").show();
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
                success: function(data) {
                    if (data.status == false) {
                        $("#message").html(data.error_msg);
                        $("#d-none").addClass('d-block alert-danger').fadeIn();
                        $("#d-none").removeClass('alert-success');
                        // $('#cart_items').html(data.view);
                        // $('.total').html('&#x9F3; '+ data.price);
                        $('#cart_items').html(data.view);
                        $('.total').html('&#x9F3; ' + data.cartTotalPrice);
                        $('.mini-cart-list').html(data.mini_cart);
                        $('#cart_count').html(data.countCartItems);
                        $('.cart_total_price').html("&#x9F3; " + data.cartTotalPrice);
                    } else if (data.status == true) {
                        $("#d-none").addClass('d-block alert-success');
                        $("#d-none").removeClass('alert-danger');
                        $("#message").html(data.success_msg);
                        // $('#cart_items').html(data.view);
                        // $('.total').html('&#x9F3; '+ data.price);
                        $('#cart_items').html(data.view);
                        $('.total').html('&#x9F3; ' + data.cartTotalPrice);
                        $('.mini-cart-list').html(data.mini_cart);
                        $('#cart_count').html(data.countCartItems);
                        $('.cart_total_price').html("&#x9F3; " + data.cartTotalPrice);
                    }
                },
                error: function() {
                    alert("Error");
                }
            })
        });

        // DELETE CART ITEM
        $(document).on("click", "#delete-cart", function(e) {
            e.preventDefault();
            var result = confirm('Are you sure to delete this Cart item?');
            if (result) {
                $(".loader").show();

                var cart_id = $(this).data('id');
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "delete-cart-item/" + cart_id,
                    type: "get",
                    success: function(data) {
                        if (data.status == true) {
                            $("#d-none").addClass('d-block alert-success');
                            $("#d-none").removeClass('alert-danger');
                            $("#message").html(data.success_msg);
                            $('#cart_items').html(data.view);
                            $('.total').html('&#x9F3; ' + data.cartTotalPrice);
                            $('.mini-cart-list').html(data.mini_cart);
                            $('#cart_count').html(data.countCartItems);
                            $('.cart_total_price').html("&#x9F3; " + data.cartTotalPrice);
                        }
                    }
                })
            }
        })

        // USER REGISTRATION FORM SUBMIT
        $("#user_reg_form").submit(function() {
            $(".loader").show();
            var formData = $(this).serialize();
            $.ajax({
                url: "registration",
                type: "post",
                data: formData,
                success: function(data) {
                    $('.click_hide').hide();
                    $('.click_hide').html("");
                    if (data.status == "validation") {
                        $.each(data.errors, function(i, error) {
                            $('.click_hide').fadeIn();
                            $("#reg_" + i).html(error);
                        })
                    } else if (data.status == false) {
                        $(".reg_message").addClass('d-block alert-danger');
                        $("#reg_message").html(data.error_msg);
                    } else if (data.status == true) {
                        $(".reg_message").addClass('d-block alert-success');
                        $("#reg_message").html(data.success_msg);
                    }
                }
            })
        });

        // USER LOGIN FORM SUBMIT
        $("#user_login_form").submit(function() {
            $(".loader").show();
            var formData = $(this).serialize();
            // alert(formData);
            $.ajax({
                url: "login",
                type: "get",
                data: formData,
                success: function(data) {
                    $('.click_hide').hide();
                    $('.click_hide').html("");
                    if (data.status == "validation") {
                        $.each(data.errors, function(i, error) {
                            $('.click_hide').fadeIn();
                            $("#login_" + i).html(error)
                        })
                    } else if (data.status == false) {
                        $(".login_message").addClass('d-block alert-danger');
                        $("#login_message").html(data.error_msg);
                    } else if (data.status == true) {
                        // $(".login_message").addClass('d-block alert-success');
                        // $("#login_message").html(data.success_msg);
                        window.location.href = data.url;
                    }
                },
                error: function() {
                    alert("Error");
                }
            })
        });

        // VENDOR REGISTRATION FORM SUBMIT
        $("#vendor_reg_form").submit(function() {
            $(".loader").show();
            var formData = $(this).serialize();
            $.ajax({
                url: "registration",
                type: "post",
                data: formData,
                success: function(data) {
                    $('.click_hide').hide();
                    $('.click_hide').html("");
                    if (data.status == "validation") {
                        $.each(data.errors, function(i, error) {
                            $('.click_hide').fadeIn();
                            $("#reg_" + i).html(error);
                        })
                    } else if (data.status == false) {
                        $(".reg_message").addClass('d-block alert-danger');
                        $("#reg_message").html(data.error_msg);
                    } else if (data.status == true) {
                        $(".reg_message").addClass('d-block alert-success');
                        $("#reg_message").html(data.success_msg);
                    }
                }
            })
        });

        // VENDOR LOGIN FORM SUBMIT
        $("#vendor_login_form").submit(function() {
            $(".loader").show();
            var formData = $(this).serialize();
            // alert(formData);
            $.ajax({
                url: "login",
                type: "get",
                data: formData,
                success: function(data) {
                    $('.click_hide').hide();
                    $('.click_hide').html("");
                    if (data.status == "validation") {
                        $.each(data.errors, function(i, error) {
                            $('.click_hide').fadeIn();
                            $("#login_" + i).html(error)
                        })
                    } else if (data.status == false) {
                        $(".login_message").addClass('d-block alert-danger');
                        $("#login_message").html(data.error_msg);
                    } else if (data.status == true) {
                        // $(".login_message").addClass('d-block alert-success');
                        // $("#login_message").html(data.success_msg);
                        window.location.href = data.url;
                    }
                },
                error: function() {
                    alert("Error");
                }
            })
        });




        // LOODER HIDE INTERVEL FUNCTION
        setInterval(() => {
            $(".loader").hide();
        }, 1500);

        // MESSAGE BOX CLOSE FUNCTION
        $(".close").click(function() {
            $(".d-none").removeClass('d-block');
        });

        // MESSAGE BOX INTERVEL FUNCTION
        setInterval(() => {
            $(".d-none").removeClass('d-block')
        }, 15000);


    })
</script>

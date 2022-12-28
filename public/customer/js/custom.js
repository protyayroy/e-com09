$(document).ready(function(){
    $("#sort").on("change", function(){

        // this.form.submit();

        var sort = $(this).val();
        var url = $("#url").val();
        // alert(url)
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: url,
            type: "post",
            data: {
                sort: sort,
                url: url
            },
            success: function(data){
                // alert(data)
                $(".grid-style").html(data);
                $(".list-style").html(data);
            }, error: function(){
                alert("Error")
            }
        })
    })
})

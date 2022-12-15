// BOOTSTRAP DATATABLE
$(document).ready(function () {
    $('#bootstrap_datatable').DataTable();
});

// CHECK CURRENT PASSWORD RIGHT OR WRONG
$("#current_password").on("keyup", function () {
    var password = $(this).val()
    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: 'check-password',
        type: 'post',
        data: {
            password: password
        },
        success: function (data) {
            // alert(data)
            if (data == "true") {
                $('#check_password').html("<font color='green'>Your password match successfuly</font>")
            } else if (data == "false") {
                $('#check_password').html("<font color='red'>Your password is wrong</font>")
            } else {
                $('#check_password').html("")
            }
        }, error: function () {
            alert("Error")
        }
    });
})

// CHANGE STATUS ACTIVE OR INACTIVE WITH SWEET ALERT
$(document).on("click", ".change_status", function () {
    // SWEET ALERT START
    Swal.fire({
        title: 'Are you sure?',
        text: "You want to change status!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, change this!'
    }).then((result) => {
        if (result.isConfirmed) {
            //   Swal.fire(
            //     'Deleted!',
            //     'Your file has been deleted.',
            //     'success'
            //   )

            // CHANGE STATUS CODE START
            var status = $(this).children('i').attr('status');
            var status_id = $(this).attr('status_id');
            var path = $(this).attr('status_path');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: path + '-status',
                type: "post",
                data: {
                    status: status,
                    status_id: status_id
                },
                success: function (data) {
                    // alert(data['status'])
                    if (data['status'] == 0) {
                        $("#" + path + "-" + status_id).html('<i class="mdi mdi-checkbox-blank-circle-outline" status="Inactive"></i>')
                    } else if (data['status'] == 1) {
                        $("#" + path + "-" + status_id).html('<i class="mdi mdi-checkbox-marked-circle" status="Active"></i>')
                    }
                }, error: function () {
                    alert("Error")
                }
            })
        }
    })
})

// DELETE WITH SWEET ALERT
$(document).on("click", ".delete_row", function () {

    // SWEET ALERT START
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            Swal.fire(
                'Deleted!',
                'Your file has been deleted.',
                'success'
            )

            // DELETE CODE START
            var delete_id = $(this).attr("delete_id");
            var delete_path = $(this).attr("delete_path");

            window.location = "delete-"+delete_path+"/"+delete_id;
        }
    })

})


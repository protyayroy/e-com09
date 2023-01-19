<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Skydash Admin @yield('title', '| Dashboard')</title>

    <!-- plugins:css -->
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ url('admin/vendors/feather/feather.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/ti-icons/css/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ url('admin/vendors/css/vendor.bundle.base.css') }}">
    <!-- endinject -->

    <!-- Plugin css for this page -->

    {{-- <link rel="stylesheet" href="{{ url('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css') }}"> --}}

    {{-- <link rel="stylesheet" type="text/css" href="{{ url('admin/js/select.dataTables.min.css') }}"> --}}

    <!-- End plugin css for this page -->


    <!-- inject:css -->
    <link rel="stylesheet" href="{{ url('admin/css/vertical-layout-light/style.css') }}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{ url('admin/images/favicon.png') }}" />
    <!-- mid Font Link -->
    <link rel="stylesheet" href="{{ asset('admin') }}/vendors/mdi/css/materialdesignicons.min.css">


    {{-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.css" /> --}}



    {{-- DATATABLE CSS --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css"> --}}


    <style>
        .alert-dismissible .close {
            position: absolute !important;
            top: 50%;
            right: 0px !important;
            transform: translateY(-55%);
        }

        .sidebar .nav:not(.sub-menu)>.nav-item.active {
            background: transparent;
        }

        .sidebar .nav.sub-menu {
            background: transparent;
        }

        .sidebar .nav.sub-menu .nav-item .active {
            background: #4B49AC !important;
            color: #ffffff !important;
        }

        .sidebar .nav.sub-menu .nav-item .nav-link {
            color: #888;
        }

        .sidebar .nav.sub-menu .nav-item .nav-link:hover {
            color: #222;
        }

        .sidebar .nav.sub-menu .nav-item::before {
            background: transparent;
        }

        label {
            font-weight: 600;
        }

        /* .status_collum a {
            font-size: 20px;
            margin-left: 20px;
            /* color: #4B49AC;
        } */

        .vendor_details {
            font-size: 20px;
            margin-left: 20px;
            /* color: #4B49AC; */
        }

        /* .action_collum a {
            font-size: 20px;
            margin-left: 10px;
            /* color: #4B49AC;
        } */
        td a i {

            font-size: 20px;
            margin-left: 10px;
        }

        .action_collum a:hover {
            /* color: #ffc107; */
            text-decoration: none !important;
        }

        .swal2-container.swal2-center>.swal2-popup {
            align-self: auto !important;
        }

        .address_proof_image img {
            border-radius: 0 !important;
            height: 50px !important;
            width: auto !important;
        }

        .clr {
            clear: both !important;
        }

        select.form-control,
        select.asColorPicker-input,
        .dataTables_wrapper select,
        .jsgrid .jsgrid-table .jsgrid-filter-row select,
        .select2-container--default select.select2-selection--single,
        .select2-container--default .select2-selection--single select.select2-search__field,
        select.typeahead,
        select.tt-query,
        select.tt-hint {
            color: #777;
        }

        .sidebar .nav .nav-item .nav-link i.menu-icon {
            margin-right: 0.5rem;
        }

        .btn,
        .fc button,
        .ajax-upload-dragdrop .ajax-file-upload,
        .swal2-modal .swal2-buttonswrapper .swal2-styled,
        .swal2-modal .swal2-buttonswrapper .swal2-styled.swal2-confirm,
        .swal2-modal .swal2-buttonswrapper .swal2-styled.swal2-cancel,
        .wizard>.actions a {
            border-radius: 5px;
        }

        .field_wrapper .form-control {
            display: inline !important;
            /* color: #222 !important; */
            width: 23.9%;
        }

        .field_wrapper input::placeholder {
            color: #444 !important;
        }

        .add_button {
            font-size: 0.875rem;
            line-height: 1;
            font-weight: 400;
            border-radius: 5px;
            background: #57B657;
            color: #ffffff;
            padding: 13px;
        }

        .add_button:hover {
            color: #ffffff;
            background: #46a146;
        }

        .remove_button {
            font-size: 0.875rem;
            line-height: 1;
            font-weight: 400;
            border-radius: 5px;
            background: #FF4747;
            color: #ffffff;
            padding: 13px;
        }

        .remove_button:hover {
            color: #ffffff !important;
            background: #fa0000;
        }

        #red {
            color: red;
        }
    </style>

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/top_navbar.html -->

        @include('admin.layouts.header')

        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <!-- partial:partials/_settings-panel.html -->
            <div class="theme-setting-wrapper">
                <div id="settings-trigger"><i class="ti-settings"></i></div>
                <div id="theme-settings" class="settings-panel">
                    <i class="settings-close ti-close"></i>
                    <p class="settings-heading">SIDEBAR SKINS</p>
                    <div class="sidebar-bg-options selected" id="sidebar-light-theme">
                        <div class="img-ss rounded-circle bg-light border mr-3"></div>Light
                    </div>
                    <div class="sidebar-bg-options" id="sidebar-dark-theme">
                        <div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark
                    </div>
                    <p class="settings-heading mt-2">HEADER SKINS</p>
                    <div class="color-tiles mx-0 px-4">
                        <div class="tiles success"></div>
                        <div class="tiles warning"></div>
                        <div class="tiles danger"></div>
                        <div class="tiles info"></div>
                        <div class="tiles dark"></div>
                        <div class="tiles default"></div>
                    </div>
                </div>
            </div>
            <div id="right-sidebar" class="settings-panel">
                <i class="settings-close ti-close"></i>
                <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab"
                            aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab"
                            aria-controls="chats-section">CHATS</a>
                    </li>
                </ul>
                <div class="tab-content" id="setting-content">
                    <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel"
                        aria-labelledby="todo-section">
                        <div class="add-items d-flex px-3 mb-0">
                            <form class="form w-100">
                                <div class="form-group d-flex">
                                    <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                                    <button type="submit" class="add btn btn-primary todo-list-add-btn"
                                        id="add-task">Add</button>
                                </div>
                            </form>
                        </div>
                        <div class="list-wrapper px-3">
                            <ul class="d-flex flex-column-reverse todo-list">
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Team review meeting at 3.00 PM
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Prepare for presentation
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox">
                                            Resolve all the low priority tickets due today
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Schedule meeting for next week
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                                <li class="completed">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="checkbox" type="checkbox" checked>
                                            Project review
                                        </label>
                                    </div>
                                    <i class="remove ti-close"></i>
                                </li>
                            </ul>
                        </div>
                        <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="ti-control-record text-primary mr-2"></i>
                                <span>Feb 11 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
                            <p class="text-gray mb-0">The total number of sessions</p>
                        </div>
                        <div class="events pt-4 px-3">
                            <div class="wrapper d-flex mb-2">
                                <i class="ti-control-record text-primary mr-2"></i>
                                <span>Feb 7 2018</span>
                            </div>
                            <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
                            <p class="text-gray mb-0 ">Call Sarah Graves</p>
                        </div>
                    </div>
                    <!-- To do section tab ends -->
                    <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
                        <div class="d-flex align-items-center justify-content-between border-bottom">
                            <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
                            <small
                                class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See
                                All</small>
                        </div>
                        <ul class="chat-list">
                            <li class="list active">
                                <div class="profile"><img src="{{ url('admin/images/faces/face1.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Thomas Douglas</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">19 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ url('admin/images/faces/face2.jpg') }}"
                                        alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <div class="wrapper d-flex">
                                        <p>Catherine</p>
                                    </div>
                                    <p>Away</p>
                                </div>
                                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                                <small class="text-muted my-auto">23 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ url('admin/images/faces/face3.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Daniel Russell</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">14 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ url('admin/images/faces/face4.jpg') }}"
                                        alt="image"><span class="offline"></span></div>
                                <div class="info">
                                    <p>James Richardson</p>
                                    <p>Away</p>
                                </div>
                                <small class="text-muted my-auto">2 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ url('admin/images/faces/face5.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Madeline Kennedy</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">5 min</small>
                            </li>
                            <li class="list">
                                <div class="profile"><img src="{{ url('admin/images/faces/face6.jpg') }}"
                                        alt="image"><span class="online"></span></div>
                                <div class="info">
                                    <p>Sarah Graves</p>
                                    <p>Available</p>
                                </div>
                                <small class="text-muted my-auto">47 min</small>
                            </li>
                        </ul>
                    </div>
                    <!-- chat tab ends -->
                </div>
            </div>
            <!-- partial -->
            <!-- partial:partials/_sidebar.html -->
            @include('admin.layouts.sidebar')
            <!-- partial -->
            <div class="main-panel">
                <!-- content-wrapper Starts -->
                @yield('content')
                <!-- content-wrapper ends -->

                <!-- partial:partials/_footer.html -->
                @include('admin.layouts.footer')
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="{{ url('admin/vendors/js/vendor.bundle.base.js') }}"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{ url('admin/vendors/chart.js/Chart.min.js') }}"></script>



    <!-- pblm -->
    {{-- <script src="{{ url('admin/vendors/datatables.net/jquery.dataTables.js') }}"></script> --}}
    <!-- pblm -->

    {{-- <script src="{{ url('admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js') }}"></script> --}}
    {{-- <script src="{{ url('admin/js/dataTables.select.min.js') }}"></script> --}}




    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{ url('admin/js/off-canvas.js') }}"></script>
    <script src="{{ url('admin/js/hoverable-collapse.js') }}"></script>
    <script src="{{ url('admin/js/template.js') }}"></script>
    <script src="{{ url('admin/js/settings.js') }}"></script>
    <script src="{{ url('admin/js/todolist.js') }}"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="{{ url('admin/js/dashboard.js') }}"></script>
    <script src="{{ url('admin/js/Chart.roundedBarCharts.js') }}"></script>
    <!-- End custom js for this page-->

    <!-- Sweet Alert js -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.12.1/datatables.min.js"></script> --}}

    <!-- Custom js  -->
    <script src="{{ url('admin/js/custom.js') }}"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>


    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> --}}

    <script>
        $(document).ready(function() {
            // ADD ATTRIBUTE ROW
            $(document).on("click", "#add_attribute", function(e) {
                e.preventDefault();
                var add_attr = '';
                add_attr += '<div class="form-group d-flex mb-2" id="remove_from">';
                add_attr +=
                    '<input type="text" class="form-control mr-1" name="size[]" placeholder="Size">';
                add_attr +=
                    '<input type="text" class="form-control mr-1" name="price[]" placeholder="Price">';
                add_attr +=
                    '<input type="text" class="form-control mr-1" name="stock[]" placeholder="Stock">';
                add_attr +=
                    '<input type="text" class="form-control mr-1" name="stock_limit_alert[]" placeholder="Stock Limit Alert">';
                add_attr += '<button class="btn btn-danger" id="remove_attribute">Remove</button>';
                add_attr += '</div>';

                $("#attr_field").append(add_attr)
            });

            // REMOVE ATTRIBUTE ROW
            $(document).on('click', '#remove_attribute', function() {
                $(this).closest('#remove_from').remove();
            });

            // ADD GALLERY IMAGE ROW
            $(document).on('click', '#add_gallary_img', function(e) {
                e.preventDefault();
                var gallary_img = '';
                gallary_img += '<div class="d-flex mt-3" id="gallary_img_row">';
                gallary_img +=
                    '<input type="file" class="form-control-file" name="product_gallery_image[]">';
                gallary_img += '<button class="btn btn-danger float-right" id="remove_gallary_img" style="margin-right:130px">Remove</button>';
                gallary_img += '<div class="clr"></div>';
                gallary_img += '</div>';

                $('#gallary_img').append(gallary_img);
            });

            // REMOVE GALLERY IMAGE ROW
            $(document).on('click', '#remove_gallary_img', function() {
                $(this).closest('#gallary_img_row').remove();
            });
        })
    </script>

    {{-- <script type="text/javascript">
        $(document).ready(function() {
            // alert();
            function get_value(class_name) {
                var value = [];
                $("." + class_name).each(function() {

                    filter.push($(this).val());

                });
                return value;
            }

            var color = get_value('color');
            var size = get_value('size');
            // alert(color)
            $("#Add_p").click(function(e) {
                e.preventDefault();
                alert("color")
            })
            // $.ajax({
            //     url: 'admin/add-edit-product',
            //     type : "post",
            //     data : {
            //         color:color,
            //         size:size
            //     },
            //     success: function(data){
            //         alert(data);
            //     }, error: function(data){
            //         alert("Error");
            //     }
            // })
        })
    </script> --}}

</body>

</html>

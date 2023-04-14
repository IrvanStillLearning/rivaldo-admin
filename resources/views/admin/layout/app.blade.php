<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Admin &mdash; Panel</title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/datatables.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/select2/dist/css/select2.min.css') }}">

    
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-additional.css') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    
    @if(session('mode') == 1)
        <link rel="stylesheet" href="{{ asset('assets/css/app-dark.css') }}" id="dark-mode">
    @endif
    
    <style>
        .ck-editor__editable {
            min-height: 150px;
        }

        #modal{
            overflow-y: auto!important;
        }

        .table tbody td {
            vertical-align: middle;
        }

        .table tbody th {
            vertical-align: middle;
        }

        .table:not(.table-sm) thead th {
            color: #fff;
        }

        .red-border {
            border: 1px solid #dc3545 !important;
        }

        .custom-select.is-invalid, .form-control.is-invalid, .was-validated .custom-select:invalid, .was-validated .form-control:invalid{
            border-color: red!important;
        }
    </style>

    @yield('css')

</head>

<body>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                        class="fas fa-bars"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right position-relative">
                    <li style="position: absolute; top: -19px; left: -60px"><input type="checkbox" @if(session('mode') == 1) checked @endif id="darkmode-toggle"><label for="darkmode-toggle" id="darkmode-label"><i class="fas fa-sun"></i><i class="fas fa-moon"></i></label></li>
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('assets/img/avatar/avatar-1.png') }}" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">Hi, {{ auth()->user()->nama }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            <a href="/change-password" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Change Password
                            </a>
                            <div class="dropdown-divider"></div>
                            <a href="logout" class="dropdown-item has-icon text-danger">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="index.html">Admin Panel</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">AP</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">Dashboard</li>
                        <li class="nav-item dropdown {{ (request()->is('admin/dashboard')) ? 'active' : '' }}"><a href="/admin/dashboard" class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
                        <li class="nav-item dropdown {{ (request()->is('admin/tempat-magang')) ? 'active' : '' }}"><a href="/admin/tempat-magang" class="nav-link"><i class="fas fa-user-lock"></i><span>Tempat Magang</span></a></li>
                        <li class="nav-item dropdown {{ (request()->is('admin/siswa')) ? 'active' : '' }}"><a href="/admin/siswa" class="nav-link"><i class="fas fa-user-lock"></i><span>Siswa</span></a></li>
                    </ul>

                </aside>
            </div>
            <!-- Main Content -->
            <div class="main-content">
                @yield('content')

                @yield('modal')

                <!-- Modal Load-->
                <div class="modal fade" role="dialog" id="modal_loading" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body pt-0" style="background-color: #FAFAF8; border-radius: 6px;">
                            <div class="text-center">
                                <img style="border-radius: 4px; height: 140px;" src="{{ asset('assets/img/project/icon/loader.gif') }}" alt="Loading">
                                <h6 style="position: absolute; bottom: 10%; left: 37%; color: #2a3041!important" class="pb-2">Mohon Tunggu..</h6>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>

    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/datatables.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/modules/select2/dist/js/select2.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    <script src="{{ asset('assets/js/script-additional.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>
    
    @include('scriptjs')
    @yield('script')

    <script>
        $(document).ready(function () {
            $('#darkmode-toggle').on("click", () => {
                if($('#darkmode-toggle:checked').val() == 'on'){
                    $('head').append('<link rel="stylesheet" href="' + window.location.origin + '/assets/css/app-dark.css" type="text/css" id="dark-mode" />');
                    $.post('/admin/mode/1');
                } else {
                    $('#dark-mode').remove();
                    $.post('/admin/mode/2');
                }
            })
        });

        // function add(message) {
        //     $("#modal").modal('show');
        //     $("#form_upload")[0].reset();
        //     $(".modal-title").text(message);
        //     $("#image-warning").css("display", "none");
        //     $("#preview_gambar").attr("src", "");
        //     $('#preview_gambar').parent().removeClass("my-3");
        //     $('#preview_gambar').parent().css("display", "none");
        // }
    </script>

</body>

</html>
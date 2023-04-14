<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/custome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style-additional.css') }}">
    <title>Login</title>

    <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <img src="{{ asset('assets/img/Gema-bg-remove.png') }}" alt="logo" draggable="false" width="100"
                                class="shadow-light rounded-circle">
                        </div>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" id="form" class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1"
                                            required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                        </div>
                                        <div class="position-relative">
                                            <input id="password" type="password" class="form-control" name="password"
                                                tabindex="2" required>
                                            <i class="fas fa-eye-slash" id="hide_password" style="position: absolute; right: 15px; top: 15px; cursor: pointer"></i>
                                        </div>
                                        <div class="d-block">
                                            <div class="float-right">
                                                <a href="auth-forgot-password.html" class="text-small">
                                                    Forgot Password?
                                                </a>
                                            </div>
                                        </div>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="cookie" class="custom-control-input"
                                                tabindex="3" id="cookie">
                                            <label class="custom-control-label" for="cookie">Remember Me</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" id="submit" name="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal Load-->
                <div class="modal fade" role="dialog" id="modal_loading" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body pt-0" style="background-color: #FAFAF8; border-radius: 6px;">
                            <div class="text-center">
                                <img style="border-radius: 4px; height: 140px;" src="{{ asset('assets/img/project/icon/loader.gif') }}" alt="Loading">
                                <h6 style="position: absolute; bottom: 10%; left: 37%;" class="pb-2">Mohon Tunggu..</h6>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>
    </div>
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/js/script-additional.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="{{ asset('assets/modules/sweetalert/sweetalert.min.js') }}"></script>

    <script>
        $('#form').submit(function(e){
            e.preventDefault();
            $("#modal_loading").modal('show');

            $.ajax({
                url: "login",
                type: "POST",
                data: $('#form').serialize(),
                datatype: 'JSON',
                success: function(response){
                    setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                    swal("succcess", {  icon: 'success' });
                    if(response.status === 201){
                        swal(response.message, {  icon: 'success', });
                        window.location.href = 'dashboard';
                    } else {
                        swal(response.message, { icon: 'error', });
                    }
                },error: function (jqXHR, textStatus, errorThrown){
                    setTimeout(function () {  $('#modal_loading').modal('hide'); }, 500);
                    swal("Oops! Terjadi kesalahan (" + errorThrown + ")", {  icon: 'error', });
                }
            })
        })
    </script>

</body>
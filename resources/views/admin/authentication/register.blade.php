<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Admin Control Panel</title>
    <!-- loader-->
    <link href={{ asset('css/pace.min.css') }} rel="stylesheet" />
    <script src={{ asset('js/pace.min.js') }}></script>
    <!--favicon-->
    <link rel="icon" href={{ asset('images/favicon.ico') }} type="image/x-icon">
    <!-- Bootstrap core CSS-->
    <link href={{ asset('css/bootstrap.min.css') }} rel="stylesheet" />
    <!-- animate CSS-->
    <link href={{ asset('css/animate.css') }} rel="stylesheet" type="text/css" />
    <!-- Icons CSS-->
    <link href={{ asset('css/icons.css') }} rel="stylesheet" type="text/css" />
    <!-- Custom Style-->
    <link href={{ asset('css/app-style.css') }} rel="stylesheet" />

</head>

<body class="bg-theme bg-theme1">

    <!-- start loader -->
    <div id="pageloader-overlay" class="visible incoming">
        <div class="loader-wrapper-outer">
            <div class="loader-wrapper-inner">
                <div class="loader"></div>
            </div>
        </div>
    </div>
    <!-- end loader -->

    <!-- Start wrapper-->
    <div id="wrapper">

        <div class="card card-authentication1 mx-auto my-4">
            <div class="card-body">
                <div class="card-content p-2">
                    <div class="card-title text-uppercase text-center py-3">Sign Up Form</div>
                    <form action="{{ route('register') }}" method="POST">
                        @csrf
                        <input type="hidden" value="admin" name="role">
                        <div class="form-group">
                            <label for="exampleInputName" class="sr-only" >Name</label>
                            <div class="position-relative has-icon-left">
                                <input type="text" id="exampleInputName" class="form-control input-shadow @error('name')
                                    is-invalid
                                @enderror"
                                    placeholder="Enter Your Name" name="name">
                                <div class="form-control-position">
                                    <i class="icon-user"></i>
                                </div>
                                @error('name')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmailId" class="sr-only" >Email ID</label>
                            <div class="position-relative has-icon-left">
                                <input type="text" id="exampleInputEmailId" class="form-control input-shadow @error('email')
                                    is-invalid
                                @enderror"
                                    placeholder="Enter Your Email ID" name="email">
                                <div class="form-control-position">
                                    <i class="icon-envelope-open"></i>
                                </div>
                                @error('email')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword" class="sr-only" value="{{ __('Password') }}">Password</label>
                            <div class="position-relative has-icon-left">
                                <input type="password" id="exampleInputPassword" class="form-control input-shadow @error('password')
                                    is-invalid
                                @enderror"
                                    placeholder="Choose Password" name="password">
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                </div>
                                @error('password')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword" class="sr-only"  value="{{ __('Confirm Password') }}">Password</label>
                            <div class="position-relative has-icon-left">
                                <input type="password" id="exampleInputPassword" class="form-control input-shadow @error('password-confirmation')
                                    is-invalid
                                @enderror"
                                    placeholder="Confirm Password" name="password_confirmation">
                                <div class="form-control-position">
                                    <i class="icon-lock"></i>
                                </div>
                                @error('password-confirmation')
                                    <small class="invalid-feedback">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="icheck-material-white">
                                <input type="checkbox" id="user-checkbox" checked="" />
                                <label for="user-checkbox">I Agree With Terms & Conditions</label>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-light btn-block waves-effect waves-light">Sign Up</button>
                    </form>
                </div>
            </div>
            <div class="card-footer text-center py-3">
                <p class="text-warning mb-0">Already have an account? <a href="{{ route('admin#loginpage') }}">Login
                        here</a></p>
            </div>
        </div>

        <!--Start Back To Top Button-->
        <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->

        <!--start color switcher-->
        <div class="right-sidebar">
            <div class="switcher-icon">
                <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
            </div>
            <div class="right-sidebar-content">

                <p class="mb-0">Gaussion Texture</p>
                <hr>

                <ul class="switcher">
                    <li id="theme1"></li>
                    <li id="theme2"></li>
                    <li id="theme3"></li>
                    <li id="theme4"></li>
                    <li id="theme5"></li>
                    <li id="theme6"></li>
                </ul>

                <p class="mb-0">Gradient Background</p>
                <hr>

                <ul class="switcher">
                    <li id="theme7"></li>
                    <li id="theme8"></li>
                    <li id="theme9"></li>
                    <li id="theme10"></li>
                    <li id="theme11"></li>
                    <li id="theme12"></li>
                    <li id="theme13"></li>
                    <li id="theme14"></li>
                    <li id="theme15"></li>
                </ul>

            </div>
        </div>
        <!--end color switcher-->

    </div><!--wrapper-->

    <!-- Bootstrap core JavaScript-->
    <script src={{ asset('js/jquery.min.js') }}></script>
    <script src={{ asset('js/popper.min.js') }}></script>
    <script src={{ asset('js/bootstrap.min.js') }}></script>

    <!-- sidebar-menu js -->
    <script src={{ asset('js/sidebar-menu.js') }}></script>

    <!-- Custom scripts -->
    <script src={{ asset('js/app-script.js') }}></script>

</body>

</html>

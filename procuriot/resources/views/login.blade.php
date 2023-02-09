<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Sign In | Ioptime procuriot</title>
    <!-- Favicon-->
    <link rel="icon" href="#!" style="cursor: default;" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{ asset('/assets/plugins/bootstrap/css/bootstrap.css') }}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{ asset('/assets/plugins/node-waves/waves.css') }}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{ asset('/assets/plugins/animate-css/animate.css') }}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{ asset('/assets/css/style.css') }}" rel="stylesheet">
</head>

<body class="login-page" style="background-color: #6860FF;">
<div class="login-box">
{{--    <div class="logo">--}}
{{--        <a href="javascript:void(0);">Procu<b>riot</b></a>--}}
{{--    </div>--}}

    
    <div class="card" style="margin-top: 35%;margin-bottom: 0px !important;">

        <div class="row">
            <div class="col-md-12" style="text-align: center;">
{{--                <img src="{{ asset('/assets/images/procuriot_logo.png') }}" height="74px" width="50" alt="">--}}
                <img width="88" height="99" src="https://procuriot.com/wp-content/uploads/2021/02/Procuriot-Logo-Transparent-88x99.png" class="custom-logo" alt="Procuriot Logo" srcset="https://procuriot.com/wp-content/uploads/2021/02/Procuriot-Logo-Transparent-88x99.png 88w, https://procuriot.com/wp-content/uploads/2021/02/Procuriot-Logo-Transparent-266x300.png 266w, https://procuriot.com/wp-content/uploads/2021/02/Procuriot-Logo-Transparent-908x1024.png 908w, https://procuriot.com/wp-content/uploads/2021/02/Procuriot-Logo-Transparent-768x866.png 768w, https://procuriot.com/wp-content/uploads/2021/02/Procuriot-Logo-Transparent-1362x1536.png 1362w, https://procuriot.com/wp-content/uploads/2021/02/Procuriot-Logo-Transparent-1816x2048.png 1816w" sizes="(max-width: 88px) 100vw, 88px">

            </div>
        </div>

        <div class="body">
            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


                @if (\Session::get('success'))
                    <div class="alert alert-success">
                        <p>{{ \Session::get('success') }}</p>
                    </div>
                @endif

                <form id="sign_in" action="/login" method="POST">
                @csrf
{{--                <div class="msg">Sign in to start your session</div>--}}
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                    <div class="form-line">
                        <input type="text" style="font-size: 14px;" class="form-control" name="email" placeholder="Email" required autofocus>
                    </div>
                </div>
                <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                    <div class="form-line">
                        <input type="password" class="form-control" name="password" placeholder="Password" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-4">
                        <button class="btn" style="background-color: #6860FF;color: white;margin-left: 35%;"
                                type="submit">SIGN IN</button>
                    </div>

                    <div class="col-xs-8 p-t-5" style="text-align: right;">
                        <a href="/forgetpassword" style="color: #6860FF">Forget Password?</a>                    </div>
                </div>
                <div class="row m-t-15 m-b--20">
{{--                    <div class="col-xs-6">--}}
{{--                        <a href="/register">Register Now!</a>--}}
{{--                    </div>--}}
{{--                    <div class="col-xs-6">--}}
{{--                        <a href="/forgetpassword" style="color: #6860FF">Forget Password?</a>--}}
{{--                    </div>--}}
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Jquery Core Js -->
<script src="{{ asset('/assets/plugins/jquery/jquery.min.js') }}"></script>

<!-- Bootstrap Core Js -->
<script src="{{ asset('/assets/plugins/bootstrap/js/bootstrap.js') }}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{ asset('/assets/plugins/node-waves/waves.js') }}"></script>

<!-- Validation Plugin Js -->
<script src="{{ asset('/assets/plugins/jquery-validation/jquery.validate.js') }}"></script>

<!-- Custom Js -->
<script src="{{ asset('/assets/js/admin.js') }}"></script>
<script src="{{ asset('/assets/js/pages/examples/sign-in.js') }}"></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    @if(Session::has('downloadFile'))
        <meta http-equiv="refresh" content="5;url={{ Session::get('downloadFile') }}">

    @endif
    <meta charset="utf-8" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="_token" content="{{csrf_token()}}" />
    <title>
{{--        @yield('title')--}}
        ManagersQR –
        Dashboard
    </title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />

    <link href="{{asset('/public/vendor/css/material-dashboard.css?v=2.1.2')}}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{asset('/public/vendor/demo/demo.css')}}" rel="stylesheet" />

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" rel="stylesheet">
</head>

<style>

    .modal.left .modal-dialog {
        position: fixed;
        margin: auto;
        width: 50%;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    .modal.left .modal-content {
        height: 100%;
        overflow-y: auto;
    }

    .sidebar .nav .caret {
        margin-top: 13px;
        position: absolute;
        right: -9px;
    }
    .bmd-form-group label{
        color: #f44336;
    }
    .pagination>.page-item.active>a, .pagination>.page-item.active>a:focus, .pagination>.page-item.active>a:hover, .pagination>.page-item.active>span, .pagination>.page-item.active>span:focus, .pagination>.page-item.active>span:hover{
        background-color: #045081;
        border-color: #045081;
        color: #fff;
        box-shadow: 0 4px 5px 0 rgba(156,39,176,.14), 0 1px 10px 0 rgba(156,39,176,.12), 0 2px 4px -1px rgba(156,39,176,.2);
    }
    .btn.btn-primary{
        color: #fff;
        background-color: #045081;
        border-color: #045081;
        box-shadow: 0 2px 2px 0 rgba(156,39,176,.14), 0 3px 1px -2px rgba(156,39,176,.2), 0 1px 5px 0 rgba(156,39,176,.12);
    }
    .btn.btn-primary.focus, .btn.btn-primary:focus, .btn.btn-primary:hover{
        color: #fff;
        background-color: #045081;
        border-color: #045081;
    }
    a {
        color: #045081;
    }

    .dropdown-menu .dropdown-item:focus, .dropdown-menu .dropdown-item:hover, .dropdown-menu a:active, .dropdown-menu a:focus, .dropdown-menu a:hover{
        box-shadow: 0 4px 20px 0 white, 0 7px 10px -5px #045081;
        background-color: #045081;
        color: #fff;
    }
    .badge-primary{
        background: #045081 !important;
    }
    .btn-group > .btn-group:not(:last-child) > .btn, .btn-group > .btn:not(:last-child):not(.dropdown-toggle){
        color: #fff;
        background-color: #045081;
        border-color: #045081;
        box-shadow: 0 2px 2px 0 rgba(156,39,176,.14), 0 3px 1px -2px rgba(156,39,176,.2), 0 1px 5px 0 rgba(156,39,176,.12);
    }
    table.dataTable tbody>tr.selected, table.dataTable tbody>tr>.selected{
        background:#045081;
    }


    @keyframes ldio-uf4jzeuvgrb {
        0% { opacity: 1 }
        100% { opacity: 0 }
    }
    .ldio-uf4jzeuvgrb div {
        left: 47px;
        top: 20px;
        position: absolute;
        animation: ldio-uf4jzeuvgrb linear 1s infinite;
        background: #1d0e0b;
        width: 6px;
        height: 20px;
        border-radius: 3px / 10px;
        transform-origin: 3px 30px;
    }.ldio-uf4jzeuvgrb div:nth-child(1) {
         transform: rotate(0deg);
         animation-delay: -0.9166666666666666s;
         background: #1d0e0b;
     }.ldio-uf4jzeuvgrb div:nth-child(2) {
          transform: rotate(30deg);
          animation-delay: -0.8333333333333334s;
          background: #1d0e0b;
      }.ldio-uf4jzeuvgrb div:nth-child(3) {
           transform: rotate(60deg);
           animation-delay: -0.75s;
           background: #1d0e0b;
       }.ldio-uf4jzeuvgrb div:nth-child(4) {
            transform: rotate(90deg);
            animation-delay: -0.6666666666666666s;
            background: #1d0e0b;
        }.ldio-uf4jzeuvgrb div:nth-child(5) {
             transform: rotate(120deg);
             animation-delay: -0.5833333333333334s;
             background: #1d0e0b;
         }.ldio-uf4jzeuvgrb div:nth-child(6) {
              transform: rotate(150deg);
              animation-delay: -0.5s;
              background: #1d0e0b;
          }.ldio-uf4jzeuvgrb div:nth-child(7) {
               transform: rotate(180deg);
               animation-delay: -0.4166666666666667s;
               background: #1d0e0b;
           }.ldio-uf4jzeuvgrb div:nth-child(8) {
                transform: rotate(210deg);
                animation-delay: -0.3333333333333333s;
                background: #1d0e0b;
            }.ldio-uf4jzeuvgrb div:nth-child(9) {
                 transform: rotate(240deg);
                 animation-delay: -0.25s;
                 background: #1d0e0b;
             }.ldio-uf4jzeuvgrb div:nth-child(10) {
                  transform: rotate(270deg);
                  animation-delay: -0.16666666666666666s;
                  background: #1d0e0b;
              }.ldio-uf4jzeuvgrb div:nth-child(11) {
                   transform: rotate(300deg);
                   animation-delay: -0.08333333333333333s;
                   background: #1d0e0b;
               }.ldio-uf4jzeuvgrb div:nth-child(12) {
                    transform: rotate(330deg);
                    animation-delay: 0s;
                    background: #1d0e0b;
                }
    .loadingio-spinner-spinner-uos71x3akqp {
        width: 51px;
        height: 51px;
        display: inline-block;
        overflow: hidden;
        background: #ffffff;
    }
    .ldio-uf4jzeuvgrb {
        width: 100%;
        height: 100%;
        position: relative;
        transform: translateZ(0) scale(0.51);
        backface-visibility: hidden;
        transform-origin: 0 0; /* see note above */
    }
    .ldio-uf4jzeuvgrb div { box-sizing: content-box; }
    /* generated by https://loading.io/ */

    /*.sidebar {*/
    /*    position: fixed;*/
    /*    top: 0;*/
    /*    bottom: 0;*/
    /*    left: 0;*/
    /*    z-index: 2;*/
    /*    width: 292px;*/
    /*    box-shadow: 0 16px 38px -12px rgba(0,0,0,.56), 0 4px 25px 0 rgba(0,0,0,.12), 0 8px 10px -5px rgba(0,0,0,.2);*/
    /*}*/
    /*.sidebar .sidebar-wrapper {*/
    /*    position: relative;*/
    /*    height: calc(100vh - 75px);*/
    /*    overflow: auto;*/
    /*    width: 292px;*/
    /*    z-index: 4;*/
    /*    padding-bottom: 30px;*/
    /*}*/
    /*.navbar .navbar-brand{*/
    /*    margin-left: 3rem;*/
    /*}*/

    .highlight{
        background:red;
        color:white;
    }

    .dropdown-item.active, .dropdown-item:active {
        color: #fff !important;
        text-decoration: none;
        background-color: #045081;
    }
    .loader {
        position: relative;
        text-align: center;
        margin: 15px auto 35px auto;
        z-index: 9999;
        display: block;
        width: 80px;
        height: 80px;
        border: 10px solid rgba(0, 0, 0, .3);
        border-radius: 50%;
        border-top-color: #000;
        animation: spin 1s ease-in-out infinite;
        -webkit-animation: spin 1s ease-in-out infinite;
    }

    @keyframes spin {
        to {
            -webkit-transform: rotate(360deg);
        }
    }

    @-webkit-keyframes spin {
        to {
            -webkit-transform: rotate(360deg);
        }
    }
    @media only screen and (max-width: 600px) {
        .combine-report-button{
            margin-left: 10px;
            position: relative;
            left: -4%;
            top: 0px;
        }
    }

    @media only screen and (min-width: 900px) {
        #uuu88 {
            display: none;
        }
    }

    @media only screen and (max-width: 900px) {
        #uuu88 {
            display: block;
        }
    }

    @media only screen and (max-width: 600px) {
        .wrapper .sidebar {
            margin-left: 0px;
            float: left;
            position: fixed;
        }
    }
    .combine-report-button{
        margin-left: 10px;
        position: relative;
        left: 4%;
        top: 58px;
    }


</style>
<?php

$properties=DB::table('properties')->where('user_id',Auth::user()->id)->get();
$property=DB::table('properties')->where('id',session()->get('property'))->first();
$userTypes = db::table('feedback_type')->where('user_id',Auth::user()->id)->get();



?>


<body class="">
<div class="wrapper ">
    <div class="sidebar"  data-color="purple" data-background-color="white" data-image="/public/vendor/img/sidebar-1.jpg">



        <div class="logo"><a href="http://managershq.com.au/" class="simple-text logo-normal text-center">
                <img width="92%" src="/public/logo.png">
            </a></div>
        <div class="sidebar-wrapper">
            <span id="uuu88">Select Property</span>
            <ul class="nav navbar-nav nav-mobile-menu">

                @if(Route::current()->getName() != 'dashboard')


                    @if(count($properties) > 0)

                        <li class="nav-item dropdown">

                            <select  onchange="setProperty()" class="browser-default custom-select">
                                <option  value="0" >Select Property </option>

                                @foreach($properties as $p)
                                    <option  value="{{$p->id}}"  {{(session()->get('property')==$p->id)?'selected':''}}>{{$p->title}}</option>

                                @endforeach
                            </select>

                        </li>

                    @endif
                @endif
                <li class="nav-item">
                    <a class="dropdown-item" href="/user/logout">Log out</a>
                </li>
            </ul>

            <ul class="nav">
                <li class="nav-item {{ (request()->segment(1) == 'dashboard' || request()->segment(1) == '') ? 'active' : '' }} ">
                    <a class="nav-link" href="{{ route('dashboard') }}">
                        <i class="material-icons">D</i>
                        <p>Dashboard</p>
                    </a>
                </li>

                {{--                <li class="nav-item {{ (request()->segment(1) == 'manageQrcode') ? 'active' : '' }}">--}}
                {{--                    <a class="nav-link" href="/manageQrcode">--}}
                {{--                        <i class="material-icons">Q</i>--}}
                {{--                        <p>Manage Qrcode</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}

                <li class="nav-item {{ (request()->segment(1) == 'createQrcode2') ? 'active' : '' }} {{ (request()->segment(1) == 'web') ? 'active' : '' }} {{ (request()->segment(1) == 'listqrcodes') ? 'active' : '' }} {{ request()->is('edit/web/*') ? 'active' : '' }} {{ request()->is('updateQr/*') ? 'active' : '' }} {{ request()->is('edit/web-content/*') ? 'active' : '' }}">
                    <a class="nav-link" href="{{route('list.qrcodes')}}">
                        <i class="material-icons">C</i>
                        <p>Custom</p>
                    </a>
                </li>

                <li class="nav-item {{ (request()->segment(1) == 'vendors') ? 'active' : '' }} ">
                    <a class="nav-link" href="/vendors">
                        <i class="material-icons">V</i>
                        <p>Vendors</p>
                    </a>
                </li>



                {{--                <li class="nav-item {{ (request()->segment(2) == 'guest') ? 'active' : '' }} ">--}}
                {{--                    <a class="nav-link" href="/feedback/guest/open">--}}
                {{--                        <i class="material-icons">GF</i>--}}
                {{--                        <p>Guest Feedback</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}
                {{--                <li class="nav-item {{ (request()->segment(3) == 'housekeeping') ? 'active' : '' }} ">--}}
                {{--                    <a class="nav-link" href="/feedback/housekeeping/open">--}}
                {{--                        <i class="material-icons">HF</i>--}}
                {{--                        <p>Housekeeping Feedback</p>--}}
                {{--                    </a>--}}
                {{--                </li>--}}

                <li class="nav-item ">
                    <a class="nav-link" data-toggle="collapse" href="#bodyCorporate"  href="/reports/BodyCorporateReports">
                        <i class="material-icons">F</i>
                        <p>Feedback
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (request()->segment(1) == 'feedback') ? 'show' : '' }}" id="bodyCorporate">
                        <ul class="nav">
                            @foreach($userTypes as $r)

                                <li class="nav-item {{ (request()->segment(2) == $r->feedback) ? 'active' : '' }}">
                                    <a class="nav-link" href="/feedback/{{$r->feedback}}/open">

                                        <span class="sidebar-normal">{{$r->feedback}} </span>
                                    </a>
                                </li>

                            @endforeach

                        </ul>
                    </div>
                </li>


                <li class="nav-item ">
                    {{--                    <a class="nav-link" data-toggle="collapse" href="#Settings"  href="#">--}}
                    {{--                        <i class="material-icons"> S</i>--}}
                    {{--                        <p>Settings--}}
                    {{--                            <b class="caret"></b>--}}
                    {{--                        </p>--}}
                    {{--                    </a>--}}
                    <a class="nav-link" data-toggle="collapse" href="#Settings"  href="/reports/BodyCorporateReports">
                        <i class="material-icons">S</i>
                        <p>Setting
                            <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse {{ (request()->segment(1) == 'categories' || request()->segment(1) == 'manageUsertype' || request()->segment(1) == 'manageWelcomeNote') ? 'show' : '' }}" id="Settings">
                        <ul class="nav">
                            <li class="nav-item {{ (request()->segment(1) == 'categories') ? 'active' : '' }}">
                                <a class="nav-link" href="/categories">
                                    <span class="sidebar-normal">Category Management </span>
                                </a>
                            </li>

                            <li class="nav-item {{ (request()->segment(1) == 'manageUsertype') ? 'active' : '' }}" style="margin-top: 0px !important;">
                                <a class="nav-link" href="/manageUsertype">
                                    <span>User type Management </span>
                                </a>
                            </li>
                            <li class="nav-item {{ (request()->segment(1) == 'manageWelcomeNote') ? 'active' : '' }}" style="margin-top: 0px !important;">
                                <a class="nav-link" href="/manageWelcomeNote">
                                    <span>Welcome Note Management </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>


                <li class="nav-item {{ (request()->segment(1) == 'subscription') ? 'active' : '' }}">
                    <a class="nav-link" href="/subscription">
                        <i class="material-icons">S</i>
                        <p>Subscription</p>
                    </a>
                </li>


            </ul>


        </div>
    </div>
    <div class="main-panel">

        <!-- Modal -->
        <div class="modal left fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <div class="logo"><a href="http://managershq.com.au/" class="simple-text logo-normal text-center">
                                <img width="92%" src="/public/logo.png">
                            </a></div>
                    </div>

                    <div class="modal-body">

                        <ul class="nav navbar-nav nav-mobile-menu">

                            @if(Route::current()->getName() != 'dashboard')

                                @if((request()->segment(1) == 'createQrcode') || (request()->segment(1) == 'web') || (request()->segment(1) == 'feedback'))
                                @if(count($properties) > 0)
                                        <span id="uuu88">Select Property</span>
                                    <li class="nav-item dropdown">

                                        <select  onchange="setProperty()" class="browser-default custom-select">
                                            <option  value="0" disabled>Select Property </option>

                                            @foreach($properties as $p)
                                                <option  value="{{$p->id}}"  {{(session()->get('property')==$p->id)?'selected':''}}>{{$p->title}}</option>

                                            @endforeach
                                        </select>

                                    </li>

                                @endif
                                @endif

                            @endif
                            <li class="nav-item">
                                <a class="dropdown-item" href="/user/logout">Log out</a>
                            </li>
                        </ul>

                        <ul class="nav">
                            <li class="nav-item {{ (request()->segment(1) == 'dashboard' || request()->segment(1) == '') ? 'active' : '' }} ">
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <p>Dashboard</p>
                                </a>
                            </li>


                            <li class="nav-item {{ (request()->segment(1) == 'createQrcode2') ? 'active' : '' }} {{ (request()->segment(1) == 'web') ? 'active' : '' }} {{ (request()->segment(1) == 'listqrcodes') ? 'active' : '' }} {{ request()->is('edit/web/*') ? 'active' : '' }} {{ request()->is('updateQr/*') ? 'active' : '' }} {{ request()->is('edit/web-content/*') ? 'active' : '' }}">
                                <a class="nav-link" href="{{route('list.qrcodes')}}">
                                    <p>Custom QR Code</p>
                                </a>
                            </li>

                            <li class="nav-item {{ (request()->segment(1) == 'vendors') ? 'active' : '' }} ">
                                <a class="nav-link" href="/vendors">
                                    <p>Vendors</p>
                                </a>
                            </li>



                            <li class="nav-item ">
                                <a class="nav-link" href="#!">
                                    <p id="feedback_toggle_button">Feedback <i class="fa fa-caret-down" id="caretdown_1"></i>  <i class="fa fa-caret-up" id="caretup_1" style="display: none;"></i> </p>
                                </a>
                               <ul id="feedback_list" style="display: none;">
                                   @foreach($userTypes as $p)
                                       <li><a href="/feedback/{{$p->feedback}}/open">{{$p->feedback}}</a> </li>
                                   @endforeach
                               </ul>

                            </li>


                            <li class="nav-item ">

                                <a class="nav-link" href="#!">
                                    <p id="setting_toggle_button">Setting <i class="fa fa-caret-down caret1" id="caretdown_2"></i> <i class="fa fa-caret-up" id="caretup_2" style="display: none;"></i> </p>
                                </a>
                                <ul id="setting_list" style="display: none;">
                                        <li><a href="/categories">Category Management</a> </li>
                                        <li><a href="/manageUsertype">User type Management</a> </li>
                                        <li><a href="/manageWelcomeNote">Welcome Note Management</a> </li>
                                </ul>

                            </li>


                            <li class="nav-item {{ (request()->segment(1) == 'subscription') ? 'active' : '' }}">
                                <a class="nav-link" href="/subscription">
                                    <p>Subscription</p>
                                </a>
                            </li>


                        </ul>
                    </div>

                </div><!-- modal-content -->
            </div><!-- modal-dialog -->
        </div>
        <!-- modal -->


        <!-- Modal -->

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-transparent navbar-absolute fixed-top ">
            <div class="container-fluid">
                <div class="navbar-wrapper">
                    {{--                    <a class="navbar-brand" href="javascript:;">@yield('title')</a>--}}
                    <a class="navbar-brand" style="cursor: default;" href="#">@yield('title')</a>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                    <span class="navbar-toggler-icon icon-bar"></span>
                </button>

                <div class="collapse navbar-collapse justify-content-end">

                    <ul class="navbar-nav">

                        @if((request()->segment(1) == 'createQrcode') || (request()->segment(1) == 'web') || (request()->segment(1) == 'feedback'))
                        @if(count($properties) > 0)
                            <li class="nav-item dropdown">

                                <select id="changeProperty" onchange="setProperty()" class="browser-default custom-select">
                                    <option  value="0" disabled>Select Property from following dropdown</option>

                                    @foreach($properties as $p)
                                        <option  value="{{$p->id}}"  {{(session()->get('property')==$p->id)?'selected':''}}>{{$p->title}}</option>
                                    @endforeach
                                </select>

                            </li>

                        @endif
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link" href="javascript:;" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="material-icons">person </i>
                                <p class="d-lg-none d-md-block">
                                    Account
                                </p>
                            </a>
                            <span>{{Auth::user()->first_name.' '.Auth::user()->last_name}}</span>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">

                                <a class="dropdown-item" href="/user/logout">
                                    Log out</a>
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div class="container-fluid">
                <nav class="float-left">

                </nav>
                <div class="copyright float-right">
                    &copy;
                    <script>
                        document.write(new Date().getFullYear())
                    </script>, by
                    <a href="http://managershq.com.au/policies" target="_blank">ManagersQr</a>
                </div>
            </div>
        </footer>
    </div>

</div>

<div class="modal fade" id="loadMe" tabindex="-1" role="dialog" aria-labelledby="loadMeLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content" style="height: 185px;">
            <div class="modal-body text-center">
                <div class="loader"></div>

            </div>
        </div>
    </div>
</div>



<!--   Core JS Files   -->

<script src="/public/vendor/js/core/jquery.min.js"></script>
<script src="/public/vendor/js/core/popper.min.js"></script>
<script src="/public/vendor/js/plugins/bootstrap-notify.js"></script>

<script src="/public/vendor/js/core/bootstrap-material-design.min.js"></script>
<script src="/public/vendor/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!-- Plugin for the momentJs  -->
<script src="/public/vendor/js/plugins/moment.min.js"></script>
<!--  Plugin for Sweet Alert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

{{--<script src="/public/vendor/js/plugins/sweetalert2.js"></script>--}}
<!-- Forms Validations Plugin -->
<script src="/public/vendor/js/plugins/jquery.validate.min.js"></script>
<!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
{{--<script src="/public/vendor/js/plugins/jquery.bootstrap-wizard.js"></script>--}}
{{--<!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->--}}
{{--<script src="/public/vendor/js/plugins/bootstrap-selectpicker.js"></script>--}}
{{--<!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->--}}
{{--<script src="/public/vendor/js/plugins/bootstrap-datetimepicker.min.js"></script>--}}
<!--  DataTables.net Plugin, full documentation here: https://datatables.net/  -->
<script src="/public/vendor/js/plugins/jquery.dataTables.min.js"></script>
<!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
{{--<script src="/public/vendor/js/plugins/bootstrap-tagsinput.js"></script>--}}
{{--<!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->--}}
{{--<script src="/public/vendor/js/plugins/jasny-bootstrap.min.js"></script>--}}
{{--<!--  Full Calendar Plugin, full documentation here: https://github.com/fullcalendar/fullcalendar    -->--}}
{{--<script src="/public/vendor/js/plugins/fullcalendar.min.js"></script>--}}
{{--<!-- Vector Map plugin, full documentation here: http://jvectormap.com/documentation/ -->--}}
{{--<script src="/public/vendor/js/plugins/jquery-jvectormap.js"></script>--}}
{{--<!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->--}}
{{--<script src="/public/vendor/js/plugins/nouislider.min.js"></script>--}}
{{--<!-- Include a polyfill for ES6 Promises (optional) for IE11, UAC Browser and Android browser support SweetAlert -->--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>--}}
{{--<!-- Library for adding dinamically elements -->--}}
{{--<script src="/public/vendor/js/plugins/arrive.min.js"></script>--}}
<!--  Google Maps Plugin    -->

<!-- Chartist JS -->
{{--<script src="/public/vendor/js/plugins/chartist.min.js"></script>--}}
<!--  Notifications Plugin    -->
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="/public/vendor/js/material-dashboard.js?v=2.1.2" type="text/javascript"></script>
<!-- Material Dashboard DEMO methods, don't includz\e it in your project! -->


<script src="/public/vendor/demo/demo.js"></script>
<script src="/public/js/custom.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>

<script>

    $(document).ready(function() {
        $('#example').dataTable( { "order": [[0,'desc']] });
        $('#datatable1').dataTable( { "order": [[0,'desc']] });
        //Fixing jQuery Click Events for the iPad
        var ua = navigator.userAgent,
            event = (ua.match(/iPad/i)) ? "touchstart" : "click";
        if ($('.table').length > 0) {
            $('.table .header').on(event, function() {
                $(this).toggleClass("active", "").nextUntil('.header').css('display', function(i, v) {
                    return this.style.display === 'table-row' ? 'none' : 'table-row';
                });
            });
        }
    })
    $(document).ready(function() {

        $("#feedbackId").val(null);
        $("#fillableKey").val(null);


        $().ready(function() {
            $sidebar = $('.sidebar');

            $sidebar_img_container = $sidebar.find('.sidebar-background');

            $full_page = $('.full-page');

            $sidebar_responsive = $('body > .navbar-collapse');

            window_width = $(window).width();

            fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();

            if (window_width > 767 && fixed_plugin_open == 'Dashboard') {
                if ($('.fixed-plugin .dropdown').hasClass('show-dropdown')) {
                    $('.fixed-plugin .dropdown').addClass('open');
                }

            }

            $('.fixed-plugin a').click(function(event) {
                // Alex if we click on switch, stop propagation of the event, so the dropdown will not be hide, otherwise we set the  section active
                if ($(this).hasClass('switch-trigger')) {
                    if (event.stopPropagation) {
                        event.stopPropagation();
                    } else if (window.event) {
                        window.event.cancelBubble = true;
                    }
                }
            });

            $('.fixed-plugin .active-color span').click(function() {
                $full_page_background = $('.full-page-background');

                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-color', new_color);
                }

                if ($full_page.length != 0) {
                    $full_page.attr('filter-color', new_color);
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.attr('data-color', new_color);
                }
            });

            $('.fixed-plugin .background-color .badge').click(function() {
                $(this).siblings().removeClass('active');
                $(this).addClass('active');

                var new_color = $(this).data('background-color');

                if ($sidebar.length != 0) {
                    $sidebar.attr('data-background-color', new_color);
                }
            });

            $('.fixed-plugin .img-holder').click(function() {
                $full_page_background = $('.full-page-background');

                $(this).parent('li').siblings().removeClass('active');
                $(this).parent('li').addClass('active');


                var new_image = $(this).find("img").attr('src');

                if ($sidebar_img_container.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    $sidebar_img_container.fadeOut('fast', function() {
                        $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                        $sidebar_img_container.fadeIn('fast');
                    });
                }

                if ($full_page_background.length != 0 && $('.switch-sidebar-image input:checked').length != 0) {
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $full_page_background.fadeOut('fast', function() {
                        $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                        $full_page_background.fadeIn('fast');
                    });
                }

                if ($('.switch-sidebar-image input:checked').length == 0) {
                    var new_image = $('.fixed-plugin li.active .img-holder').find("img").attr('src');
                    var new_image_full_page = $('.fixed-plugin li.active .img-holder').find('img').data('src');

                    $sidebar_img_container.css('background-image', 'url("' + new_image + '")');
                    $full_page_background.css('background-image', 'url("' + new_image_full_page + '")');
                }

                if ($sidebar_responsive.length != 0) {
                    $sidebar_responsive.css('background-image', 'url("' + new_image + '")');
                }
            });

            $('.switch-sidebar-image input').change(function() {
                $full_page_background = $('.full-page-background');

                $input = $(this);

                if ($input.is(':checked')) {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar_img_container.fadeIn('fast');
                        $sidebar.attr('data-image', '#');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page_background.fadeIn('fast');
                        $full_page.attr('data-image', '#');
                    }

                    background_image = true;
                } else {
                    if ($sidebar_img_container.length != 0) {
                        $sidebar.removeAttr('data-image');
                        $sidebar_img_container.fadeOut('fast');
                    }

                    if ($full_page_background.length != 0) {
                        $full_page.removeAttr('data-image', '#');
                        $full_page_background.fadeOut('fast');
                    }

                    background_image = false;
                }
            });

            $('.switch-sidebar-mini input').change(function() {
                $body = $('body');

                $input = $(this);

                if (md.misc.sidebar_mini_active == true) {
                    $('body').removeClass('sidebar-mini');
                    md.misc.sidebar_mini_active = false;

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar();

                } else {

                    $('.sidebar .sidebar-wrapper, .main-panel').perfectScrollbar('destroy');

                    setTimeout(function() {
                        $('body').addClass('sidebar-mini');

                        md.misc.sidebar_mini_active = true;
                    }, 300);
                }

                // we simulate the window Resize so the charts will get updated in realtime.
                var simulateWindowResize = setInterval(function() {
                    window.dispatchEvent(new Event('resize'));
                }, 180);

                // we stop the simulation of Window Resize after the animations are completed
                setTimeout(function() {
                    clearInterval(simulateWindowResize);
                }, 1000);

            });
        });
    });


    $('#RegisterValidation').validate();
</script>
<script>
    $(document).ready(function() {
        $('#datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],

            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });
        $('#datatablesinactive').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],

            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });

        $('#activity').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],

            order: [[0, "desc"]],
            info:false,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search Activity",
            }
        });

        var table = $('#datatable').DataTable();

        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');
            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        //Like record
        table.on('click', '.like', function() {
            alert('You clicked on Like button');
        });
    });
    $(document).ready(function() {
        $('.datatables').DataTable({
            "pagingType": "full_numbers",
            "lengthMenu": [
                [10, 25, 50, -1],
                [10, 25, 50, "All"]
            ],
            responsive: true,
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Search records",
            }
        });

        var table = $('.datatable').DataTable();

        // Edit record
        table.on('click', '.edit', function() {
            $tr = $(this).closest('tr');
            var data = table.row($tr).data();
            alert('You press on Row: ' + data[0] + ' ' + data[1] + ' ' + data[2] + '\'s row.');
        });

        // Delete a record
        table.on('click', '.remove', function(e) {
            $tr = $(this).closest('tr');
            table.row($tr).remove().draw();
            e.preventDefault();
        });

        //Like record
        table.on('click', '.like', function() {
            alert('You clicked on Like button');
        });
    });



    tinymce.init({
        selector: '#mytextarea'
    });

    $('.js-example-basic-single').select2({
        //placeholder: 'Select Property'
    });



</script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&libraries=places"></script>

<script type="text/javascript">
    function checkCategory() {
        var category=$("#categorySelect").val();

        if(category=='other'){
            $('#showField').show();
        }else{
            $('#showField').hide();
        }

    }
</script>
<script>


    function getanswers(formId){
        alert('form id ='+ formId);
    }


    $(document).ready(function() {
        $('.example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'selectAll',
                'selectNone',
                {

                    exportOptions: {
                        modifier: {
                            selected: null
                        }
                    }
                }
            ],
            select: true
        } );

        var table = $('.example').DataTable();



        table.on( 'select', function ( e, dt, type, indexes ) {
            $('#reportButton').prop('disabled', false);

            if (table.rows( '.selected' ).count() !== 0 ) {
                buttons.enable();
            }
        } );
        table.on( 'deselect', function ( e, dt, type, indexes ) {
            $('#reportButton').prop('disabled', true);

            if (table.rows( '.deselect' ).count() === 0 ) {
                buttons.disable();
            }
        } );


        $('#select2-options').select2({
            placeholder: 'Enter Vendor Name'
        });
        $('#select2-options2').select2({
            placeholder: 'Enter Vendor Name'
        });
        $('#select2-options3').select2({
            placeholder: 'Select Roles'
        });

        $('#projectImprovementsdonetable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'selectAll',
                'selectNone',
                {

                    exportOptions: {
                        modifier: {
                            selected: null
                        }
                    }
                }
            ],
            select: true
        } );
        $('#RepairManagmentdonetable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'selectAll',
                'selectNone',
                {

                    exportOptions: {
                        modifier: {
                            selected: null
                        }
                    }
                }
            ],
            select: true
        } );
        $('#RepairsMaintenancedonetable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'selectAll',
                'selectNone',
                {

                    exportOptions: {
                        modifier: {
                            selected: null
                        }
                    }
                }
            ],
            select: true
        } );

        $('#CarparkingGovernancetable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'selectAll',
                'selectNone',
                {

                    exportOptions: {
                        modifier: {
                            selected: null
                        }
                    }
                }
            ],
            select: true
        } );
        $('#QuotesApprovalstable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'selectAll',
                'selectNone',
                {

                    exportOptions: {
                        modifier: {
                            selected: null
                        }
                    }
                }
            ],
            select: true
        } );
    } );

    $(document).ready(function() {
        var table = $('#projectImprovementsdonetable').DataTable();



        table.on( 'select', function ( e, dt, type, indexes ) {


            if (table.rows( '.selected' ).count() > 1 ) {
                $('#reportButtonprojectImprovementsdone').prop('disabled', false);

                buttons.enable();
            }
        } );
        table.on( 'deselect', function ( e, dt, type, indexes ) {

            if (table.rows( '.deselect' ).count() <= 1 ) {
                $('#reportButtonprojectImprovementsdone').prop('disabled', true);

                buttons.disable();
            }
        } );

    });
    $(document).ready(function() {
        var table = $('#projectImprovementsdonetable').DataTable();



        table.on( 'select', function ( e, dt, type, indexes ) {


            if (table.rows( '.selected' ).count() > 1 ) {
                $('#reportButtonprojectImprovementsdone').prop('disabled', false);

                buttons.enable();
            }
        } );
        table.on( 'deselect', function ( e, dt, type, indexes ) {

            if (table.rows( '.deselect' ).count() <= 1 ) {
                $('#reportButtonprojectImprovementsdone').prop('disabled', true);

                buttons.disable();
            }
        } );

    });
    $(document).ready(function() {
        var table = $('#RepairManagmentdonetable').DataTable();



        table.on( 'select', function ( e, dt, type, indexes ) {
            $('#reportButtonRepairManagmentdone').prop('disabled', false);

            if (table.rows( '.selected' ).count() !== 0 ) {
                buttons.enable();
            }
        } );
        table.on( 'deselect', function ( e, dt, type, indexes ) {
            $('#reportButtonRepairManagmentdone').prop('disabled', true);

            if (table.rows( '.deselect' ).count() === 0 ) {
                buttons.disable();
            }
        } );

    });
    $(document).ready(function() {
        var table = $('#RepairsMaintenancedonetable').DataTable();



        table.on( 'select', function ( e, dt, type, indexes ) {
            $('#reportButtonRepairsMaintenancedone').prop('disabled', false);

            if (table.rows( '.selected' ).count() !== 0 ) {
                buttons.enable();
            }
        } );
        table.on( 'deselect', function ( e, dt, type, indexes ) {
            $('#reportButtonRepairsMaintenancedone').prop('disabled', true);

            if (table.rows( '.deselect' ).count() === 0 ) {
                buttons.disable();
            }
        } );

    });
    $(document).ready(function() {
        var table = $('#CarparkingGovernancetable').DataTable();



        table.on( 'select', function ( e, dt, type, indexes ) {
            $('#reportButtonCarparkingGovernance').prop('disabled', false);

            if (table.rows( '.selected' ).count() !== 0 ) {
                buttons.enable();
            }
        } );
        table.on( 'deselect', function ( e, dt, type, indexes ) {
            $('#reportButtonCarparkingGovernance').prop('disabled', true);

            if (table.rows( '.deselect' ).count() === 0 ) {
                buttons.disable();
            }
        } );

    });
    $(document).ready(function() {
        var table = $('#QuotesApprovalstable').DataTable();



        table.on( 'select', function ( e, dt, type, indexes ) {
            $('#reportButtonQuotesApprovals').prop('disabled', false);

            if (table.rows( '.selected' ).count() !== 0 ) {
                buttons.enable();
            }
        } );
        table.on( 'deselect', function ( e, dt, type, indexes ) {
            $('#reportButtonQuotesApprovals').prop('disabled', true);

            if (table.rows( '.deselect' ).count() === 0 ) {
                buttons.disable();
            }
        } );

    });
</script>

<script>
    function combineReports(table,id,role_id) {

        $('#table_value').val(table);
        $('#id_value').val(id);
        $('#role_id_value').val(role_id);


        $('#smallModal').modal('show');




    }

    function addName(){

        $('#smallModal').modal('hide');
        var  name=$('#combineReportName').val();
        var table=$('#table_value').val();
        var id=$('#id_value').val();
        var role_id=$('#role_id_value').val();

        var table = $('#'+table).DataTable();

        var data= table.rows('.selected').data();

        var reports=[];
        for(var i=0;i<=data.length;i++){


            var report_id=data[i];
            reports.push(report_id);
        }


        $('#reportButton'+id).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span>  Combining...")
        $('#reportButton'+id).prop('disabled', true);
        $.ajax({



            type:'POST',
            url:'/reports/combineReports',
            data:{"reports":reports,"name":name,"role_id":role_id,"_token": "{{ csrf_token() }}"},
            success:function(data) {

                report_ids=data.reports_id;

                console.log(reports);

                for(var i=0;i<=reports.length;i++){

                    if(reports[i]!=undefined){
                        table
                            .row( $('#reportsid'+reports[i][0].substring(2)).parents('tr') )
                            .remove()
                            .draw();
                        $('#reportsid'+reports[i][0].substring(2)).parents('tr').remove();
                    }

                }

                $('#headeing'+id).show()
                $('#combine-reports'+id).html(data.combine_reports)
                $('#reportButton'+id).html("Combine Reports")
                $('#reportButton'+id).prop('disabled', false);

                $(function() {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: 'top-end',
                        showConfirmButton: false,
                        timer: 3000
                    });

                    Toast.fire({
                        type: 'success',
                        title: "reports Combined Successfully!"
                    })
                });

            }
        });
    }





</script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.5.0/firebase-firestore.js"></script>

<script>
    // Your web app's Firebase configuration
    // For Firebase JS SDK v7.20.0 and later, measurementId is optional
    var firebaseConfig = {
        apiKey: "AIzaSyAXOjdjGkn6drok7I5Ttaw0ZWygiY0P80o",
        authDomain: "carseem-deac6.firebaseapp.com",
        databaseURL: "https://carseem-deac6.firebaseio.com",
        projectId: "carseem-deac6",
        storageBucket: "carseem-deac6.appspot.com",
        messagingSenderId: "345617863049",
        appId: "1:345617863049:web:c76359d9d0a1e381eb9158",
        measurementId: "G-HQNT1DL6VE"
    };

    firebase.initializeApp(firebaseConfig);
    var db = firebase.firestore();



    var count=0;


    var initState = true;
    db.collection('managersqr').onSnapshot(snapshot=>{

            let changes=snapshot.docChanges();
            changes.forEach(change=>{

                let newChange=change.doc.data().read;
                var auth_id='{{Auth::user()->id}}';


                if(change.type=='added' && newChange==true && change.doc.data().user_id==auth_id){


                    console.log(change.doc.data());
                    $.notify({
                        icon: "add_alert",
                        message: change.doc.data().message

                    },{
                        type: 'info',
                        timer: 1000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });

                    var id=change.doc.id;

                    $.ajax({
                        url:'/updateNotificationStatus',
                        type:"post",
                        data:{"id":id,"message":change.doc.data().message,"user_id":change.doc.data().user_id,"feedback_id":change.doc.data().feedback_id,"_token": "{{ csrf_token() }}"},
                        success: function(data){

                            var table = $('#activity').DataTable();
                            table.row.add( [
                                data,
                                '<a style="color:black" href="/feedback/'+change.doc.data().feedback_id+'">'+change.doc.data().message+'</a>',
                                '    <td >\n' +
                                '                                                  <a href="/closedFeedback/'+change.doc.data().feedback_id+'" data-toggle="tooltip" data-placement="top" title="Close Feedback" class="btn  btn-success">Close and remove<div class="ripple-container"></div></a> <button id="send'+change.doc.data().feedback_id+'" data-toggle="tooltip" data-placement="top" onclick="createReport('+change.doc.data().feedback_id+')" title="Send Report" class="btn btn-info">Send<div class="ripple-container"></div></button>\n' +
                                '                                               </td>',


                            ] ).draw( false );
                        }
                    });
                }
            })
        }
    )


</script>
<script>

    function deleteNotification(id) {

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {

            if (result.isConfirmed) { $.ajax({
                url:'/deleteNotification',
                type:"post",
                data:{"id":id,"_token": "{{ csrf_token() }}"},
                success: function(data){

                    var table = $('#activity').DataTable();
                    $tr = $('#notification'+id).closest('tr');
                    table.row($tr).remove().draw();

                    $.notify({
                        icon: "add_alert",
                        message: 'Notification deleted successfully !'

                    },{
                        type: 'success',
                        timer: 1000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });




                }
            });}



        })

    }

    $(document).on('click', '.navbar-toggler', function() {
        $('#myModal').modal('show');
    });

    $(document).on('click', '#feedback_toggle_button', function() {
        $('#feedback_list').toggle('slow');
        $('#caretdown_1').toggle('slow');
        $('#caretup_1').toggle('slow');
    });

    $(document).on('click', '#setting_toggle_button', function() {
        $('#setting_list').toggle('slow');
        $('#caretdown_2').toggle('slow');
        $('#caretup_2').toggle('slow');
    });

</script>

<script>
    $(document).ready(function(){


        // Add minus icon for collapse element which is open by default
        $(".collapse.show").each(function(){
            $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
        });

        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function(){
            $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
        }).on('hide.bs.collapse', function(){
            $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
        });
    });
</script>

@if(Session::has('downloadFile'))
    <script>
        window.addEventListener("load", function () {
            animation();
            setTimeout(otherOperation, 5000);
        }, false);

        function animation() {

            $('#loadMe').modal('show');
        }
        function otherOperation() {
            $('#loadMe').modal('hide');


        }


    </script>
    {{ Session::forget('downloadFile') }}
@endif


@yield('scripts')
</body>

</html>

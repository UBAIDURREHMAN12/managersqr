<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha256-eZrrJcwDc/3uDhsdt61sL2oOBY362qM3lon1gyExkL0=" crossorigin="anonymous" />

<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
{{--        <div class="image">--}}
{{--            <img src="{{ asset('/assets/images/user.png') }}" width="48" height="48" alt="User" />--}}
{{--        </div>--}}
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ Session::get('name') }}</div>
            <div class="email">{{ Session::get('email') }}</div>
            <div class="btn-group user-helper-dropdown">
{{--                <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>--}}
                <ul class="dropdown-menu pull-right">
{{--                    <li><a href="javascript:void(0);"><i class="material-icons">person</i>Profile</a></li>--}}
{{--                    <li role="separator" class="divider"></li>--}}
{{--                    <li><a href="javascript:void(0);"><i class="material-icons">group</i>Followers</a></li>--}}
{{--                    <li><a href="javascript:void(0);"><i class="material-icons">shopping_cart</i>Sales</a></li>--}}
{{--                    <li><a href="javascript:void(0);"><i class="material-icons">favorite</i>Likes</a></li>--}}
{{--                    <li role="separator" class="divider"></li>--}}
                    <li><a href="/logout"><i class="material-icons">input</i>Sign Out</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
{{--    <div class="menu">--}}
{{--        <ul class="list">--}}
{{--            <li class="active">--}}
{{--                <a href="/dashboard">--}}
{{--                    <i class="material-icons">home</i>--}}
{{--                    <span>Procuriot</span>--}}
{{--                </a>--}}
{{--            </li>--}}

{{--        </ul>--}}
{{--    </div>--}}
    <div class="menu">

        @if(Session::get('role')=='superadmin')
            <ul class="list">
                <li>
                    <a href="https://procuriot.ioptime.com/organizations">
                        <i class="fa fa-home" style="margin-top: 3%;font-size: 17px;"></i>
                        <span style="color: black;">Organizations</span>
                    </a>
                </li>

                <li>
                    <a href="https://procuriot.ioptime.com/admins/list">
                        <i class="fa fa-users" style="margin-top: 3%;font-size: 17px;"></i>
                        <span style="color: black;">Admins</span>
                    </a>
                </li>

            </ul>
            @endif

            @if(Session::get('role')=='admin')
                <ul class="list">
{{--                    <li class="header">MAIN NAVIGATION</li>--}}
                    <li>
                        <a href="https://procuriot.ioptime.com/venues">
                            <i class="fa fa-map-marker" style="margin-top: 4%;font-size: 23px;"></i>
                            <span style="color: black;margin-top: 5%;">Create Venue</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://procuriot.ioptime.com/venues/list">
                            <i class="fa fa-university" style="margin-top: 3%;font-size: 17px;"></i>
                            <span style="color: black;">Venues List</span>
                        </a>
                    </li>
                    <li>
                        <a href="https://procuriot.ioptime.com/gateways">
                            <i class="fa fa-rss" style="margin-top: 3%;font-size: 17px;"></i>
                            <span style="color: black;">Gateways</span>
                        </a>
                    </li>

                    <li>
                        <a href="/self_admins">
                            <i class="material-icons fas fa-users" style="margin-top: 3%;font-size: 17px;"></i>
                            <span style="color: black;">Admins</span>
                        </a>
                    </li>

                    <li>
                        <a href="/moderators">
                            <i class="material-icons fa fa-user-circle-o" style="margin-top: 3%;font-size: 17px;"></i>
                            <span style="color: black;">Moderators</span>
                        </a>
                    </li>

                </ul>
            @endif

            @if(Session::get('role')=='moderator')
                <ul class="list">
{{--                    <li class="header">MAIN NAVIGATION</li>--}}
                    <li>
                        <a href="https://procuriot.ioptime.com/venues/list/for/moderator">
                            <i class="fa fa-university" style="margin-top: 3%;font-size: 17px;"></i>
                            <span style="color: black;">Venues</span>
                        </a>
                    </li>

                    <li>
                        <a href="https://procuriot.ioptime.com/beacons/show/to/moderator">
                            <i class="fa fa-bullseye" style="margin-top: 3%;font-size: 23px;"></i>
                            <span style="margin-top: 4%;">Beacons</span>
                        </a>
                    </li>

{{--                    <li>--}}
{{--                        <a href="https://procuriot.ioptime.com/gatewaysForModerators">--}}
{{--                            <i class="material-icons">text_fields</i>--}}
{{--                            <span>Gateways</span>--}}
{{--                        </a>--}}
{{--                    </li>--}}

                </ul>
            @endif

    </div>
    <!-- #Menu -->
    <!-- Footer -->
    <div class="legal">
        <div class="copyright">
            Procuriot © 2022 All Rights Reserved <a href="javascript:void(0);" style="color: #6860FF !important;"></a>.
        </div>
    </div>
    <!-- #Footer -->
</aside>
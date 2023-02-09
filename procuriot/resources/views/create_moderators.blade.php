<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Blank Page | Bootstrap Based Admin Template - Material Design</title>
    <!-- Favicon-->
    <link rel="icon" href="../../favicon.ico" type="image/x-icon">
    {{--/////////////////////////////////////////////////////////--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

{{--    ////////////////////////////////////////////////////--}}
<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Bootstrap Core Css -->
    <link href="{{asset('/assets/plugins/bootstrap/css/bootstrap.css')}}" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="{{asset('/assets/plugins/node-waves/waves.css')}}" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="{{asset('/assets/plugins/animate-css/animate.css')}}" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="{{asset('/assets/css/style.css')}}" rel="stylesheet">

    <!-- AdminBSB Themes. You can choose a theme from css/themes instead of get all themes -->
    <link href="{{asset('/assets/css/themes/all-themes.css')}}" rel="stylesheet" />

    <style>
        #geomap{
            width: 100%;
            height: 200px;
            margin-top: 1%;
        }

        .dropdown-toggle {
            display: none;
        }
        .ub66 {
            width: 100px !important;
        }


    </style>
</head>

<body class="theme-red">


<!-- Top Bar -->
@include('components.navbar')
<!-- #Top Bar -->
<section>
    <!-- Left Sidebar -->
@include('components.sidebar')
<!-- #END# Left Sidebar -->
    <!-- Right Sidebar -->
@include('components.rightsidebar')
<!-- #END# Right Sidebar -->
</section>

<section class="content" style="margin-top: 0px !important;">
    <div class="container-fluid">
        <div class="block-header">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div id="result"></div>



            <form id="add_moderator_form">
                <div id="form_result133"></div>
                <span id="form_result2"></span>
                @csrf

                <input type="hidden" name="get_moderator_id" @if(isset($data->id)) value="{{$data->id}}" @endif >

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">First Name</label>
                            <div class="form-line">
                                <input type="text" name="first_name"  maxlength="100" class="form-control" id="first_name" @if(isset($data->first_name)) value="{{$data->first_name}}" @endif required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Last Name</label>
                            <div class="form-line">
                                <input type="text" name="last_name"  maxlength="100" class="form-control" id="last_name" @if(isset($data->last_name)) value="{{$data->last_name}}" @endif required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label class="form-label">Email</label>
                            <div class="form-line">
                                <input type="email" name="email"  maxlength="100" class="form-control" id="email" @if(isset($data->email)) value="{{$data->email}}" @endif required>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Organization</label>
                            <div class="form-line">
                                <input type="text" name="organization"  maxlength="100" class="form-control"
                                       id="organization"
                                       value="@if($data2->company) {{ \App\Organization::where(['id' => $data2->company])->pluck('name')->first() }} @endif"  required readonly>
                            </div>
                        </div>
                    </div>



                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Contact</label>
                            <div class="form-line">
                                <input type="text" name="phone"  maxlength="100" class="form-control phone" id="phone" @if(isset($data->phone)) value="{{$data->phone}}" @endif required>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <label class="form-label">Address</label>
                        <input type="text" id="search_location" class="form-control" @if(isset($data->address)) value="{{$data->address}}" @endif name="address" placeholder="Search location" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div id="geomap"></div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="search_addr" class="search_addr" @if(isset($data->address)) value="{{$data->address}}" @endif size="45">
                        <input type="hidden" name="edit_org_id" id="edit_org_id" @if(isset($data->id)) value="{{$data->id}}" @endif size="45">
                        <input type="hidden" name="latitude" @if(isset($data->latitude)) value="{{$data->latitude}}" @endif class="search_latitude" size="30">
                        <input type="hidden" name="longitude" @if(isset($data->longitude)) value="{{$data->longitude}}" @endif class="search_longitude" size="30">
                    </div>
                </div>


                <div class="row" style="margin-top: 1%;">
                    <div class="col-md-12" style="text-align: right;">
                        @if(isset($data->id))
                            <button type="submit" class="btn update_button" style="background-color: #6860FF;color: white;margin-right: 1%;width: 6%;">Update</button>
                        @else
                            <button type="submit" class="btn update_button" style="background-color: #6860FF;color: white;margin-right: 1%;width: 6%;">Add</button>
                        @endif
                        <a href="{{url('https://procuriot.ioptime.com/moderators')}}"
                           class="btn" style="float: right;margin-right: 1%; width: 6%;background-color: #6860FF;color: white;">Back</a>
                    </div>
                </div>

            </form>


            <!-- display google map -->


            <!-- display selected location information -->
        </div>
    </div>
</section>

<!-- Jquery Core Js -->
<script src="{{asset('/assets/plugins/jquery/jquery.min.js')}}"></script>

<!-- Bootstrap Core Js -->
<script src="{{asset('/assets/plugins/bootstrap/js/bootstrap.js')}}"></script>

<!-- Select Plugin Js -->
<script src="{{asset('/assets/plugins/bootstrap-select/js/bootstrap-select.js')}}"></script>

<!-- Slimscroll Plugin Js -->
<script src="{{asset('/assets/plugins/jquery-slimscroll/jquery.slimscroll.js')}}"></script>

<!-- Waves Effect Plugin Js -->
<script src="{{asset('/assets/plugins/node-waves/waves.js')}}"></script>

<!-- Custom Js -->
<script src="{{asset('/assets/js/admin.js')}}"></script>

<!-- Demo Js -->
<script src="{{asset('/assets/js/demo.js')}}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&libraries=places"></script>
{{--<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&libraries=places&components=country:US"></script>--}}



<script>
    var geocoder;
    var map;
    var marker;

    /*
     * Google Map with marker
     */
    function initialize() {
        var initialLat = $('.search_latitude').val();
        var initialLong = $('.search_longitude').val();
        initialLat = initialLat?initialLat:36.169648;
        initialLong = initialLong?initialLong:-115.141000;


        const center = { lat: 50.064192, lng: -130.605469 };

        // const defaultBounds = {
        //     north: center.lat + 0.1,
        //     south: center.lat - 0.1,
        //     east: center.lng + 0.1,
        //     west: center.lng - 0.1,
        // };

        var latlng = new google.maps.LatLng(initialLat, initialLong);
        var options = {
            zoom: 16,
            center: latlng,
            componentRestrictions: { country: "us" },
            // bounds: defaultBounds,
            strictBounds: true,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
        };

        map = new google.maps.Map(document.getElementById("geomap"), options);

        geocoder = new google.maps.Geocoder();

        marker = new google.maps.Marker({
            map: map,
            draggable: false,
            position: latlng
        });

        google.maps.event.addListener(marker, "dragend", function () {
            var point = marker.getPosition();
            map.panTo(point);
            geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);
                    $('.search_addr').val(results[0].formatted_address);
                    $('.search_latitude').val(marker.getPosition().lat());
                    $('.search_longitude').val(marker.getPosition().lng());
                }
            });
        });

    }

    $(document).ready(function () {
        //load google map
        initialize();

        /*
         * autocomplete location search
         */
        var PostCodeid = '#search_location';


        $(function () {

            $(PostCodeid).autocomplete({

                source: function (request, response) {
                    geocoder.geocode({
                        'address': request.term
                    }, function (results, status) {
                        response($.map(results, function (item) {
                            return {
                                label: item.formatted_address,
                                value: item.formatted_address,
                                lat: item.geometry.location.lat(),
                                lon: item.geometry.location.lng()
                            };
                        }));
                    });
                },
                select: function (event, ui) {
                    $('.search_addr').val(ui.item.value);
                    $('.search_latitude').val(ui.item.lat);
                    $('.search_longitude').val(ui.item.lon);
                    var latlng = new google.maps.LatLng(ui.item.lat, ui.item.lon);
                    marker.setPosition(latlng);
                    initialize();
                }
            });
        });

        /*
         * Point location on google map
         */
        $('.get_map').click(function (e) {
            var address = $(PostCodeid).val();
            geocoder.geocode({'address': address}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);
                    marker.setPosition(results[0].geometry.location);
                    $('.search_addr').val(results[0].formatted_address);
                    $('.search_latitude').val(marker.getPosition().lat());
                    $('.search_longitude').val(marker.getPosition().lng());
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
            e.preventDefault();
        });

        //Add listener to marker for reverse geocoding
        google.maps.event.addListener(marker, 'drag', function () {
            geocoder.geocode({'latLng': marker.getPosition()}, function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    if (results[0]) {
                        $('.search_addr').val(results[0].formatted_address);
                        $('.search_latitude').val(marker.getPosition().lat());
                        $('.search_longitude').val(marker.getPosition().lng());
                    }
                }
            });
        });
    });


    $("#add_moderator_form").submit(function(e) {

        event.preventDefault();
        $.ajax({
            url: "https://procuriot.ioptime.com/add/moderator",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {

                var html = '';
                if(data.errors)
                {
                    html = '<div class="alert alert-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';

                    $('#form_result2').html(null);
                    $('#form_result1').html(null);
                    $('#form_result2').html(html);

                }
                if(data.success)
                {
                    html = '<p style="color:blue">' + data.success + '</p>';
                    $('#add_moderator_form')[0].reset();
                    $('#form_result1').html(null);
                    $('#form_result2').html(null);
                    $('#form_result1').html(html);
                    $('.search_latitude').val(null);
                    $('.search_longitude').val(null);
                    // window.location.reload('https://procuriot.ioptime.com/organizations');
                    window.location.href = 'https://procuriot.ioptime.com/moderators';
                }
                if(data.updated){
                    window.location.reload();
                    var html22 = '<p style="color:blue">' + data.updated + '</p>';
                    $('#add_moderator_form')[0].reset();
                    $('#form_result1').html(null);
                    $('#form_result2').html(null);
                    $('#form_result133').html(html22);
                    $('.search_latitude').val(null);
                    $('.search_longitude').val(null);
                }

            }
        })
    });

</script>

</body>

</html>

@include('components.head')

<style>
    #map_canvas {
        height: 300px;
    }
    /*#current {*/
    /*    padding-top: 25px;*/
    /*}*/
</style>
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

<section class="content">
    <div class="container-fluid">

        {{--        <div class="row">--}}
        {{--            <div class="col-md-4" style="text-align: right;">--}}
        {{--            </div>--}}
        {{--            <div class="col-md-4">--}}
        {{--                <pre>--}}
        {{--                    <span>Add gateway</span> <button class="btn btn-info btn-sm add-gateway" id="ub" style="border-radius: 5%;">+</button>--}}

        {{--                </pre>--}}

        {{--            </div>--}}
        {{--            <div class="col-md-4" style="text-align: right;">--}}
        {{--            </div>--}}
        {{--        </div>--}}

        <div class="row clearfix add_venue_modal" style="margin-top: 2%;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Add venue
                        </h2>

                    </div>
                    <div class="body">

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
                            <form id="add_menue_form">

                                <span id="form_result1"></span>

                                @csrf
                                <div class="row clearfix">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="name" maxlength="100" class="form-control">
                                                <label class="form-label">Venue Name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                        <div class="form-group form-float">
                                            <div class="form-line">
                                                <input type="text" name="description" class="form-control">
                                                <label class="form-label">Venue Description</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <div class="form-group form-float">
                                            <div id='map_canvas'></div>
                                            <div id="current">Nothing yet...</div>
                                        </div>
                                    </div>

                                    <input type="hidden" name="latitude" id="latitude">
                                    <input type="hidden" name="longitude" id="longitude">


                                    <div class="col-lg2 col-md2 col-sm2 col-xs-2 ub">
                                        <input type="checkbox" id="remember_me_5" class="filled-in">
                                        <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Add</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row clearfix add_gateway_modal" style="margin-top: 2%;">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2>
                            Add gateway
                            <small>With configuration</small>
                        </h2>

                    </div>
                    <div class="body">
                        @if (count($errors) > 0)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                        @endif

                            <span id="form_result2"></span>
                        <form id="add_gateway_form">
                            @csrf
                            <div class="row clearfix">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="title" maxlength="100" class="form-control" required>
                                            <label class="form-label">Device title</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <input type="text" name="mac" class="form-control" required>
                                            <label class="form-label">Config/Mac address</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                            <select  class="form-control" name="location" required>
                                                <option value=" ">select location</option>
                                               @foreach($locations as $location)
                                                    <option value={{$location->id}}>{{$location->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>


                              <div class="row">
                                  <div class="col-lg2 col-md2 col-sm2 col-xs-2">
                                      <input type="checkbox" id="remember_me_5" class="filled-in">
                                      <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Add</button>
                                  </div>
                              </div>

                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&libraries=places"></script>

<script>
    $(document).ready(function(){
        $('.dropdown-toggle').css('display', 'none');
        var map = new google.maps.Map(document.getElementById('map_canvas'), {
            zoom: 1,
            center: new google.maps.LatLng(35.137879, -82.836914),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        });

        var myMarker = new google.maps.Marker({
            position: new google.maps.LatLng(47.651968, 9.478485),
            draggable: true
        });

        google.maps.event.addListener(myMarker, 'dragend', function (evt) {
            document.getElementById('current').innerHTML = '<p>Marker dropped: Current Lat: ' + evt.latLng.lat().toFixed(3) + ' Current Lng: ' + evt.latLng.lng().toFixed(3) + '</p>';

            $('#latitude').val(evt.latLng.lat().toFixed(3));
            $('#longitude').val(evt.latLng.lng().toFixed(3));

        });

        google.maps.event.addListener(myMarker, 'dragstart', function (evt) {
            document.getElementById('current').innerHTML = '<p>Currently dragging marker...</p>';
        });

        map.setCenter(myMarker.position);
        myMarker.setMap(map);
        $("#box").mousemove(function(event){
            var relX = event.pageX - $(this).offset().left;
            var relY = event.pageY - $(this).offset().top;
            var relBoxCoords = "(" + relX + "," + relY + ")";
            $(".mouse-cords").text(relBoxCoords);
        });

        $(".add-gateway").click(function(){
            $(".add_gateway_modal").toggle('slow');
        });


    });

    $('#add_menue_form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "https://procuriot.ioptime.com/add/venue",
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
                }
                if(data.success)
                {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#add_menue_form')[0].reset();
                    $('#form_result1').html(null);
                    $('#form_result1').html(html);
                }

            }
        })
    });

    $('#add_gateway_form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "https://procuriot.ioptime.com/add/gateway",
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
                }
                if(data.success)
                {
                    window.location.reload('https://procuriot.ioptime.com/dashboard');
                    // html = '<div class="alert alert-success">' + data.success + '</div>';
                    // $('#add_menue_form')[0].reset();
                    // $('#form_result2').html(null);

                }
                $('#form_result2').html(html);
            }
        })
    });

</script>

@include('components.footer')


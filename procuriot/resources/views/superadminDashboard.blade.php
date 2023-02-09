@include('components.head')

<link rel="icon" href="favicon.ico" type="image/x-icon">

<!-- Google Fonts -->
<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&subset=latin,cyrillic-ext" rel="stylesheet" type="text/css">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">
<script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
<link rel="stylesheet" type="text/css" href="./style.css" />
<link type="text/css" rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link type="text/css" rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>



<style>
    #geomap{
        width: 100%;
        height: 400px;
    }
    .dropdown-toggle {
        display: none;
    }

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

    <section class="content">


        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4">
                    <h4 style="font-weight: bold;font-size: 18px;">Organizations</h4>
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4" style="text-align: right;">
{{--                    <button class="btn" id="fa-plus" style="float: right;background-color: #6860FF;color: white;font-size: 14px;">Add Organization</button>--}}
                    <a href="{{url('/create/org')}}" class="btn" style="float: right;background-color: #6860FF;color: white;font-size: 14px;">Add Organization</a>

                </div>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="body" style="margin-top: 1%;">
                            <div class="table-responsive">
                                <table class="table">

                                    <thead>
                                    <tr>
                                        <th scope="col" style="width: 25%;">Organization Name</th>
                                        <th scope="col" style="width: 25%;">Contact</th>
                                        <th scope="col" style="width: 25%;">Address</th>
                                        <th scope="col" style="width: 25%;text-align: center;">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($organizations as $value)
                                        <tr>
                                            <td style="width: 25%;"> {{$value->name}}</td>
                                            <td style="width: 25%;"> {{ $value->contact }}</td>
                                            <td style="width: 25%;"> {{ $value->address }}</td>
                                            <td style="width: 25%;text-align: center;">
{{--                                                <i title="Edit" class="fa fa-edit"id="{{$value->id}}" style="color: darkgray;font-size: 20px;"></i>--}}
                                                <a href="{{url('https://procuriot.ioptime.com/create/org/'.$value->id)}}"
                                                   title="Edit" style="font-size: 20px;color: darkgray !important;"> <i class="fa fa-edit"></i> </a>
                                                <i title="Delete" class="fa fa-trash" id="{{$value->id}}" style="color: darkgray;font-size: 20px;"></i>
                                            </td>
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>


        <div class="modal add_org_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Organization</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">
                                <span id="spnPhoneStatus2" style="color: red;"></span>
                            </div>
                        </div>
                        <form id="add_org_form">

                            {{--                            <span id="form_result13" style="color: blue;"></span>--}}

                            @csrf

                            <div class="row processing2" style="display: none;">
                                <div class="col-md-12"; style="text-align: center;">
                                    <span style="color: #6860FF;">processing...</span>
                                </div>
                            </div>

                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Name</label>
                                        <div class="form-line">
                                            <input type="text" name="name"  maxlength="100" class="form-control" id="name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form-float">
                                        <label for="phone">Contact</label><br/>
                                        <div class="form-line">
                                            {{--                                            <input id="phone" class="phone" name="phone" class="phone" type="tel" style="border: none;">--}}
                                            <input  id="phone" class="phone form-control" name="phone" type="tel"  style="border: none;" required >
                                            <input type="hidden" name="get_c_code" id="get_c_code">
                                        </div>
                                    </div>
                                </div>




{{--                                <div class="row" style="margin-left: 1%;">--}}
{{--                                    <div class="col-md-12">--}}
{{--                                        <div class="form-group form-float">--}}
{{--                                            <label class="form-label">Address</label>--}}
{{--                                            <div class="form-line">--}}
{{--                                                <input type="text" name="address" class="form-control" id="address" required>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}


                                <div class="col-lg-12">
                                    <label style="margin-left: 2%;">Address</label>
                                    <div class="col-md-12">
                                        <input id="map-search"  style="border: 2px solid lightblue;" type="text" class="form-control " name="address" placeholder="Street , city, state" value="" required autocomplete="address">

                                    </div>
                                </div>
                                <div class="col-lg-12" style="margin-top: 1%;">
                                    <div class="col-md-12">

                                        <div style='height: 300px;
                                        position: relative;
                                        overflow: hidden;
                                        width: 100%;' id="map-canvas"></div>

                                    </div>
                                </div>

                                <div class="form-group row clearfix">
                                    <div class="col-md-6">
                                        <input id="email" type="hidden" class="form-control latitude " name="latitude" value="33.5651" required autocomplete="latitude">
                                    </div>
                                    <div class="col-md-6">
                                        <input id="email" type="hidden" class="form-control longitude " name="longitude" value="73.0169" value="" required autocomplete="longitude">

                                    </div>
                                </div>

                                <button type="submit" class="btn btn-lg m-l-15 waves-effect"
                                        style="background-color: #6860FF;color: white;font-size: 14px;float: right;margin-right: 2%;">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal org_edit_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Organization</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="update_org_form">
                            <span id="spnPhoneStatus3" style="color: red;"></span>
                            <input type="hidden" name="edit_org_id" id="edit_org_id">
                            <span id="form_result12" style="color: #6860FF;"></span>

                            @csrf
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Name</label>
                                        <div class="form-line">
                                            <input type="text" name="edit_org_name"  maxlength="100" class="form-control" id="edit_org_name" required>
                                        </div>
                                    </div>
                                </div>
                                {{--                                <div class="col-lg-5 col-md-4 col-sm-5 col-xs-5">--}}
                                {{--                                    <div class="form-group form-float">--}}
                                {{--                                        <label class="form-label">Contact</label>--}}
                                {{--                                        <div class="form-line">--}}
                                {{--                                            <input type="text" name="edit_contact" class="form-control" id="edit_contact" required>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form-float">
                                        <label for="phone">Contact (format: xxx-xxx-xxxx)</label><br/>
                                        <div class="form-line">
                                            <input id="edit_contact" class="form-control phone2" pattern="\d{3}[\-]\d{3}[\-]\d{4}" name="edit_contact" type="tel" style="border: none;">
                                            <input type="hidden" name="get_c_code2" id="get_c_code2">
                                        </div>
                                        <span id="spnPhoneStatus"></span>
                                    </div>
                                </div>
                                {{--                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">--}}
                                {{--                                    <div class="form-group form-float">--}}
                                {{--                                        <div>--}}
                                {{--                                            <span id="spnPhoneStatus"></span>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                {{--                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">--}}
                                {{--                                    <div class="form-group form-float">--}}
                                {{--                                        <div style="margin-top: 60%;">--}}
                                {{--                                            <span id="spnPhoneStatus_1"></span>--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}

                                <div class="row" style="margin-left: 1%;">
                                    <div class="col-md-12">
                                        <div class="form-group form-float">
                                            <label class="form-label">Address</label>
                                            <div class="form-line">
                                                <input type="text" name="edit_address" class="form-control" id="edit_address" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <button type="submit" class="btn btn-lg m-l-15  btn-update"
                                        style="background-color: #6860FF;color: white;float: right;
                                font-size: 14px;margin-right: 2%;">Update</button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

    </section>


    <div class="modal processing_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            <p style="color: #6860FF;">processing...</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal response_modal2" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="text-align: center;">
                    <span style="color: #6860FF;">Organization Deleted Successfully</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal confirmation_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete this organization ?</p>
                    <input type="hidden" id="set_org_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn custom-confirmation" style="color: #6860FF;color: white;">Ok</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

</section>

<script src="{{asset('/build/js/intlTelInput.js')}}"></script>


<script>

    function initialize() {

        var mapOptions, map, marker, searchBox
        infoWindow = '',
            addressEl = document.querySelector( '#map-search' ),
            latEl = document.querySelector( '.latitude' ),
            longEl = document.querySelector( '.longitude' ),
            element = document.getElementById( 'map-canvas' );
        // city = document.querySelector( '.reg-input-city' );

        var initial_lat = $('.latitude').val();
        var initial_long = $('.longitude').val();

        mapOptions = {
            // How far the maps zooms in.
            zoom: 13,
            // Current Lat and Long position of the pin/
            // center: new google.maps.LatLng( 33.706966, -117.0844733 ),
            center: new google.maps.LatLng(initial_lat, initial_long),
            // center : {
            // 	lat: -34.397,
            // 	lng: 150.644
            // },
            disableDefaultUI: false, // Disables the controls like zoom control on the map if set to true
            scrollWheel: true, // If set to false disables the scrolling on the map.
            draggable: true, // If set to false , you cannot move the map around.
            // mapTypeId: google.maps.MapTypeId.HYBRID, // If set to HYBRID its between sat and ROADMAP, Can be set to SATELLITE as well.
            // maxZoom: 11, // Wont allow you to zoom more than this
            // minZoom: 9  // Wont allow you to go more up.

        };

        /**
         * Creates the map using google function google.maps.Map() by passing the id of canvas and
         * mapOptions object that we just created above as its parameters.
         *
         */
        // Create an object map with the constructor function Map()
        map = new google.maps.Map( element, mapOptions ); // Till this like of code it loads up the map.

        /**
         * Creates the marker on the map
         *
         */
        marker = new google.maps.Marker({
            position: mapOptions.center,
            map: map,
            // icon: 'http://pngimages.net/sites/default/files/google-maps-png-image-70164.png',
            draggable: true
        });

        /**
         * Creates a search box
         */
        searchBox = new google.maps.places.SearchBox( addressEl );


        /**
         * When the place is changed on search box, it takes the marker to the searched location.
         */
        google.maps.event.addListener( searchBox, 'places_changed', function () {
            var places = searchBox.getPlaces(),
                bounds = new google.maps.LatLngBounds(),
                i, place, lat, long, resultArray,
                addresss = places[0].formatted_address;
            console.log(places);
            console.log(addresss);

            for( i = 0; place = places[i]; i++ ) {
                bounds.extend( place.geometry.location );
                marker.setPosition( place.geometry.location );  // Set marker position new.
            }

            map.fitBounds( bounds );  // Fit to the bound
            map.setZoom( 15 ); // This function sets the zoom to 15, meaning zooms to level 15.
            // console.log( map.getZoom() );

            lat = marker.getPosition().lat();
            long = marker.getPosition().lng();
            latEl.value = lat;
            longEl.value = long;

            resultArray =  places[0].address_components;
            // Closes the previous info window if it already exists
            if ( infoWindow ) {
                infoWindow.close();
            }
            /**
             * Creates the info Window at the top of the marker
             */
            infoWindow = new google.maps.InfoWindow({
                content: addresss
            });

            infoWindow.open( map, marker );
        } );


        /**
         * Finds the new position of the marker when the marker is dragged.
         */
        google.maps.event.addListener( marker, "dragend", function ( event ) {
            var lat, long, address, resultArray, citi;

            console.log( 'i am dragged' );
            lat = marker.getPosition().lat();
            long = marker.getPosition().lng();

            var geocoder = new google.maps.Geocoder();
            geocoder.geocode( { latLng: marker.getPosition() }, function ( result, status ) {
                if ( 'OK' === status ) {  // This line can also be written like if ( status == google.maps.GeocoderStatus.OK ) {
                    address = result[0].formatted_address;
                    resultArray =  result[0].address_components;
                    addressEl.value = address;
                    latEl.value = lat;
                    longEl.value = long;

                } else {
                    console.log( 'Geocode was not successful for the following reason: ' + status );
                }

                // Closes the previous info window if it already exists
                if ( infoWindow ) {
                    infoWindow.close();
                }

                /**
                 * Creates the info Window at the top of the marker
                 */
                infoWindow = new google.maps.InfoWindow({
                    content: address
                });

                infoWindow.open( map, marker );
            } );
        });


    }

    $(document).ready(function() {
        initialize();
        $('#set_org_id').val(null);
        $(".table").DataTable({
            "ordering": false
        });
        $('#spnPhoneStatus').html(null);
        $('#spnPhoneStatus2').html(null);
    });



    $(document).on("keyup",".phone",function() {
        var mobile_number = $(this).val();
        if(mobile_number.length >= 7 && mobile_number.length <=11 ){


            if(isNaN(mobile_number)){

                $('#spnPhoneStatus').html('<i class="far fa-window-close"></i>');
                $('#spnPhoneStatus').css('color', 'red');

            }else{
                $('#spnPhoneStatus').html('<i class="fas fa-check-square"></i>');
                $('#spnPhoneStatus').css('color', 'green');
                $('#spnPhoneStatus2').html(null);
            }

        }else{
            $('#spnPhoneStatus').html('<i class="far fa-window-close"></i>');
            $('#spnPhoneStatus').css('color', 'red');
        }
    });

    $(document).on("keyup","#edit_contact",function() {
        var mobile_number = $(this).val();
        if(mobile_number.length >= 7 && mobile_number.length <=11 ){


            if(isNaN(mobile_number)){

                $('#spnPhoneStatus_1').html('<i class="far fa-window-close"></i>');
                $('#spnPhoneStatus_1').css('color', 'red');

            }else{
                $('#spnPhoneStatus3').html(null);
                $('#spnPhoneStatus_1').html('<i class="fas fa-check-square"></i>');
                $('#spnPhoneStatus_1').css('color', 'green');
                $('#spnPhoneStatus3').html(null);
            }

        }else{
            $('#spnPhoneStatus_1').html('<i class="far fa-window-close"></i>');
            $('#spnPhoneStatus_1').css('color', 'red');
        }
    });


    // $(document).on("click",".fa-edit",function() {
    //     $('#form_result12').html(null);
    //     var org_id = $(this).attr("id");
    //     $.ajax({
    //         url: "edit/organization/"+org_id,
    //         success: function(res){
    //             $('#edit_org_id').val(res.data.id);
    //             $('#edit_org_name').val(res.data.name);
    //             $('#edit_contact').val(res.data.contact);
    //             $('#edit_address').val(res.data.address);
    //             $('.org_edit_modal').modal('show');
    //         }
    //     });
    // });

    function check_number_for_update(){
        var mobile_number = $('.phone2').val();
        if(mobile_number.length >= 7 && mobile_number.length <=11 ){


            if(isNaN(mobile_number)){

                $('#spnPhoneStatus3').html('<p>invalid contact number</p>');
                $('#spnPhoneStatus3').css('color', 'red');
                $('.processing2').css('display', 'none');
                $('.btn-update').prop('disabled', false);
                return false;

            }else{
                $('#spnPhoneStatus3').html(null);
                return true;
            }

        }else{
            $('#spnPhoneStatus3').html('<p>Contact length should between 7 and 11</p>');
            $('#spnPhoneStatus3').css('color', 'red');
            $('.processing2').css('display', 'none');
            $('.btn-update').prop('disabled', false);
            return false;
        }
    }

    // this is the id of the form
    $("#update_org_form").submit(function(e) {

        // var boolea2 = check_number_for_update();
        //
        // if(boolea2){

        e.preventDefault(); // avoid to execute the actual submit of the form.
        $('.processing_modal').modal('show');
        var form = $(this);
        var actionUrl = form.attr('action');

        $.ajax({
            type: "POST",
            url: "https://procuriot.ioptime.com/update/organization",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                $('.processing_modal').modal('hide');
                window.location.reload();
                // $('#form_result12').html(data.response);
                //
                // setTimeout(function(){
                //     window.location.reload(1);
                // }, 2000);
            }
        });
        //   }
        // else{
        //     return false;
        //   }

    });


    // $(document).on("click",".fa-trash",function() {
    //
    //     $('.confirmation_dialog').modal('show');
    //
    //     var org_id = $(this).attr("id");
    //
    //     if (confirm("Are you sure to delete this organization ?")) {
    //         $.ajax({
    //             headers:
    //                 { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    //             type: "POST",
    //             url: "https://procuriot.ioptime.com/delete/organization/"+org_id,
    //             success: function(data)
    //             {
    //                $('.response_modal2').modal('show');
    //                 window.location.reload();
    //             }
    //         });
    //     }
    //     return false;
    //
    // });

    $(document).on("click",".fa-trash",function() {

        $('#set_org_id').val(null);

        var org_id = $(this).attr("id");

        $('#set_org_id').val(org_id);

        $('.confirmation_modal').modal('show');

    });

    $(document).on("click",".custom-confirmation",function() {
        var get_orgn_id = $('#set_org_id').val();
        if(get_orgn_id!=null){
            $.ajax({
                headers:
                    { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                type: "POST",
                url: "https://procuriot.ioptime.com/delete/organization/"+get_orgn_id,
                success: function(data)
                {
                    // $('.response_modal2').modal('show');
                    window.location.reload();
                }
            });
        }else{
            alert('something went wrong');
        }
    });



    $(document).on("click","#fa-plus",function() {
        $('.add_org_modal').modal('show');
    });

    function check_number(){
        var mobile_number = $('.phone').val();
        if(mobile_number.length >= 7 && mobile_number.length <=11 ){


            if(isNaN(mobile_number)){

                $('#spnPhoneStatus2').html('<p>invalid contact number</p>');
                $('#spnPhoneStatus2').css('color', 'red');
                return false;

            }else{
                return true;
            }

        }else{
            $('#spnPhoneStatus2').html('<p>Contact length should between 7 and 11</p>');
            $('#spnPhoneStatus2').css('color', 'red');
            return false;
        }
    }

    $("#add_org_form").submit(function(e) {

        // var get_boolean_vaue = check_number();
        //
        // if(get_boolean_vaue){
        e.preventDefault();
        $('.processing_modal').modal('show');

        var form = $(this);

        $.ajax({
            type: "POST",
            url: "https://procuriot.ioptime.com/add/organization",
            data: form.serialize(), // serializes the form's elements.
            success: function(data)
            {
                // $('#form_result13').html(data.success);
                //
                // setTimeout(function(){
                //     window.location.reload(1);
                // }, 2000);

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
                    $('.processing_modal').modal('hide');
                    window.location.reload();
                }
                // $('#form_result13').html(html);
            }
        });
        // } else {
        //     return false;
        // }


    });

</script>

@include('components.footer')

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&libraries=places"></script>
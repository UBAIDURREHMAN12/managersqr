<!DOCTYPE html>
<html>

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


<!-- #Top Bar -->

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

    $( document ).ready(function() {
        $('.alert-info').css('display', 'none');
        initialize();
    });
</script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&libraries=places"></script>
<section>

</section>


<section class="content">
    <div class="container-fluid">
        <!-- No Header Card -->

        <div class="alert alert-info">
            <span style="color: blue;" id="response_results"></span>
        </div>

        <div class="row">
            <label style="margin-left: 2%;">Address</label>
            <div class="col-md-12">
                <input id="map-search"  style="border: 2px solid lightblue;" type="text" class="form-control " name="address" placeholder="Street , city, state" value="" required autocomplete="address">

            </div>
        </div>
        <div class="row" style="margin-top: 1%;">
            <div class="col-md-12">

                <div style='height: 300px;
    position: relative;
    overflow: hidden;
    width: 100%;' id="map-canvas"></div>

            </div>
        </div>

        <div class="form-group row">
            <div class="col-md-6">
                <input id="email" type="text" class="form-control latitude " name="latitude" value="33.5651" required autocomplete="latitude">
            </div>
            <div class="col-md-6">
                <input id="email" type="text" class="form-control longitude " name="longitude" value="73.0169" value="" required autocomplete="longitude">

            </div>
        </div>


        <div class="row" style="margin-top: 2%;">
            <div class="col-md-12">
                <button onclick="update_contact_info();" class="btn btn-md btn-info">Update</button>
            </div>
        </div>

    </div>
</section>


<script>
    function  update_contact_info(){

        var get_latitude = $('.latitude').val();
        var get_longitude = $('.longitude').val();
        var get_mail = $('.getmail').val();
        var address = $('#map-search').val();
        var phone = $('.getphone').val();

        $.ajax({
            url: "http://managershq.com.au/update/contactus/"+get_latitude+"/"+get_longitude+"/"+get_mail+"/"+address+"/"+phone,
            success: function(data){
                $('.alert-info').css('display', 'block');
                $("#response_results").append(data.response);
            }
        });

    }
</script>

{{--@include('admin.layouts.footer')--}}
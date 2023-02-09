@include('components.head')


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&libraries=places"></script>

<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

<style>
    #geomap{
        width: 100%;
        height: 400px;
    }

    .fa-trash:hover {
        color: #6860FF !important;
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
</section>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12" style="text-align: left;">
                <h4 style="font-weight: bold;font-size: 18px;">Venues List</h4>
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
                                    <th scope="col">Venue Name</th>
                                    <th scope="col">Venue Description</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($venues as $venue)
                                    <tr>
                                        <td> {{$venue->name}} </td>
                                        <td> {{$venue->description}} </td>
                                        <td>
                                            <a href="{{url('https://procuriot.ioptime.com/edit/venue2/'.$venue->id)}}" style="font-size: 20px;color: darkgray !important;"> <i class="fa fa-edit"></i> </a>
                                            <i class="btn_delete_venue fa fa-trash" id="{{$venue->id}}" style="font-size: 20px;color: darkgray;"></i>

                                            {{--                        <i class="fa fa-edit edit_venue_latest" id="{{$venue->id}}">  </i>--}}

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

        <div class="modal modal_1" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

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

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">

                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="modal" id="instructionModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Dashboard usage guideline</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <ul>
                        <li>
                            Create venue
                            <ul>
                                <li>
                                    Enter venue name
                                </li><li>
                                    Enter venue description
                                </li>
                                <li>
                                    Enter location name and press locate button
                                </li>
                                <li>
                                    Press add button
                                </li>
                            </ul>
                        </li>
                        <li>
                            Create Gateway

                            <ul>
                                <li>
                                    Click on gateway option from left sidebar
                                </li><li>
                                    Click on + button from top right of page
                                </li>
                                <li>
                                    Enter device title , mac address, and select location and press add button
                                </li>
                                <li>
                                    Press add button
                                </li>
                            </ul>

                        </li>
                        <li>
                            Create beacon
                            <ul>
                                <li>
                                    click on gateway option from left sidebar
                                </li>
                                <li>
                                    click on Add beacon button under action heading
                                </li>
                                <li>
                                    on next page click on + button
                                </li>
                                <li>
                                    Enter mac address, Product Title, Tag line, Description
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal venue_edit_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Venue</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="update_menue_form">

                        <input type="hidden" name="edit_venue_id" id="edit_venue_id">
                        <span id="form_result1"></span>

                        @csrf
                        <div class="row clearfix">
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <div class="form-group form-float">
                                    <label class="form-label">Venue Name</label>
                                    <div class="form-line">
                                        <input type="text" name="name"  maxlength="100" class="form-control edit_venue_name" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                <div class="form-group form-float">
                                    <label class="form-label">Venue Description</label>
                                    <div class="form-line">
                                        <input type="text" name="description" class="form-control edit_venue_description" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg2 col-md2 col-sm2 col-xs-2 ub">
                                <input type="checkbox" id="remember_me_5" class="filled-in">
                                <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect">Update</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
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
                    <p>Are you sure to delete this Venue ?</p>
                    <input type="hidden" id="set_org_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" style="color: white;" class="btn custom-confirmation">Ok</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

</section>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&libraries=places"></script>

var geocoder;
<script>
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

        var latlng = new google.maps.LatLng(initialLat, initialLong);
        var options = {
            zoom: 16,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        map = new google.maps.Map(document.getElementById("geomap"), options);

        geocoder = new google.maps.Geocoder();

        marker = new google.maps.Marker({
            map: map,
            draggable: true,
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
        $('#set_org_id').val(null);
        $(".table").DataTable({
            "ordering": false
        });
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

    $('#update_menue_form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "https://procuriot.ioptime.com/update/venue",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                if(data.response){
                    alert(data.response);
                    window.location.reload();
                }

            }
        })
    });



    $(document).on("click",".btn_edit_venue",function() {

        var venue_id = $(this).attr("id");

        $.ajax({
            url: "https://procuriot.ioptime.com/edit/venue/"+venue_id,
            method: "get",
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {

                if(data.data)
                {
                    $('#edit_venue_id').val(data.data.id);
                    $('.edit_venue_name').val(data.data.name);
                    $('.edit_venue_description').val(data.data.description);
                    $(".venue_edit_modal").modal('show');
                }

            }
        });

    });

    // $(document).on("click",".btn_delete_venue",function() {
    //
    //     var venueId = $(this).attr("id");
    //
    //     deleteItem(venueId);
    //
    //     function deleteItem(venueId2) {
    //         if (confirm("Are you sure to delete this venue?")) {
    //
    //
    //             $.ajax({
    //                 url: "https://procuriot.ioptime.com/delete/venue/"+venueId2,
    //                 method: "get",
    //                 contentType: false,
    //                 cache: false,
    //                 processData: false,
    //                 dataType: "json",
    //                 success: function (data) {
    //
    //                     if(data.response)
    //                     {
    //                         alert(data.response);
    //                         window.location.reload();
    //                     }
    //
    //                 }
    //             });
    //         }
    //         return false;
    //     }
    //
    // });

    $(document).on("click",".btn_delete_venue",function() {

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
                method: "get",
                url: "https://procuriot.ioptime.com/delete/venue/"+get_orgn_id,
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

    $(document).on("click",".edit_venue_latest",function() {

        var venueId = $(this).attr("id");

                $.ajax({
                    url: "https://procuriot.ioptime.com/edit/venue2/"+venueId,
                    method: "get",
                    contentType: false,
                    cache: false,
                    processData: false,
                    dataType: "json",
                    success: function (data) {

                        if(data.response)
                        {
                            alert(data.response);
                            window.location.reload();
                        }

                    }
                });


    });

</script>

@include('components.footer')

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
    }
});
function changeStatus(id,status) {


    // $("#active"+id).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
    // $("#deactive"+id).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");

    $("#active"+id).prop('disabled', true);
    $("#deactive"+id).prop('disabled', true);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    jQuery.ajax({
        url: '/users/changeStatus',
        method: 'post',
        data: {
            id: id,
            status: status,

        },


        success: function(result){
            if(result.status==200) {
                $(function () {
                    Swal.fire(

                        result.success,
                        'success'
                    )
                });
                if (status == 1) {
                    $("#active" + id).hide();
                    $("#action" + id).html('<button id="active' + id + '" onclick="changeStatus(' + id + ',0)" data-toggle="tooltip" data-placement="top" title="Deactivate User" class="btn btn-link btn-danger btn-just-icon" ><i class="material-icons">lock</i> </button>');
                } else {
                    $("#deactive" + id).hide();
                    $("#action" + id).html('<button id="active' + id + '" onclick="changeStatus(' + id + ',1)" data-toggle="tooltip" data-placement="top" title="Activate User" class="btn btn-link btn-success btn-just-icon edit" ><i class="material-icons">lock_open</i></button>');
                }
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                })
                if (status == 1) {
                    $("#action" + id).html('<button id="active' + id + '" onclick="changeStatus(' + id + ',1)" class="btn btn-success" style="width: 8rem;"><i class="fa fa-lock-open"></i> Activate</button>');

                } else {
                    $("#action" + id).html('<button id="active' + id + '" onclick="changeStatus(' + id + ',0)" class="btn btn-danger" style="width: 8rem;"><i class="fa fa-lock"></i> Deactivate</button>');

                }
            }
        }});

}


function addVendor() {


    // $("#add-vendor-button").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
    $("#add-vendor-button").prop('disabled',true);


    jQuery.ajax({
        url: '/vendors/create',
        method: 'post',
        data: $('#create-vendor-form').serializeArray(),

        success: function(result){

            if(result.status==200){



                $("#add-vendor-button").html("<i class='fa fa-plus'></i> Add");
                $("#add-vendor-button").prop('disabled',false);
                $('#vendorcreatemodal').modal('hide');

                Swal.fire(

                    result.message,
                    'success'
                )

                location.reload();

            }else if(result.status==400){
                $("#add-vendor-button").html("Add");
                $("#add-vendor-button").prop('disabled',false);

                let errors=[];
                if(result.message.name){
                    errors.push(result.message.name)
                }
                if(result.message.email){
                    errors.push(result.message.email)
                }
                if(result.message.category){
                    errors.push(result.message.category)
                }
                if(result.message.address){
                    errors.push(result.message.address)
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Validation errors',
                    text:  errors,
                })

            }else{
                $("#add-vendor-button").html("<i class='fa fa-plus'></i> Add");
                $("#add-vendor-button").prop('disabled',false);

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                })

            }
        }});
}

$(document).ready(function(){

    // Delete
    $('.user_delete').click(function(){


        var el = this;
        var id = this.id;
        var splitid = id.split("_");
        $("del_"+splitid[1]).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
        $("del_"+splitid[1]).prop('disabled',true);

        // Delete id
        var deleteid = splitid[1];

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: '/users/destroy',
                    type: 'POST',
                    data: { id:deleteid },
                    success: function(response){
                        var table = $('#datatables').DataTable();

                        if(response.status == 200){
                            // Remove row from HTML Table
                            $(el).closest('tr').css('background','#F56530');
                            $(el).closest('tr').fadeOut(800,function(){
                                $(this).remove();
                                table
                                    .row( $(el).closest('tr') )
                                    .remove()
                                    .draw();
                            });
                            Swal.fire(

                                response.message,
                                'success'
                            )
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }

                    }
                });

            }
        })
    });

});
$(document).ready(function(){

    // Delete
    $('.user_delete').click(function(){


        var el = this;
        var id = this.id;
        var splitid = id.split("_");
        $("del_"+splitid[1]).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
        $("del_"+splitid[1]).prop('disabled',true);

        // Delete id
        var deleteid = splitid[1];

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: '/users/destroy',
                    type: 'POST',
                    data: { id:deleteid },
                    success: function(response){
                        var table = $('#datatables').DataTable();

                        if(response.status == 200){
                            // Remove row from HTML Table
                            $(el).closest('tr').css('background','#F56530');
                            $(el).closest('tr').fadeOut(800,function(){
                                $(this).remove();
                                table
                                    .row( $(el).closest('tr') )
                                    .remove()
                                    .draw();
                            });
                            Swal.fire(

                                response.message,
                                'success'
                            )
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }

                    }
                });

            }
        })
    });

});
function deletsubCategory(id){


    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/subCategories/destroy/'+id,
                type: 'POST',
                data: { id:id },
                success: function(response){



                    $('#del'+id).slideUp('slow', function() {$(this).remove();});

                    $.notify({
                        icon: "add_alert",
                        message: 'Subcategory Deleted Successfully !'

                    }, {
                        type: 'success',
                        timer: 1000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });


                }
            });

        }
    })
}

function deletCategory(id){


    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: '/categories/destroy/'+id,
                type: 'POST',
                data: { id:id },
                success: function(response){
                    var table = $('#datatables').DataTable();
                    $('.del'+id).slideUp('slow', function() {$(this).remove();});


                    $.notify({
                        icon: "add_alert",
                        message: 'Category Deleted Successfully !'

                    }, {
                        type: 'success',
                        timer: 1000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });


                }
            });

        }
    })
}


$(document).ready(function(){

    // Delete
    $('.delete_category').click(function(){
        var el = this;
        var id = this.id;
        var splitid = id.split("_");
        $("del_"+splitid[1]).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
        $("del_"+splitid[1]).prop('disabled',true);

        // Delete id
        var deleteid = splitid[1];

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/categories/destroy',
                    type: 'POST',
                    data: { id:deleteid },
                    success: function(response){
                        var table = $('#datatables').DataTable();

                        if(response.status == 200){
                            // Remove row from HTML Table
                            $(el).closest('tr').css('background','#F56530');
                            $(el).closest('tr').fadeOut(800,function(){
                                $(this).remove();
                                table
                                    .row( $(el).closest('tr') )
                                    .remove()
                                    .draw();
                            });
                            Swal.fire(

                                response.message,
                                'success'
                            )
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }

                    }
                });

            }
        })
    });

});
function editVendor(id) {
    // $("#edit"+id).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
    $("#edit"+id).prop('disabled',true);

    $.ajax({
        url: '/vendors/edit',
        type: 'POST',
        data: { id:id },
        success: function(response){

            if(response.status==200){
                $("#edit"+id).html("<i class='fa fa-pen'></i> edit");
                $("#edit"+id).prop('disabled',false);
                $('#vendoreditemodal').modal('show');
                $('#recipient-name').val(response.data.name);
                $('#recipient-email').val(response.data.email);
                $('#recipient-address').val(response.data.address);
                $('#recipient-category').val(response.data.category);
                $('#recipient-id').val(response.data.id);
            }else{
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                })
            }


        }
    });
}


function updateVendor() {
    // $("#edit-vendor-button").html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
    $("#edit-vendor-button").prop('disabled',true);
    jQuery.ajax({
        url: '/vendors/update',
        method: 'post',
        data: $('#edit-vendor-form').serializeArray(),

        success: function(result){

            if(result.status==200){

                $("#edit-vendor-button").html("Update");
                $("#edit-vendor-button").prop('disabled',false);
                $('#vendoreditmodal').modal('hide');

                Swal.fire(

                    result.message,
                    'success'
                )

                location.reload();

            }else if(result.status==400){
                $("#edit-vendor-button").html("<i class='fa fa-plus'></i> Add");
                $("#edit-vendor-button").prop('disabled',false);

                let errors=[];
                if(result.message.name){
                    errors.push(result.message.name)
                }
                if(result.message.email){
                    errors.push(result.message.email)
                }
                if(result.message.category){
                    errors.push(result.message.category)
                }
                if(result.message.address){
                    errors.push(result.message.address)
                }
                Swal.fire({
                    icon: 'error',
                    title: 'Validation errors',
                    text:  errors,
                })

            }else{
                $("#edit-vendor-button").html("<i class='fa fa-plus'></i> Add");
                $("#edit-vendor-button").prop('disabled',false);

                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Something went wrong!',
                })

            }
        }});

}


function generatePassword(id) {
    $("#generate_"+id).prop('disabled',true);
    jQuery.ajax({
        url: '/vendors/generatePassword',
        method: 'post',
        data: {id:id},
        success: function(result){
            $("#generate_"+id).prop('disabled',false);
            Swal.fire(

                result.message,
                'success'
            )
        }
    });
}

$(document).ready(function(){

    // Delete
    $('.delete_department').click(function(){
        var el = this;
        var id = this.id;
        var splitid = id.split("_");
        $("del_"+splitid[1]).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
        $("del_"+splitid[1]).prop('disabled',true);

        // Delete id
        var deleteid = splitid[1];

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/departments/destroy',
                    type: 'POST',
                    data: { id:deleteid },
                    success: function(response){
                        var table = $('#datatables').DataTable();
                        if(response.status == 200){
                            // Remove row from HTML Table
                            $(el).closest('tr').css('background','purple');
                            $(el).closest('tr').fadeOut(800,function(){
                                $(this).remove();
                                table
                                    .row( $(el).closest('tr') )
                                    .remove()
                                    .draw();
                            });
                            Swal.fire(

                                response.message,
                                'success'
                            )
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }

                    }
                });

            }
        })
    });

});



function generateDepartmentPassword(id) {
    $("#generate_"+id).prop('disabled',true);
    jQuery.ajax({
        url: '/departments/generatePassword',
        method: 'post',
        data: {id:id},
        success: function(result){
            $("#generate_"+id).prop('disabled',false);
            Swal.fire(

                result.message,
                'success'
            )
        }
    });
}

$(document).ready(function(){

    // Delete
    $('.deleteCategory').click(function(){
        var el = this;
        var id = this.id;
        var splitid = id.split("_");
        $("del_"+splitid[1]).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
        $("del_"+splitid[1]).prop('disabled',true);

        // Delete id
        var deleteid = splitid[1];

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/categories/destroy',
                    type: 'POST',
                    data: { id:deleteid },
                    success: function(response){
                        var table = $('#datatables').DataTable();
                        if(response.status == 200){
                            // Remove row from HTML Table
                            $(el).closest('tr').css('background','#F56530');
                            $(el).closest('tr').fadeOut(800,function(){
                                $(this).remove();
                                table
                                    .row( $(el).closest('tr') )
                                    .remove()
                                    .draw();
                            });
                            Swal.fire(

                                response.message,
                                'success'
                            )
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }

                    }
                });

            }
        })
    });

});

$(document).ready(function(){

    // Delete
    $('.delete_feedback_close').click(function(){
        var el = this;
        var id = this.id;
        var splitid = id.split("_");
        $("del_"+splitid[1]).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
        $("del_"+splitid[1]).prop('disabled',true);

        // Delete id
        var deleteid = splitid[1];


        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/feedbacks/delete',
                    type: 'POST',
                    data: { id:deleteid },
                    success: function(response){
                        var table = $('#datatablesinactive').DataTable();

                        // Remove row from HTML Table
                        $(el).closest('tr').css('background','#F56530');
                        $(el).closest('tr').fadeOut(800,function(){
                            $(this).remove();
                            table
                                .row( $(el).closest('tr') )
                                .remove()
                                .draw();
                        });
                        Swal.fire(

                            response.message,
                            'success'
                        )


                    }
                });

            }
        })
    });

});
$(document).ready(function(){

    // Delete
    $('.delete_feedback_open').click(function(){
        var el = this;
        var id = this.id;
        var splitid = id.split("_");
        $("del_"+splitid[1]).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
        $("del_"+splitid[1]).prop('disabled',true);

        // Delete id
        var deleteid = splitid[1];


        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/feedbacks/delete',
                    type: 'POST',
                    data: { id:deleteid },
                    success: function(response){
                        var table = $('#datatables').DataTable();

                        // Remove row from HTML Table
                        $(el).closest('tr').css('background','#F56530');
                        $(el).closest('tr').fadeOut(800,function(){
                            $(this).remove();
                            table
                                .row( $(el).closest('tr') )
                                .remove()
                                .draw();
                        });
                        Swal.fire(

                            response.message,
                            'success'
                        )


                    }
                });

            }
        })
    });

});

$(document).ready(function(){

    // Delete
    $('.delete').click(function(){
        var el = this;
        var id = this.id;
        var splitid = id.split("_");
        $("del_"+splitid[1]).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
        $("del_"+splitid[1]).prop('disabled',true);

        // Delete id
        var deleteid = splitid[1];

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/vendors/destroy',
                    type: 'POST',
                    data: { id:deleteid },
                    success: function(response){
                        var table = $('#datatables').DataTable();
                        if(response.status == 200){
                            // Remove row from HTML Table
                            $(el).closest('tr').css('background','#F56530');
                            $(el).closest('tr').fadeOut(800,function(){
                                $(this).remove();
                                table
                                    .row( $(el).closest('tr') )
                                    .remove()
                                    .draw();
                            });
                            Swal.fire(

                                response.message,
                                'success'
                            )
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }

                    }
                });

            }
        })
    });

});

function initialize() {

    var mapOptions, map, marker, searchBox
    infoWindow = '',
        addressEl = document.querySelector( '#map-search' ),
        latEl = document.querySelector( '.latitude' ),
        longEl = document.querySelector( '.longitude' ),
        element = document.getElementById( 'map-canvas' );
    // city = document.querySelector( '.reg-input-city' );
    var lat=document.getElementById("lat").value;
    var long=document.getElementById("long").value;

    if (typeof  lat !== 'undefined' && typeof long !== 'undefined') {

        var  latitude=lat;
        var longitude=long;
    }else{
        var  latitude=25.2744;
        var longitude=133.7751;
    }

    mapOptions = {
        // How far the maps zooms in.
        zoom: 13,
        // Current Lat and Long position of the pin/
        center: new google.maps.LatLng(latitude,longitude),
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
            i, place, latitude, longitude, resultArray,
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
        latEl.value = latitude;
        longEl.value = longitude;

        resultArray =  places[0].address_components;

        // Get the city and set the city input value to the one selected
        // for( var i = 0; i < resultArray.length; i++ ) {
        //     if ( resultArray[ i ].types[0] && 'administrative_area_level_2' === resultArray[ i ].types[0] ) {
        //         citi = resultArray[ i ].long_name;
        //         city.value = citi;
        //     }
        // }

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

                // Get the city and set the city input value to the one selected
                // for( var i = 0; i < resultArray.length; i++ ) {
                //     if ( resultArray[ i ].types[0] && 'administrative_area_level_2' === resultArray[ i ].types[0] ) {
                //         citi = resultArray[ i ].long_name;
                //         console.log( citi );
                //         city.value = citi;
                //     }
                // }
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
    initialize();
});
function initializeVendor() {

    var mapOptions, map, marker, searchBox
    infoWindow = '',
        addressEl = document.querySelector( '#map-search-vendor' ),
        latEl = document.querySelector( '.latitude' ),
        longEl = document.querySelector( '.longitude' ),
        element = document.getElementById( 'map-canvas-vendor' );
    // city = document.querySelector( '.reg-input-city' );

    mapOptions = {
        // How far the maps zooms in.
        zoom: 13,
        // Current Lat and Long position of the pin/
        center: new google.maps.LatLng( -37.8136276, 144.9630576 ),
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

        // Get the city and set the city input value to the one selected
        // for( var i = 0; i < resultArray.length; i++ ) {
        //     if ( resultArray[ i ].types[0] && 'administrative_area_level_2' === resultArray[ i ].types[0] ) {
        //         citi = resultArray[ i ].long_name;
        //         city.value = citi;
        //     }
        // }

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

                // Get the city and set the city input value to the one selected
                // for( var i = 0; i < resultArray.length; i++ ) {
                //     if ( resultArray[ i ].types[0] && 'administrative_area_level_2' === resultArray[ i ].types[0] ) {
                //         citi = resultArray[ i ].long_name;
                //         console.log( citi );
                //         city.value = citi;
                //     }
                // }
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
    initializeVendor();
});
$(document).ready(function(){

    // Delete
    $('.delete_property').click(function(){


        var el = this;
        var id = this.id;
        var splitid = id.split("_");
        $("del_"+splitid[1]).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
        $("del_"+splitid[1]).prop('disabled',true);

        // Delete id
        var deleteid = splitid[1];

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/properties/destroy',
                    type: 'POST',
                    data: { id:deleteid },
                    success: function(response){
                        var table = $('#datatables').DataTable();
                        if(response.status == 200){
                            // Remove row from HTML Table
                            $(el).closest('tr').css('background','#F56530');
                            $(el).closest('tr').fadeOut(800,function(){
                                $(this).remove();
                                table
                                    .row( $(el).closest('tr') )
                                    .remove()
                                    .draw();
                            });
                            Swal.fire(

                                response.message,
                                'success'
                            )
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }

                    }
                });

            }
        })
    });

});

function generatePasswordStaff(id) {
    $("#generate_"+id).prop('disabled',true);
    jQuery.ajax({
        url: '/users/generatePasswordStaff',
        method: 'post',
        data: {id:id},
        success: function(result){
            $("#generate_"+id).prop('disabled',false);
            Swal.fire(

                result.message,
                'success'
            )
        }
    });
}

function getPropertyRoles(id) {
    $(".role-buttons").addClass("btn-default");
    $(".role-buttons").removeClass("btn-primary");
    $(".role-buttons").removeClass("active");
    $('[type=checkbox]').prop('checked', false);

    let property_id=$('#property').val();
    jQuery.ajax({
        url: '/users/getUserPropertiesRoles',
        method: 'post',
        data: {id:id,property_id:property_id},
        success: function(result){
            var d=result.data;

            if(d.length>0){
                var options=[];
                $.each( result.data, function( key, value ) {

                    $("#role" + value.role_id).removeClass("btn-default");
                    $("#role" + value.role_id).addClass("btn-primary active");
                    $("#roleCheckbox" + value.role_id).prop('checked', true);


                });
            }else{
                $(".role-buttons").addClass("btn-default");
                $(".role-buttons").removeClass("btn-primary");
                $(".role-buttons").removeClass("active");
                $('[type=checkbox]').prop('checked', false);

            }




        }
    });
}

$(document).ready(function(){

    // Delete
    $('.bid_delete').click(function(){
        var el = this;
        var id = this.id;
        var splitid = id.split("_");
        $("del_"+splitid[1]).html("<span class='spinner-border spinner-border-sm' role='status' aria-hidden='true'></span><span class='sr-only'>Loading...</span>");
        $("del_"+splitid[1]).prop('disabled',true);

        // Delete id
        var deleteid = splitid[1];


        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                location.href = '/vendor/deleteBid/'+deleteid;

            }
        })
    });

});



function fetchVendors() {

    let trade=$('#trades').val();
    let report_id=$('#report_id').val();


    jQuery.ajax({
        url: '/fetchVendors',
        method: 'post',
        data: {trade:trade,report_id:report_id},
        success: function(result){
            $('#showVendorsdiv').show();
            // $('#select2-options').prop("disabled", false);
            // $('#select2-options2').prop("disabled", false);

            $('#select2-optionss').html(result.company)
            $('#select2-options2s').html(result.suggested)

        }
    });
}
$(function () {

    $('[data-toggle="buttons"] .btn').on('click', function () {
        // toggle style
        $(this).toggleClass('btn-default btn-primary active');

        // toggle checkbox
        var $chk = $(this).find('[type=checkbox]');
        $chk.prop('checked',!$chk.prop('checked'));

        return false;
    });


});
$(document).ready(function(){

    // Delete
    $('.remove_assign_vendor').click(function(){
        var el = this;
        var id = this.id;
        var splitid = id.split("_");
        $("#delvendor"+splitid[1]).prop('disabled',true);

        // Delete id
        var deleteid = splitid[1];
        var report_id=$('#report_id').val();

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: '/removeAssignedVendor',
                    type: 'POST',
                    data: { id:deleteid,report_id:report_id},
                    success: function(response){
                        var table = $('#datatables').DataTable();
                        if(response.status == 200){
                            // Remove row from HTML Table
                            $(el).closest('tr').css('background','#F56530');
                            $(el).closest('tr').fadeOut(800,function(){
                                $(this).remove();
                                table
                                    .row( $(el).closest('tr') )
                                    .remove()
                                    .draw();
                            });
                            Swal.fire(

                                response.message,
                                'success'
                            )
                        }else{
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Something went wrong!',
                            })
                        }

                    }
                });

            }
        })
    });





});
$(document).ready(function() {
    $('input[type=radio][name=by-laws]').change(function() {
        if (this.value == 'By-Law Reminder') {

            $('#by-law-reminder').show()
            $('#by-law-reminder-warning').hide()

        }
        else if (this.value == 'By-Law Final Warning / Breach') {
            $('#by-law-reminder').hide()
            $('#by-law-reminder-warning').show()
        }
    });
});


function getRooms() {
    var floors=$('#floors').val();
    var field='';
    var des = $('#setName').text();
    var floors=$('#floors').val();

    $('#roomsFeilds').empty();
    if(floors.length<=3){

        for(var i=1 ; i<=floors ;i++ ){
            field=' <div class="row">\n' +
                '                            <label class="col-sm-2 col-form-label">'+des.slice(0, -1).replace('Enter no of','')+' '+i+' has rooms </label>\n' +
                '                            <div class="col-sm-7">\n' +
                '                                <div class="form-group bmd-form-group is-filled has-label">\n' +
                '                                    <input class="form-control"   name="rooms[]" placeholder=""  type="number"   >\n' +

                '                                </div>\n' +
                '                            </div>\n' +
                '                        </div>';


            $('#roomsFeilds').append(field)

        }
    }

}

function getPropertyRooms() {
    var floors=$('#propertyFloor').val();
    var field='';
    $('#roomsFeilds').empty();
    for(var i=1 ; i<=floors ;i++ ){
        field=' <div class="row">\n' +
            '                            <label class="col-sm-2 col-form-label">Floors '+i+' has rooms  </label>\n' +
            '                            <div class="col-sm-7">\n' +
            '                                <div class="form-group bmd-form-group is-filled has-label">\n' +
            '                                    <input class="form-control"   name="rooms[]" placeholder=""  type="number"   >\n' +

            '                                </div>\n' +
            '                            </div>\n' +
            '                        </div>';


        $('#roomsFeilds').append(field)

    }
}


function getEditRooms(id){
    var floors=$('#floors').val();
    $('#roomsFeilds').empty();
    var field='';

    if(floors.length<=3){

        jQuery.ajax({
            url: '/getEditRooms',
            method: 'post',
            data: {id:id},
            success: function(result){


                var rooms=result.rooms;
                var j=0;
                for(var i=1 ; i<=floors ;i++ ){

                    console.log(floors);


                    var roomNo='';
                    var roomId='';
                    if (rooms[j] != undefined) {
                        roomNo=rooms[j].rooms;
                        roomId=rooms[j].id;
                    }



                    field = ' <div class="row">\n' +
                        '                            <label class="col-sm-2 col-form-label">Floors ' + i + ' has rooms  </label>\n' +
                        '                            <div class="col-sm-7">\n' +
                        '                                <div class="form-group bmd-form-group is-filled has-label">\n' +
                        '                                    <input class="form-control"  value="'+roomNo+'"  name="rooms[]" placeholder=""  type="number"   required="true" aria-required="true" required>\n' +
                        ' <input class="form-control"  name="rooms_id[]"  value="'+roomId+'"   placeholder=""  type="hidden"   required="true" aria-required="true">\n'+

                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                        </div>';


                    $('#roomsFeilds').append(field)

                    j++;

                }
            }
        });

    }
}





function getReports(id,type,role_id) {


    $.ajax({
        url: '/getCompletedReports',
        type: 'POST',
        data: {property_id:id,role_id:role_id},
        success: function(response){
            $('#combine-reports').show();
            $('#headeing'+type).show();
            console.log(response.default_reports[0]);

            var table = $('#'+type+'table').DataTable();
            table
                .clear()
                .draw();
            let data=response.default_reports;
            if(response.combine_reports){
                $('#combine-reports'+type).html(response.combine_reports)

            }else{
                $('#combine-reports'+type).html('<p>No Reports to show !</p>')

            }

            for(var i=0;i<=data.length;i++){

                if(data[i]!=undefined){

                    table.row.add( [
                        data[i].ref_no,
                        data[i].title,
                        data[i].first_name + ' ' + data[i].last_name,
                        data[i].created_at,
                        '<a id="reportsid'+data[i].report_id+'" data-toggle="tooltip" data-placement="top" title="Check Details" class="btn btn-link btn-primary btn-just-icon edit" href="/reports/reportDetail/'+data[i].report_id+'"><i class="material-icons">insights</i><div class="ripple-container"></div></a>'
                    ] ).draw( false );
                }


            }






        }
    });
}


function Unlink(report_id,C_report_id,property_id,id){
    $('#unlink'+report_id).html('    <div style="margin-left: 20px" class="loadingio-spinner-spinner-uos71x3akqp"><div class="ldio-uf4jzeuvgrb">\n' +
        '                                                                                    <div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>\n' +
        '                                                                                                                                                                                                                    </div></div>');
    $.ajax({
        url: '/unLinkReport',
        type: 'POST',
        data: {report_id:report_id,C_report_id:C_report_id,property_id:property_id,role_id:id},
        success: function(response){


            $('#unlink'+report_id).closest("tr").remove();


            //

            var table = $('#projectImprovementsdonetable').DataTable();
            if(response.remove==1){
                $('#headeingprojectImprovementsdone').hide()
            }


            table
                .clear()
                .draw();
            let data=response.report;
            let category=response.categories;

            for(var i=0;i<=data.length;i++){



                var text='';
                for(var k=0; k<=category.length;k++){
                    if(data[i]!=undefined && category[k]!=undefined) {
                        if (category[k].report_id == data[i].report_id) {
                            let categoryData = category[k].category;
                            for (var j = 0; j <= categoryData.length; j++) {


                                if (j == 3) {
                                    text += '<span class="badge badge-info">....</span> ';
                                    break
                                } else {

                                    if (categoryData[j] != undefined) {
                                        text += '<span class="badge badge-info">' + categoryData[j].name + '</span> ';

                                    }
                                }

                            }

                        }
                    }


                }
                // if(category[0].report_id==data[i].report_id){
                //
                //     let categoryData=category[0].category;
                //     var text='';
                //     for(var j=0;j<=categoryData.length;j++){
                //
                //
                //         if(j==3){
                //             text+='<span class="badge badge-info">....</span> ';
                //             break
                //         }else{
                //
                //             if(categoryData[j]!=undefined){
                //                 text+='<span class="badge badge-info">'+categoryData[j].name+'</span> ';
                //
                //             }
                //         }
                //
                //     }
                //
                // }




                if(data[i]!=undefined){

                    table.row.add( [
                        data[i].ref_no,
                        data[i].title,
                        text,
                        data[i].first_name + ' ' + data[i].last_name,
                        data[i].created_at,
                        '<a id="reportsid'+data[i].report_id+'" data-toggle="tooltip" data-placement="top" title="Check Details" class="btn btn-link btn-primary btn-just-icon edit" href="/reports/reportDetail/'+data[i].report_id+'"><i class="material-icons">insights</i><div class="ripple-container"></div></a>'
                    ] ).draw( false );

                    text='';
                }


            }

            if(response.remove==1){
                $('#combineTable'+response.combine_id).remove();
                $('#combineHeading'+response.combine_id).remove();
                $('#archivecombineButton'+response.combine_id).remove();
            }
            $(function() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });

                Toast.fire({
                    type: 'success',
                    title: "report Unlinked Successfully!"
                })
            });
        }
    });

}



function showUpdateButton() {


    $('#floorsUpdateButton').show();
}


function deleteReport(id,table) {


    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {

        if (result.isConfirmed) {

            $("#loadMe").modal({
                backdrop: "static", //remove ability to close modal with click
                keyboard: false, //remove option to close with keyboard
                show: true //Display loader!
            });


            $.ajax({
                url: '/reports/deleteReport',
                type: 'POST',
                data: {id:id},
                success: function(response){

                    $("#loadMe").modal('hide');
                    var pendingTable = $('#'+table).DataTable();


                    var count=$('#pendingCount').text();
                    if(count){
                        var newCount=parseInt(count)-1;
                        $('#pendingCount').text(newCount);
                    }



                    $tr = $('#deleteReport'+id).closest('tr');
                    pendingTable.row($tr).remove().draw();
                    // $('#deleteReport'+id).closest('tr').remove();
                    $.notify({
                        icon: "add_alert",
                        message: 'Report deleted successfully'

                    },{
                        type: 'success',
                        timer: 1000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });



                }
            });
        }






    })
}


function AddClass(id){


    if($('#roleCheckbox'+id).is(':checked')){
        $('#role'+id).removeClass('btn-default')
        $('#role'+id).addClass('btn-primary')

    }else{

        $('#role'+id).addClass('btn-default')
        $('#role'+id).removeClass('btn-primary')

    }
}
function AddClassSuggested(id){
    if($('#roleCheckboxSuggested'+id).is(':checked')){
        $('#rolesSuggested'+id).removeClass('btn-default')
        $('#rolesSuggested'+id).addClass('btn-primary')

    }else{

        $('#rolesSuggested'+id).addClass('btn-default')
        $('#rolesSuggested'+id).removeClass('btn-primary')

    }
}


function getCategories(){
    var type=$('#type').val();
    $('#show-accordian').html('<div class="loadingio-spinner-spinner-ep5abeuld3o"><div class="ldio-652z7f9mdql">\n' +
        '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>\n' +
        '</div></div>');


    $.ajax({
        url: '/categories/getCategories',
        type: 'POST',
        data: {type:type},
        success: function(response){
            $('#show-accordian').html(response)

        }
    });
}


function showReport(id,role) {


    $('#reportsDetail').html('<div class="loadingio-spinner-spinner-ep5abeuld3o"><div class="ldio-652z7f9mdql">\n' +
        '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>\n' +
        '</div></div>');



    var $tr = $('#show'+id).closest('tr'); //get tr
    $tr.css({
        "color": "white",
        "background-color": "#F56530",
        'opacity':'0.8'
    });

    $tr.siblings().css( {
        "color": "#3c4858",
        "background-color": "white"
    });



    $.ajax({
        url: '/reports/getReportView',
        type: 'POST',
        data: {id:id,role:role},
        success: function(response){

            $('#reportsDetail').html(response.html);


        }
    });
}


function approveReport(id){
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, approve it!'
    }).then((result) => {
        $("#loadMe").modal({
            backdrop: "static", //remove ability to close modal with click
            keyboard: false, //remove option to close with keyboard
            show: true //Display loader!
        });

        $.ajax({
            url: '/reports/approve',
            type: 'POST',
            data: {id:id},
            success: function(response){

                $("#loadMe").modal('hide');
                var pendingTable = $('#pendingReports').DataTable();
                var approvedTable = $('#approvedReports').DataTable();

                $tr = $('#approve'+id).closest('tr');
                pendingTable.row($tr).remove().draw();
                var category=response.category;
                text='';
                for(var i=0 ;i<=category.length;i++){
                    if(i==3){
                        text+='<span class="badge badge-info">....</span> ';
                        break
                    }else{

                        if(category[i]!=undefined){
                            text+='<span class="badge badge-info">'+category[i].name+'</span> ';

                        }
                    }
                }

                var rowNode=approvedTable.row.add( [
                    response.report.ref_no,
                    response.report.title,
                    text,
                    response.report.first_name+' '+response.report.last_name,
                    '<p class="badge badge-success">0</p>',
                    '<p class="badge badge-info">0</p>',
                    moment(response.report.created_at).format("MM/DD/YYYY"),
                    '<button type="button" id="show'+id+'" data-toggle="modal" data-target="#myModal" onclick="showReport('+id+')" data-placement="top" title="Check Details" class="btn btn-link btn-primary btn-just-icon edit"><i class="material-icons">visibility</i></button><a data-toggle="tooltip" data-placement="top" title="Assign Vendors" class="btn btn-link btn-primary btn-just-icon edit" href="/approvedReports/assignVendors/'+id+'"><i class="material-icons">link</i></a>'


                ] ).draw( false ).node();



                $( rowNode )
                    .css( {
                        "color": "white",
                        "background-color": "#F56530",
                        'opacity':'0.8'
                    })


                setTimeout(function () {
                    $(rowNode).css( {
                        "color": "#333",
                        "background-color": "white",
                        '-webkit-transition': 'background-color 0.4s ease',
                        '-moz-transition': 'background-color 0.4s ease',
                        '-o-transition': 'background-color 0.4s ease',
                        'transition': 'background-color 0.4s ease',

                    });
                }, 2000);

                var count=$('#pendingCount').text();

                var newCount=parseInt(count)-1;
                $('#pendingCount').text(newCount);

                var approvecount=$('#approvedCount').text();

                var newapproveCount=parseInt(approvecount)+1;
                $('#approvedCount').text(newapproveCount);


                $.notify({
                    icon: "add_alert",
                    message: 'Report Approved Successfully<br> <small>This report now moved to approved section</small>  '

                },{
                    type: 'success',
                    timer: 1000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });

            }
        });





    })
}
$(document).ready(function() {
    $('#pendingReports').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],

        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search  Reports",
        },
        "order": [[ 0, "desc" ]],



    });

});
$(document).ready(function() {
    $('#approvedReports').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],

        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search  Reports",
        },
        "order": [[ 0, "desc" ]]
    });

});
$(document).ready(function() {
    $('#simplePending').DataTable({
        "pagingType": "full_numbers",
        "lengthMenu": [
            [10, 25, 50, -1],
            [10, 25, 50, "All"]
        ],

        language: {
            search: "_INPUT_",
            searchPlaceholder: "Search  Reports",
        },
        "order": [[ 0, "desc" ]]
    });

});


function showVendors(id) {

    $('#reportsDetail').html('<div class="loadingio-spinner-spinner-ep5abeuld3o"><div class="ldio-652z7f9mdql">\n' +
        '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>\n' +
        '</div></div>');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
    });
    $.ajax({
        url: '/approvedReports/assignedVendors',
        type: 'POST',
        data: {id:id},
        success: function(response){

            $('#reportsDetail').html(response.html);


        }
    });



}


function deleteAssignVendor(id) {

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {

        if (result.isConfirmed) {


            var report_id=$('#report_id').val();

            $.ajax({
                url: '/removeAssignedVendor',
                type: 'POST',
                data: {id:id,report_id:report_id},
                success: function(response){



                    $('#delvendor_'+id).closest('tr').fadeOut(1000);
                    var count=$('#vendorNumbers'+report_id).text();



                    var newCount=parseInt(count)-1;
                    $('#vendorNumbers'+report_id).text(newCount);
                    $.notify({
                        icon: "add_alert",
                        message: 'Vendor removed from this report'

                    },{
                        type: 'success',
                        timer: 1000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });



                }
            });
        }


    })

}

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

function setProperty() {
    var id=$('#changeProperty').val();
    $.ajax({
        url: '/setProperty',
        type: 'POST',
        data: {id:id},
        success: function(response){
           location.reload();

            $(document).ready(function() {
                $.notify({
                    icon: "add_alert",
                    message: 'Property selected successfully !'

                },{
                    type: 'success',
                    timer: 1000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });
            });



            $( ".table" ).load(window.location.href + " .table" );

            // $('.table-responsive').load('.table-responsive'));

        }
    });

}
function setPropertyMobile() {

    var id=$('#changePropertyMobile').val();
    $.ajax({
        url: '/setProperty',
        type: 'POST',
        data: {id:id},
        success: function(response){

            // location.reload();
            $.notify({
                icon: "add_alert",
                message: 'Property selected successfully !'

            },{
                type: 'success',
                timer: 1000,
                placement: {
                    from: 'top',
                    align: 'right'
                }
            });
        }
    });

}



function getRoomsDetail(id) {


    var floorNO=$('#floor').val();

    $.ajax({
        url: '/getRoomsDetail',
        type: 'POST',
        data: {id:id,floorNO:floorNO},
        success: function(response){

            $("#loadMe").modal('hide');
            $('#showRooms').html(response.roomhtml);

        }
    });
}

function geteditRoomsDetail(id) {


    var floorNO=$('#floorNo').val();

    $.ajax({
        url: '/getRoomsDetail',
        type: 'POST',
        data: {id:id,floorNO:floorNO},
        success: function(response){

            $("#loadMe").modal('hide');
            $('#showRoomsedit').html(response.roomhtml);

        }
    });
}
function showUsers() {
    $('#users').show();
}


function assignRoom() {


    var floor=$('#floor').val();
    var room=$('#room').val();
    var user=$('#staffuser').val();





    if(floor=='' || floor==undefined){

        $.notify({
            icon: "add_alert",
            message: 'Please select floor !'

        },{
            type: 'danger',
            timer: 1000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });

        return;

    }
    if(room=='' || room==undefined){

        $.notify({
            icon: "add_alert",
            message: 'Please select room !'

        },{
            type: 'danger',
            timer: 1000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
        return;

    }
    if(user=='' || user==undefined){

        $.notify({
            icon: "add_alert",
            message: 'Please select staff !'

        },{
            type: 'danger',
            timer: 1000,
            placement: {
                from: 'top',
                align: 'right'
            }
        });
        return;

    }



    var form= $("#create-vendor-form").serializeArray();

    var date=moment(new Date()).format("DD/MM/YYYY");
    var time=moment(new Date()).format("hh:mm A");


    $.ajax({
        url: '/assignRoom',
        type: 'POST',
        data: {form:form,date:date,time:time},
        complete:function(){
            $("#vendorcreatemodal").modal('hide');
        },
        success: function(response){

            if(response.floor==0){
                $.notify({
                    icon: "add_alert",
                    message: 'Room already assigned !'

                },{
                    type: 'danger',
                    timer: 1000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });
            }else{

                var approvecount=$('#incompleteCount').text();

                var newapproveCount=parseInt(approvecount)+1;
                $('#incompleteCount').text(newapproveCount);

                document.getElementById("create-vendor-form").reset();
                $.notify({
                    icon: "add_alert",
                    message: 'Room Assigned Successfully !'

                },{
                    type: 'success',
                    timer: 1000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });

                var t = $('#datatables').DataTable();



                t.row.add( [
                    response.floor,
                    response.room,
                    response.assign_to,
                    response.date,
                    response.time,
                    '                          <button onclick="editRoom('+response.room_id+')" id="edit156" data-toggle="tooltip" data-placement="top" title="Edit Property" class="btn btn-link btn-primary btn-just-icon edit"><i class="material-icons">edit</i></button>\n' +
                    '                                            <button onclick="deleteRoom('+response.room_id+')" id="del_'+response.room_id+'" data-toggle="tooltip" data-placement="top" title="Delete Property" class="btn btn-link btn-danger btn-just-icon"><i class="material-icons ">delete</i></button>'
                ] ).draw( false );


            }








        }
    });
}


function deleteRoom(id) {


    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: '/deleteRoom',
                type: 'POST',
                data: {id:id},
                success: function(response){


                    var approvecount=$('#incompleteCount').text();

                    var newapproveCount=parseInt(approvecount)-1;
                    $('#incompleteCount').text(newapproveCount);

                    var pendingTable = $('#datatables').DataTable();





                    $tr = $('#del_'+id).closest('tr');
                    pendingTable.row($tr).remove().draw();
                    // $('#deleteReport'+id).closest('tr').remove();
                    $.notify({
                        icon: "add_alert",
                        message: 'Room deleted successfully'

                    },{
                        type: 'success',
                        timer: 1000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });



                }
            });
        }






    })
}


function editRoom(id) {
    $('#showForm').html('<div style="    width: 200px;\n' +
        '    height: 175px;\n' +
        '    display: inline-block;\n' +
        '    overflow: hidden;\n' +
        '    background: #ffffff;\n' +
        '    position: relative;\n' +
        '    left: 7rem;" class="loadingio-spinner-spinner-ep5abeuld3o"><div class="ldio-652z7f9mdql">\n' +
        '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>\n' +
        '</div></div>');
    $.ajax({
        url: '/editRoom',
        type: 'POST',
        data: {id:id},

        success: function(response){

            $("#vendoreditemodal").modal('show')

            $('#showForm').html(response);

        }
    });
}


function updateRoom() {

    var floor=$('#floorNo').val();
    var room=$('#room').val();
    var user=$('#staff').val();
    var roomId=$('#roomId').val();
    var floorId=$('#floorId').val();







    if(floor=='' || floor==undefined){



        $('#edit-error').show();
        $('#edit-error').html('<p  class="alert alert-danger">Please select floor !</p>')

        return;

    }
    if(room=='' || room==undefined){



        $('#edit-error').show();
        $('#edit-error').html('<p  class="alert alert-danger">Please select room !</p>')
        return;

    }
    if(user=='' || user==undefined){



        $('#edit-error').show();
        $('#edit-error').html('<p  class="alert alert-danger">Please select staff !</p>')
        return;

    }



    var form= $("#edit-vendor-form").serializeArray();
    var date=moment(new Date()).format("DD/MM/YYYY");
    var time=moment(new Date()).format("hh:mm A");
    var id=0;
    $.each(form, function(i, field){
        if(field.name=='room_id'){
            id=field.value;
            return false;
        }

    });


    $.ajax({
        url: '/updateRoom',
        type: 'POST',
        data: {form:form,date:date,time:time,roomId:roomId,floorId:floorId},

        success: function(response) {

            if (response.floor == 0) {

                $('#edit-error').show();
                $('#edit-error').html('<p  class="alert alert-danger">This Room is already assigned !</p>')


            } else {


                $("#vendoreditemodal").modal('hide')
                var pendingTable = $('#datatables').DataTable();
                $tr = $('#del_' + response.room_id).closest('tr');
                var data = [
                    response.floor,
                    response.room,
                    response.assign_to,
                    response.date,
                    response.time,
                    '                          <button onclick="editRoom('+response.room_id+')" id="edit156" data-toggle="tooltip" data-placement="top" title="Edit Property" class="btn btn-link btn-primary btn-just-icon edit"><i class="material-icons">edit</i></button>\n' +
                    '                                            <button onclick="deleteRoom('+response.room_id+')" id="del_'+response.room_id+'" data-toggle="tooltip" data-placement="top" title="Delete Property" class="btn btn-link btn-danger btn-just-icon"><i class="material-icons ">delete</i></button>'
                ]
                pendingTable.row($tr).data(data).draw();

                $.notify({
                    icon: "add_alert",
                    message: 'Room Updated successfully'

                }, {
                    type: 'success',
                    timer: 1000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });


            }
        }
    });


}


function showFilters(id,section) {
    $("#searchModal").modal('show')
    $('#searchArea').html('<div style="    width: 200px;\n' +
        '    height: 175px;\n' +
        '    display: inline-block;\n' +
        '    overflow: hidden;\n' +
        '    background: #ffffff;\n' +
        '    position: relative;\n' +
        '    left: 7rem;" class="loadingio-spinner-spinner-ep5abeuld3o"><div class="ldio-652z7f9mdql">\n' +
        '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>\n' +
        '</div></div>');


    $.ajax({
        url: '/getFilters',
        type: 'POST',
        data: {id:id,section:section},

        success: function(response){

            $('#searchArea').html(response.html);


        }
    });



}


function searchRecords(type) {




    $('#searchbutton').text('Searching...');
    $('#searchbutton').prop('disabled',true);


    var form = $("#searchForm").serializeArray();



    $.ajax({
        url: '/searchRecords',
        type: 'POST',
        data: {form: form,type:type},

        success: function (response) {
            $('#searchbutton').text('Search');
            $('#searchbutton').prop('disabled',false);

            if(type=='other'){

                var t = $('#datatables').DataTable();


                t
                    .clear()
                    .draw();

                var reports = response.feedbacks;



                for (var i = 0; i <= reports.length; i++) {

                    if (reports[i] != undefined) {
                        var text = '';

                        t.row.add([

                            reports[i].name,
                            reports[i].note,
                            reports[i].area,
                            moment(reports[i].created_at).format("MM/DD/YYYY"),
                            '<div class="dropdown">\n' +
                            '\n' +
                            '                                                                    <!--Trigger-->\n' +
                            '\n' +
                            '                                                                    <a type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>\n' +
                            '\n' +
                            '\n' +
                            '                                                                    <!--Menu-->\n' +
                            '                                                                    <div class="dropdown-menu dropdown-primary">\n' +
                            '                                                                        <a data-toggle="tooltip" data-placement="top" class="dropdown-item" href="/closedFeedback/'+reports[i].order_id+'"><i class="fas fa-close"></i>&nbsp;&nbsp;Close Feedback</a>\n' +
                            '                                                                        <a class="dropdown-item" href="/getFeedback/'+reports[i].order_id+'"><i class="fas fa-eye"></i>&nbsp;View Feedback</a>\n' +
                            '                                                                        <a id="send'+reports[i].order_id+'" onclick="createReport('+reports[i].order_id+')" class="dropdown-item" herf="#"><i class="fas fa-envelope"></i>&nbsp;Send Feedback</a>\n' +
                            '                                                                        <a id="del_'+reports[i].order_id+'" class="dropdown-item delete_feedback_open" href="#"><i class="fas fa-trash"></i>&nbsp;Delete Feedback</a>\n' +
                            '\n' +
                            '                                                                    </div>\n' +
                            '                                                                </div>'

                        ]).draw(false);


                    }
                }

            }else{
                var t = $('#datatables').DataTable();


                t
                    .clear()
                    .draw();

                var reports = response.feedbacks;



                for (var i = 0; i <= reports.length; i++) {

                    if (reports[i] != undefined) {
                        var text = '';

                        t.row.add([
                            reports[i].title,
                            reports[i].name,
                            reports[i].note,
                            reports[i].floor_id+reports[i].room_id,
                            moment(reports[i].created_at).format("MM/DD/YYYY"),
                            ' <a href="/closedFeedback/'+reports[i].order_id+'" data-toggle="tooltip" data-placement="top" title="Close Feedback" class="btn btn-link btn-primary btn-just-icon"><i class="material-icons ">done</i><div class="ripple-container"></div></a><button id="send'+reports[i].order_id+'" data-toggle="tooltip" data-placement="top" onclick="createReport('+reports[i].order_id+')" title="Send Report" class="btn btn-link btn-success  btn-just-icon "><i class="material-icons ">send</i><div class="ripple-container"></div></button>\n' +
                            '                                            <button id="del_'+reports[i].order_id+'" data-toggle="tooltip" data-placement="top" title="Delete Feedback" class="btn btn-link btn-danger btn-just-icon delete"><i class="material-icons ">delete</i></button>\n'

                        ]).draw(false);


                    }
                }

            }




        }
    });


}
function searchRecordsinactive(type) {

    // alert(type);




    $('#searchbuttoninactive').text('Searching...');
    $('#searchbuttoninactive').prop('disabled',true);


    var form = $("#searchForminactive").serializeArray();



    $.ajax({
        url: '/searchRecordsinactive',
        type: 'POST',
        data: {form: form,type:type},

        success: function (response) {
            $('#searchbuttoninactive').text('Search');
            $('#searchbuttoninactive').prop('disabled',false);

            if(type=='area'){

                var t = $('#datatablesinactive').DataTable();


                t
                    .clear()
                    .draw();

                var reports = response.feedbacks;



                for (var i = 0; i <= reports.length; i++) {

                    if (reports[i] != undefined) {
                        var text = '';

                        t.row.add([
                            reports[i].title,
                            reports[i].name,
                            reports[i].note,
                            reports[i].area,
                            moment(reports[i].created_at).format("MM/DD/YYYY"),
                            '<button id="send'+reports[i].order_id+'" data-toggle="tooltip" data-placement="top" onclick="createReport('+reports[i].order_id+')" title="Send Report" class="btn btn-link btn-success  btn-just-icon "><i class="material-icons ">send</i><div class="ripple-container"></div></button>\n' +
                            '                                            <button id="del_'+reports[i].order_id+'" data-toggle="tooltip" data-placement="top" title="Delete Feedback" class="btn btn-link btn-danger btn-just-icon delete"><i class="material-icons ">delete</i></button>\n'

                        ]).draw(false);


                    }
                }

            }else{

                var t = $('#datatablesinactive').DataTable();


                t
                    .clear()
                    .draw();

                var reports = response.feedbacks;



                for (var i = 0; i <= reports.length; i++) {

                    if (reports[i] != undefined) {
                        var text = '';

                        t.row.add([
                            reports[i].title,
                            reports[i].name,
                            reports[i].note,
                            '0'+reports[i].floor_id+'0'+reports[i].room_id,
                            moment(reports[i].created_at).format("MM/DD/YYYY"),
                            '<button id="send'+reports[i].order_id+'" data-toggle="tooltip" data-placement="top" onclick="createReport('+reports[i].order_id+')" title="Send Report" class="btn btn-link btn-success  btn-just-icon "><i class="material-icons ">send</i><div class="ripple-container"></div></button>\n' +
                            '                                            <button id="del_'+reports[i].order_id+'" data-toggle="tooltip" data-placement="top" title="Delete Feedback" class="btn btn-link btn-danger btn-just-icon delete"><i class="material-icons ">delete</i></button>\n'

                        ]).draw(false);


                    }
                }


            }




        }
    });


}



function showTask(action) {

    if(action=='mainTask'){
        $('#mainTask').show()
    }else if(action=='specialTask'){

        if($('#defaultUnchecked1').prop("checked") == true){
            $('#specialTask').show();

        }else{
            $('#specialTask').hide();
        }

    }


}



function showDetails(id) {
    $('#myModal').modal('show');
    $('#reportsDetail').html('<div class="loadingio-spinner-spinner-ep5abeuld3o"><div class="ldio-652z7f9mdql">\n' +
        '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>\n' +
        '</div></div>');



    $.ajax({
        url: '/getTask',
        type: 'POST',
        data: {id:id},
        success: function(response){

            $('#reportsDetail').html(response);
            $(".collapse.show").each(function(){
                $(this).prev(".card-header").find(".fa").addClass("fa-minus").removeClass("fa-plus");
            });

            // Toggle plus minus icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function(){
                $(this).prev(".card-header").find(".fa").removeClass("fa-plus").addClass("fa-minus");
            }).on('hide.bs.collapse', function(){
                $(this).prev(".card-header").find(".fa").removeClass("fa-minus").addClass("fa-plus");
            });


        }
    });



}



function archiveReport(id,table){

    Swal.fire({
        title: 'Do you want to archive this report?',
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText: `Don't save`,
    }).then((result) => {


        if (result.isConfirmed) {

            $.ajax({
                url: '/archiveReport',
                type: 'POST',
                data: {id:id},
                success: function(response){


                    var approvecount=$('.archiveCount').text();

                    var newapproveCount=parseInt(approvecount)+1;
                    $('.archiveCount').text(newapproveCount);
                    if(table=='completed'){
                        var tables = $('#projectImprovementsdonetable').DataTable();


                    }else{
                        var tables= $('#pendingReports').DataTable();

                    }

                    tables
                        .row( $('#archive'+id).parents('tr') )
                        .remove()
                        .draw();


                    $.notify({
                        icon: "add_alert",
                        message: 'Report archived successfully !'

                    },{
                        type: 'success',
                        timer: 1000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });

                }


            });

        }
    })
}



function showArchive(id) {
    $('#myModal').modal('show');
    $('#reportsDetail').html('<div class="loadingio-spinner-spinner-ep5abeuld3o"><div class="ldio-652z7f9mdql">\n' +
        '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>\n' +
        '</div></div>');


    $.ajax({
        url: '/getArchiveReports',
        type: 'POST',
        data: {id:id},
        success: function(response){

            $('#reportsDetail').html(response);



        }
    });
}


function unarchive(id) {
    Swal.fire({
        title: 'Do you want to unarchive this report?',
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText: `Don't save`,
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: '/unarchiveReport',
                type: 'POST',
                data: {id:id},
                success: function(response){
                    var approvecount=$('.archiveCount').text();

                    var newapproveCount=parseInt(approvecount)-1;
                    $('.archiveCount').text(newapproveCount);


                    if(response.report.role_id==1|| response.report.role_id==2 || response.report.role_id==5){
                        var approvedTable = $('#projectImprovementsdonetable').DataTable();
                        var actionrow='<button type="button" id="show'+id+'" data-toggle="modal" data-target="#myModal" onclick="showReport('+id+')" data-placement="top" title="Check Details" class="btn btn-link btn-primary btn-just-icon edit"><i class="material-icons">visibility</i></button><button type="button" id="archive'+id+'" onclick="archiveReport('+id+',\'completed\')" data-toggle="tooltip" data-placement="top" title="Archive Report" class="btn btn-link btn-primary btn-just-icon edit"><i class="material-icons">archive</i></button>';


                    }else{
                        var  approvedTable= $('#pendingReports').DataTable();
                        var actionrow='   <button type="button" id="show'+id+'" data-toggle="modal" data-target="#myModal" onclick="showReport('+id+','+response.report.role_id+')" data-placement="top" title="Check Details" class="btn btn-link btn-primary btn-just-icon edit"><i class="material-icons">visibility</i><div class="ripple-container"></div></button>\n' +
                            '                                                        <button type="button" id="deleteReport'+id+'" onclick="deleteReport('+id+',\'simplePending\')" data-toggle="tooltip" data-placement="top" title="Delete Report" class="btn btn-link btn-danger btn-just-icon edit"><i class="material-icons">delete</i></button>\n' +
                            '                                                        <button type="button" id="archive'+id+'" onclick="archiveReport('+id+',\'pending\')" data-toggle="tooltip" data-placement="top" title="Archive Report" class="btn btn-link btn-primary btn-just-icon edit"><i class="material-icons">archive</i></button>';

                    }

                    $('#unarchivereport'+id).parent('tr').remove();
                    var category=response.category;
                    text='';
                    for(var i=0 ;i<=category.length;i++){
                        if(i==3){
                            text+='<span class="badge badge-info">....</span> ';
                            break
                        }else{

                            if(category[i]!=undefined){
                                text+='<span class="badge badge-info">'+category[i].name+'</span> ';

                            }
                        }
                    }

                    var rowNode=approvedTable.row.add( [
                        response.report.ref_no,
                        response.report.title,
                        text,
                        response.report.first_name+' '+response.report.last_name,
                        moment(response.report.created_at).format("MM/DD/YYYY"),
                        actionrow


                    ] ).draw( false );



                    $.notify({
                        icon: "add_alert",
                        message: 'Report unarchived successfully !'

                    },{
                        type: 'success',
                        timer: 1000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });

                }


            });

        }
    })
}


function archiveCombineReport(id) {
    Swal.fire({
        title: 'Do you want to archive this report?',
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText: `Don't save`,
    }).then((result) => {
        var approvecount=$('.archiveCombineCount').text();

        var newapproveCount=parseInt(approvecount)+1;
        $('.archiveCombineCount').text(newapproveCount);

        if (result.isConfirmed) {

            $.ajax({
                url: '/archiveCombineReport',
                type: 'POST',
                data: {id:id},
                success: function(response){

                    $('#combineHeading'+id).remove();
                    $('#archivecombineButton'+id).remove();
                    $('#combineTable'+id).remove();



                    $.notify({
                        icon: "add_alert",
                        message: 'Combine report archived successfully !'

                    },{
                        type: 'success',
                        timer: 1000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });

                }


            });

        }
    })
}



function showCombineArchive(id) {
    $('#myModal').modal('show');
    $('#reportsDetail').html('<div class="loadingio-spinner-spinner-ep5abeuld3o"><div class="ldio-652z7f9mdql">\n' +
        '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>\n' +
        '</div></div>');


    $.ajax({
        url: '/getCombineArchiveReports',
        type: 'POST',
        data: {id:id},
        success: function(response){

            $('#reportsDetail').html(response);



        }
    });
}


function unarchiveCombineReport(id) {

    Swal.fire({
        title: 'Do you want to unarchive this report?',
        showDenyButton: false,
        showCancelButton: true,
        confirmButtonText: `Yes`,
        denyButtonText: `Don't save`,
    }).then((result) => {

        if (result.isConfirmed) {

            $.ajax({
                url: '/unarchiveCombineReport',
                type: 'POST',
                data: {id:id},
                success: function(response){


                    var approvecount=$('.archiveCombineCount').text();

                    var newapproveCount=parseInt(approvecount)-1;
                    $('.archiveCombineCount').text(newapproveCount);

                    $('#combine-reportsprojectImprovementsdone').prepend(response.combine_reports)
                    $('#unarchivecombinereport'+id).parent('tr').remove();




                    $.notify({
                        icon: "add_alert",
                        message: 'Report unarchived successfully !'

                    },{
                        type: 'success',
                        timer: 1000,
                        placement: {
                            from: 'top',
                            align: 'right'
                        }
                    });

                }


            });

        }
    })


}


function getPropertyRooms() {

    var floorId = $('#propertyFloor').val();

    $.ajax({
        url: '/getRoomsInfo',
        type: 'POST',
        data: {id:floorId},
        success: function(response) {


            $('#roomsInformation').html(response.roomhtml);
        }


    });




}


function createReport(id) {
    $('#myModal').modal('show');

    $('#reportsDetail').html('<div class="loadingio-spinner-spinner-ep5abeuld3o"><div class="ldio-652z7f9mdql">\n' +
        '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>\n' +
        '</div></div>');


    $.ajax({
        url: '/getFeedbackInfo',
        type: 'POST',
        data: {id:id},
        success: function(response) {


            $('#reportsDetail').html(response);
        }


    });


}



function updateFeedback(obj,id) {

    var tr = $(obj).closest('tr');

    var feedback = $(tr).find('td:eq( 0 )').text();
    var password = $(tr).find('td:eq( 1 )').text();

    $.ajax({
        url: '/updateFeedback',
        type: 'POST',
        data: {feedback:feedback,password:password,id:id},

        statusCode: {
            500: function() {
                alert("Something went wrong !");
            }
        },
        success: function(response) {

            if(response.success==1 && response.action=='add'){

                $(obj).attr("onblur","updateFeedback(this,"+response.feedback.id+")");
                $(obj).closest('td').next().find('button').attr("onclick","removeRow(this,"+response.feedback.id+")");


                $.notify({
                    icon: "add_alert",
                    message: 'Feedback added successfully !'

                },{
                    type: 'success',
                    timer: 1000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });
            }else if(response.success==1 && response.action=='update'){
                $.notify({
                    icon: "add_alert",
                    message: 'Feedback updated successfully !'

                },{
                    type: 'success',
                    timer: 1000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });
            }else{

                $.notify({
                    icon: "add_alert",
                    message: 'Feedback is required !'

                },{
                    type: 'danger',
                    timer: 1000,
                    placement: {
                        from: 'top',
                        align: 'right'
                    }
                });

            }


        }

    });




}

function userSelection() {
    var user=$('#user').val();

    $.ajax({
        url: '/getFeedbackType',
        type: 'POST',
        data: {user:user},

        statusCode: {
            500: function() {
                alert("Something went wrong !");
            }
        },
        success: function(response) {

            if(response.result==1){

                $('#key').html('<label for="country">Add key for '+user+'</label>\n' +
                    '                    <input type="text" class="form-control"  name="key" required>\n' +
                    '\n' +
                    '                    <div class="invalid-feedback">\n' +
                    '                        Please Add Key\n' +
                    '                    </div>');

            }else{
                $('#key').html('');

            }
        }

    });


    if(user=='housekeeping'){
        $('#key').html('<label for="country">Add key for housekeeping</label>\n' +
            '                    <input type="text" class="form-control"  name="key" required>\n' +
            '\n' +
            '                    <div class="invalid-feedback">\n' +
            '                        Please Add Key\n' +
            '                    </div>');
    }else{
        $('#key').html('');

    }
}











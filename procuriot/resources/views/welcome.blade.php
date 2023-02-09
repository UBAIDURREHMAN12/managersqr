@include('components.head')

<style>
    .filter-option {
        display: none;
    }
    .bs-caret {
        display: none;
    }
    .caret {
        display: none;
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
</section>

<section class="content">
    <div class="container-fluid">


        <div class="row">
            <div class="col-md-4" style="text-align: right;">

            </div>
            <div class="col-md-4" style="text-align: center;">
                <h5 style="color: #6860FF;">Gateway information</h5>
            </div>

            <div class="col-md-4" style="text-align: right;">
                <a href="https://procuriot.ioptime.com/gateways"> <i class="material-icons" style="color: #6860FF;">arrow_back</i></a>
            </div>
        </div>
        <div class="body table-responsive">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th style="width: 33%;">Gateway Title</th>
                    <th style="width: 33%;text-align: center;">Mac Address</th>
                    <th style="width: 33%;text-align: right;">Action</th>
                </tr>
                </thead>
                <tbody>
                <tr class="active">
                    <td style="width: 33%;">{{ $data->title }}</td>
                    <td style="width: 33%;text-align: center;">{{ $data->mac_address }}</td>
                    <td style="width: 33%;text-align: right;">

                        <i class="fas fa-edit edit_gateway" id="{{$data->id}}" style="color: darkgray;font-size: 20px"></i>
                        <i class="fas fa-trash btn_delete_gateway" id="{{$data->id}}" style="color: darkgray;font-size: 20px"></i>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-md-4" style="text-align: right;">
            </div>
            <div class="col-md-4" style="text-align: center;">
                <h5 style="color: #6860FF;">Beacons</h5>
            </div>

            <div class="col-md-4" style="text-align: right;">
                <button class="btn btn-sm add-beacon" id="ub" style="border-radius: 5%;background-color: #6860FF;color: white;font-size: 14px;">Add Beacon</button>
            </div>
        </div>

        <div class="body table-responsive">
            <table class="table table-condensed beacons_table">
                <thead>
                <tr>
                    <th>Product Title</th>
                    <th>Image</th>
                    <th>Mac Address</th>
                    <th>Tagline</th>
                    <th>Description</th>
                    <th>Distance</th>
                    <th>Action</th>

                </tr>
                </thead>
                <tbody>
                @foreach($beaconsdata as $key=>$value)
                    <tr class="active">
                        <td>{{$value->title}}</td>
                        <td><img src="{{$value->image}}" style="width: 100px;height: 50px;"> </td>
                        <td>{{$value->mac_address}}</td>
                        <td>{{$value->tagline}}</td>
                        <td>{{$value->description}}</td>
                        <td>{{$value->distance}}</td>
                        <td>
                            {{--                            <button class="btn btn-info btn-sm becon_edit_btn" id="{{$value->id}}" style="padding-left: 12%;">Edit</button>--}}

                            <i class="fas fa-edit becon_edit_btn" id="{{$value->id}}" style="color: darkgray;font-size: 20px"></i>

                            {{--                            <button class="btn btn-danger btn-sm btn_delete_beacon" id="{{$value->id}}">delete</button>   </td>--}}

                            <i class="fas fa-trash btn_delete_beacon" id="{{$value->id}}" style="color: darkgray;font-size: 20px"></i>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>

    <div class="modal edit_gateway_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Gateway</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="upate_gateway_form">
                        <span id="form_result3"></span>
                        @csrf
                        <input type="hidden" id="gateway_id" name="gateway_id">
                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="exampleInputEmail1">Gateway Title</label>--}}
                        {{--                            <input type="text" name="edit_gateway_title" style="border: 2px solid blue;" class="form-control" id="edit_gateway_title" aria-describedby="emailHelp">--}}
                        {{--                        </div>--}}
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label for="exampleInputEmail1">Gateway Title</label>
                                <input type="text" name="edit_gateway_title" id="edit_gateway_title" class="form-control"  required>
                            </div>
                        </div>
                        {{--                        <div class="form-group">--}}
                        {{--                            <label for="exampleInputEmail1">Mac Address</label>--}}
                        {{--                            <input type="text" name="edit_gateway_mac_address" style="border: 2px solid blue;" class="form-control" id="edit_gateway_mac_address" aria-describedby="emailHelp">--}}
                        {{--                        </div>--}}
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label for="exampleInputEmail1">Mac Address</label>
                                <input type="text" name="edit_gateway_mac_address" id="edit_gateway_mac_address" class="form-control"  required>
                            </div>
                        </div>
                        <div class="form-group">

                            <label for="title">Venue</label>
                            <select name="edit_gateway_venue_id" id="edit_location" class="form-control" style="border: 1px solid lightgray;width: 102%;">
                                <option value=''>Select venue</option>
                                @foreach ($locations as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
                            </select>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn" style="background-color: #6860FF;color: white;font-size: 14px;">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal edit_beacon_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Update Beacon</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="upate_beacon_form">
                        @csrf
                        <input type="hidden" id="beacon_id" name="beacon_id">

                        <div class="form-group form-float">
                            <div class="form-line">
                                <label for="exampleInputEmail1">Product Title</label>
                                <input type="text" name="edit_beacon_title" class="form-control" id="edit_beacon_title" required>
                            </div>
                        </div>


                        <div class="form-group form-float">
                            <div class="form-line">
                                <label for="exampleInputEmail1">Mac Address</label>
                                <input type="text" name="edit_beacon_mac_address" class="form-control" id="edit_beacon_mac_address" required>
                            </div>
                        </div>


                        <div class="form-group form-float">
                            <div class="form-line">
                                <label for="exampleInputEmail1">Tagline</label>
                                <input type="text" name="edit_beacon_tagline"  class="form-control" id="edit_beacon_tagline" required>
                            </div>
                        </div>


                        <div class="form-group form-float">
                            <div class="form-line">
                                <label for="exampleInputEmail1">Description</label>
                                <input type="text" name="edit_beacon_description"  class="form-control" id="edit_beacon_description" required>
                            </div>
                        </div>


                        <div class="form-group form-float">
                            <div class="form-line">
                                <label for="title">Distance</label>
                                <select name="edit_beacon_distance" class="edit_beacon_distance" style="width: 550px; height: 33px;" required>
                                    @foreach($distances as $distance)
                                        <option value="{{$distance}}">{{$distance}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>


                        <div class="form-group form-float">
                            <div class="form-line">
                                <label for="exampleInputEmail1">Image</label>
                                <input type="file" class="form-control" name="edit_beacon_image"   id="edit_beacon_image">
                            </div>
                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn" style="color: white;font-size: 14px;background-color: #6860FF;">Update</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
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
                    <p>Are you sure to delete this gateway ?</p>
                    <input type="hidden" id="set_org_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn custom-confirmation" style="background-color: #6860FF;color: white;font-size: 14px;">Ok</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal confirmation_modal2" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Delete Confirmation</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you sure to delete this beacon ?</p>
                    <input type="hidden" id="set_org_id2">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn custom-confirmation2" style="background-color: #6860FF;color: white;font-size: 14px;">Ok</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal response_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <p style="text-align: center;color: #6860FF;">Data Updated Successfully</p>
                </div>
            </div>
        </div>
    </div>

</section>

<div class="modal add_beacon_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Beacon</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

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


                <span id="form_result"></span>
                <form id="add_beacon_form">
                    @csrf
                    <input type="hidden" id="hidden_gateway_id" value="{{$data->id}}" name="hidden_gateway_id">
                    {{--                    <div class="form-group">--}}
                    {{--                        <label>Mac Address</label>--}}
                    {{--                        <input type="text" class="form-control" name="mac"  style="border: 1px solid blue;" required>--}}
                    {{--                    </div>--}}

                        <div class="form-group form-float">
                            <div class="form-line">
                                <label>Mac Address</label>
                                <input type="text" class="form-control" name="mac" required>
                            </div>
                        </div>


                    <div class="form-group form-float">
                        <div class="form-line">
                            <label>Product Title</label>
                            <input type="text" class="form-control" name="product_title" placeholder="Enter product title"  required>
                        </div>
                    </div>


                    <div class="form-group form-float">
                        <div class="form-line">
                            <label>Tagline</label>
                            <input type="text" class="form-control" name="tag_line" placeholder="Enter tag line"  required>
                        </div>
                    </div>


                    <div class="form-group form-float">
                        <div class="form-line">
                            <label>Description</label>
                            <input type="text" class="form-control" name="description"  placeholder="Enter description" required>
                        </div>
                    </div>

                    {{--                    <div class="form-group" style="margin-bottom: 5%;">--}}
                    {{--                        <label>Distance</label> <br/>--}}
                    {{--                        <select name="distance"  style="border: 1px solid blue;width: 200px;float: left;" required>--}}
                    {{--                            <option value=''>Select distance</option>--}}
                    {{--                            <option value='Near'>Near</option>--}}
                    {{--                            <option value='Immediate'>Immediate</option>--}}
                    {{--                            <option value='Far'>Far</option>--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}


                    <div class="form-group form-float">
                        <div class="form-line">
                            <label for="title">Distance</label>
                            <select name="distance"  style="width: 550px; height: 33px;" required>
                                <option value=''>Select distance</option>
                                <option value='Near'>Near</option>
                                <option value='Far'>Far</option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group form-float">
                        <div class="form-line">
                            <label>Image</label>
                            <input type="file" class="form-control"  id="myFile" name="image"  required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn" style="background-color: #6860FF;color: white;font-size: 14px;">Add</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>

            </div>
        </div>
    </div>





    {{--    <form id="delete_gateway_form">--}}
    {{--        <input type="hidden" id="gateway">--}}
    {{--    </form>--}}


</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
        $('#set_org_id').val(null);
        $('#set_org_id2').val(null);
        $(".add-beacon").click(function(){
            $(".add_beacon_modal").modal('show');
            $('#form_result').html(null);
        });
    });


    $('#add_beacon_form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "https://procuriot.ioptime.com/add/beacon",
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

                if(data.invalid_mac)
                {
                    html = '<div class="alert alert-info">' + data.invalid_mac + '</div>';
                    $('#form_result').html(null);
                }

                if(data.success)
                {
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $('#add_beacon_form')[0].reset();
                    $('#form_result').html(null);
                    window.location.reload('https://procuriot.ioptime.com/dashboard');
                }

                $('#form_result').html(html);

            }
        })
    });

    $('#upate_gateway_form').on('submit', function (event) {
        $('#form_result3').html(null);
        event.preventDefault();
        $.ajax({
            url: "https://procuriot.ioptime.com/update/gateway",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {
                $('#form_result3').html(null);
                var html = '';
                if(data.errors)
                {
                    html = '<div class="alert alert-danger">';
                    for(var count = 0; count < data.errors.length; count++)
                    {
                        html += '<p>' + data.errors[count] + '</p>';
                    }
                    html += '</div>';
                    $('#form_result3').html(html);
                }
                if(data.success)
                {
                    $('.response_modal').modal('show');
                    window.location.reload();

                }

            }
        })
    });

    $('#upate_beacon_form').on('submit', function (event) {
        event.preventDefault();
        $.ajax({
            url: "https://procuriot.ioptime.com/update/beacon",
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {

                if (data.response) {
                    // alert(data.response);
                    $('.response_modal').modal('show');
                    window.location.reload();
                }
            }
        });
    });


    $(".edit_gateway").click(function(){
        $('#form_result3').html(null);
        var gateway_id = $(this).attr("id");

        $.ajax({
            url: "https://procuriot.ioptime.com/edit/gateway/"+gateway_id,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {

                if(data.data){

                    $('#gateway_id').val(data.data.id);
                    $('#edit_gateway_title').val(data.data.title);
                    $('#edit_gateway_mac_address').val(data.data.mac_address);
                    $('#edit_location option[value="' + data.data.venue_id + '"]').attr("selected", true);
                    $(".edit_gateway_modal").modal('show');
                }
            }
        })
    });

    $(".becon_edit_btn").click(function(){

        var beacon_id = $(this).attr("id");

        $.ajax({
            url: "https://procuriot.ioptime.com/edit/beacon/"+beacon_id,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            success: function (data) {

                if(data.data){

                    console.log(data.data.distance);

                    $('#beacon_id').val(data.data.id);
                    $('#edit_beacon_title').val(data.data.title);
                    $('#edit_beacon_mac_address').val(data.data.mac_address);
                    $('#edit_beacon_tagline').val(data.data.tagline);
                    $('#edit_beacon_description').val(data.data.description);

                    $('.edit_beacon_distance option[value="'+data.data.distance+'"]').prop('selected',true);

                    // $('#gender option[value="' +  obj.data.member_gender +'"]').prop("selected", true);

                    $(".edit_beacon_modal").modal('show');
                }
            }
        })
    });

    // $(".btn_delete_gateway").click(function(){
    //
    //     var gateway_id = $(this).attr("id");
    //
    //         if (confirm("If you delete this gateway then the devices linked with this will also delete, Are you sure to delete ?")) {
    //
    //             $.ajax({
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 },
    //                 url: "https://procuriot.ioptime.com/delete/gateway/"+gateway_id,
    //                 contentType: false,
    //                 cache: false,
    //                 processData: false,
    //                 dataType: "json",
    //                 success: function (data) {
    //                     if(data.response){
    //                         alert(data.response);
    //                         // var url = 'https://procuriot.ioptime.com/dashboard';
    //                         var url = 'https://procuriot.ioptime.com/venues';
    //                         $(location).prop('href', url);
    //                     }
    //                 }
    //             })
    //         }
    //         return false;
    //  });

    $(".btn_delete_gateway").click(function(){

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
                url: "https://procuriot.ioptime.com/delete/gateway/"+get_orgn_id,
                success: function(data)
                {
                    // $('.response_modal2').modal('show');
                    var url = 'https://procuriot.ioptime.com/venues';
                    $(location).prop('href', url);
                }
            });
        }else{
            alert('something went wrong');
        }
    });

    // $(".btn_delete_beacon").click(function(){
    //     var beacon_id = $(this).attr("id");
    //     if (confirm("Are you sure to delete ?")) {
    //         $.ajax({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             url: "https://procuriot.ioptime.com/delete/beacon/"+beacon_id,
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             dataType: "json",
    //             success: function (data) {
    //                 if(data.response){
    //                     alert(data.response);
    //                     window.location.reload();
    //                 }
    //             }
    //         })
    //     }
    //     return false;
    //
    // });

    $(".btn_delete_beacon").click(function(){

        $('#set_org_id2').val(null);

        var org_id2 = $(this).attr("id");

        $('#set_org_id2').val(org_id2);

        $('.confirmation_modal2').modal('show');

    });
    $(document).on("click",".custom-confirmation2",function() {
        var get_orgn_id = $('#set_org_id2').val();
        if(get_orgn_id!=null){
            $.ajax({
                headers:
                    { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
                url: "https://procuriot.ioptime.com/delete/beacon/"+get_orgn_id,
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
</script>


@include('components.footer')



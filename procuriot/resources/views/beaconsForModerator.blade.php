@include('components.head')

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&libraries=places"></script>

<script src="//cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

<link rel="stylesheet" href="//cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

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
            <div class="col-md-12">
                <h3><b>Beacons</b></h3>
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
                                            {{--                                            <button class="btn btn-info becon_edit_btn" id="{{$value->id}}">Edit</button>--}}
                                            <i class="fa fa-edit becon_edit_btn" title="Edit" id="{{$value->id}}" style="color: darkgray;font-size: 20px;"></i></tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
                        <div class="form-group">
                            <label for="exampleInputEmail1">Gateway Title</label>
                            <input type="text" name="edit_gateway_title" style="border: 2px solid lightblue;" class="form-control" id="edit_gateway_title" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mac Address</label>
                            <input type="text" name="edit_gateway_mac_address" style="border: 2px solid lightblue;" class="form-control" id="edit_gateway_mac_address" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">

                            <label for="title">Venue</label>
                            <select name="edit_gateway_venue_id" id="edit_location" class="form-control" style="border: 2px solid lightblue;">
                                <option value=''>Select venue</option>
                                {{--                                @foreach ($locations as $value)--}}
                                {{--                                    <option value="{{ $value->id }}">{{ $value->name }}</option>--}}
                                {{--                                @endforeach--}}
                            </select>

                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update</button>
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
                    <span class="update_res"></span>
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
                                <input type="text" name="edit_beacon_mac_address"  class="form-control" id="edit_beacon_mac_address" required>
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
                                <input type="file" class="form-control" name="edit_beacon_image"  id="edit_beacon_image">
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

    <div class="modal response_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-body" style="text-align: center;">
                    <p style="color: #6860FF;">Data updated successfully</p>
                </div>

            </div>
        </div>
    </div>

</section>

<div class="modal add_beacon_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add beacon</h5>
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
                    {{--                    <input type="hidden" id="hidden_gateway_id" value="{{$data->id}}" name="hidden_gateway_id">--}}
                    <div class="form-group">
                        <label>Mac Address</label>
                        <input type="text" class="form-control" name="mac"  style="border: 1px solid lightblue;" required>
                    </div>
                    <div class="form-group">
                        <label>Product title</label>
                        <input type="text" class="form-control" name="product_title" placeholder="Enter product title" style="border: 1px solid lightblue;" required>
                    </div>
                    <div class="form-group">
                        <label>Tag line</label>
                        <input type="text" class="form-control" name="tag_line" placeholder="Enter tag line" style="border: 1px solid lightblue;" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <input type="text" class="form-control" name="description"  placeholder="Enter description" style="border: 1px solid lightblue;" required>
                    </div>
                    {{--                    <div class="form-group" style="margin-bottom: 5%;">--}}
                    {{--                        <label>Distance</label> <br/>--}}
                    {{--                        <select name="distance"  style="border: 1px solid lightblue;width: 200px;float: left;" required>--}}
                    {{--                            <option value=''>Select distance</option>--}}
                    {{--                            <option value='Near'>Near</option>--}}
                    {{--                            <option value='Immediate'>Immediate</option>--}}
                    {{--                            <option value='Far'>Far</option>--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}

                    <div class="form-group">
                        <label for="title">Distance</label>
                        <select name="distance"  style="border: 1px solid lightblue;width: 550px; height: 33px;" required>
                            <option value=''>Select distance</option>
                            <option value='Near'>Near</option>
                            <option value='Far'>Far</option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-top: 3%;">
                        <label>Image</label>
                        <input type="file" class="form-control"  id="myFile" name="image" style="border: 2px solid lightblue;" required>
                    </div>


                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add</button>
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
        $(".table").DataTable({
            "ordering": false
        });

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

    $(".btn_delete_gateway").click(function(){

        var gateway_id = $(this).attr("id");

        if (confirm("If you delete this gateway then the devices linked with this will also delete, Are you sure to delete ?")) {

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "https://procuriot.ioptime.com/delete/gateway/"+gateway_id,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function (data) {
                    if(data.response){
                        alert(data.response);
                        // var url = 'https://procuriot.ioptime.com/dashboard';
                        var url = 'https://procuriot.ioptime.com/venues';
                        $(location).prop('href', url);
                    }
                }
            })
        }
        return false;
    });

    $(".btn_delete_beacon").click(function(){
        var beacon_id = $(this).attr("id");
        if (confirm("Are you sure to delete ?")) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "https://procuriot.ioptime.com/delete/beacon/"+beacon_id,
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
        }
        return false;

    });

</script>


@include('components.footer')



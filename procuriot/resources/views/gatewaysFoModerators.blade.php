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
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="body" style="margin-top: 1%;">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-md-12">
                                    <h1><b>Gateways</b></h1>
                                </div>
                            </div>
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th style="width: 16%">Gateway Title</th>
                                    <th style="width: 16%">Mac Address</th>
                                    <th style="width: 16%">Venue</th>
                                    {{--                                    <th>Beacons</th>--}}
                                    <th style="width: 16%">Created Date</th>
                                    <th style="width: 20%">Action</th>
{{--                                    <th style="width: 12%">Beacon</th>--}}
                                </tr>
                                </thead>

                                <tbody>

                                @foreach($gateways as $data)
                                    <tr>
                                        <td style="width: 16%;">{{ $data->title }}</td>
                                        <td style="width: 16%;">{{ $data->mac_address }}</td>
                                        <td style="width: 16%;">{{ $data->venue_name }}</td>
                                        <td style="width: 16%;">{{ $data->created_at }}</td>
                                        <td style="width: 20%;">

                                            <i class="fas fa-edit edit_gateway" id="{{$data->id}}" style="color: blue;font-size: 20px"></i>


                                        </td>
{{--                                        <td style="width: 12%;">--}}
{{--                                            <a href="{{url('https://procuriot.ioptime.com/beacons/'.$data->id)}}" class="btn btn-primary btn-sm">--}}
{{--                                                Add Beacon </a>--}}
{{--                                        </td>--}}
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


    <div class="modal add_gateway_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Add Gateway</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
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
                                        <input type="text" name="title" maxlength="100" class="form-control">
                                        <label class="form-label">Gateway title</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" name="mac" class="form-control">
                                        <label class="form-label">Config/Mac address</label>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <select  class="form-control" name="venue">
                                            <option value=''>Select venue</option>
                                            @foreach($locations as $location)
                                                <option value={{$location->id}}>{{$location->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Add</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>

                    </form>
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
                    <span id="form_result3"></span>
                    <form id="upate_gateway_form">
                        @csrf
                        <input type="hidden" id="gateway_id" name="gateway_id">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Title</label>
                            <input type="text" name="edit_gateway_title" style="border: 2px solid lightblue;" class="form-control" id="edit_gateway_title" aria-describedby="emailHelp">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mac address</label>
                            <input type="text" name="edit_gateway_mac_address" style="border: 2px solid lightblue;" class="form-control" id="edit_gateway_mac_address" aria-describedby="emailHelp">
                        </div>

                        <div class="form-group">
                            <label for="title">Venue:</label>
                            <select name="edit_gateway_venue_id" id="edit_location" class="form-control" style="border: 2px solid lightblue;">
                                <option value=''>Select venue</option>
                                @foreach ($locations as $value)
                                    <option value="{{ $value->id }}">{{ $value->name }}</option>
                                @endforeach
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

</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&libraries=places"></script>

<script src = "https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js" defer ></script>
<script src = "https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js" defer ></script>

<link href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css" rel="stylesheet">

<script>
    $(document).ready(function(){
        $('.dropdown-toggle').css('display', 'none');

        $('.table').Datatable();

    });

    $(document).on("click",".add-gateway",function() {
        $(".add_gateway_modal").modal('show');
    });


    $('#upate_gateway_form').on('submit', function (event) {
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

                if(data.msg){
                    alert(data.msg);
                    exit();
                }


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
                    html = '<div class="alert alert-success">' + data.success + '</div>';
                    $(".edit_gateway_modal").modal('hide');
                    $('#form_result3').html(html);
                    window.location.reload();
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
                    $('#form_result2').html(html);
                }

                if(data.invalid_mac)
                {
                    html = '<div class="alert alert-info">';
                    for(var count = 0; count < data.invalid_mac.length; count++)
                    {
                        html += '<p>' + data.invalid_mac[count] + '</p>';
                    }
                    html += '</div>';
                    $('#form_result2').html(html);
                }

                if(data.success)
                {
                    // window.location.reload('https://procuriot.ioptime.com/dashboard');
                    window.location.reload();
                }

            }
        })
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
                        window.location.reload();
                    }
                }
            })
        }
        return false;
    });

</script>

@include('components.footer')


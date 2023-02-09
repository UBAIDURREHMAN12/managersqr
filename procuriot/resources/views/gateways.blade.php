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
        <div class="row">
            <div class="col-md-4" style="text-align: left;">
               <h4>Gateways</h4>
            </div>
            <div class="col-md-4" style="text-align: right;">
            </div>
            <div class="col-md-4" style="text-align: right;">
                <button class="btn btn-sm add-gateway" style="border-radius: 5%;background-color: #6860FF;color: white;font-size: 14px;">Add Gateway</button>
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
                                    <th style="width: 16%">Gateway Title</th>
                                    <th style="width: 16%">Mac Address</th>
                                    <th style="width: 16%">Venue</th>
                                    <th style="width: 16%">Created Date</th>
                                    <th style="width: 20%">Action</th>
                                    <th style="width: 12%">Beacon</th>
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

                                            <i class="fas fa-edit edit_gateway" id="{{$data->id}}" title="Edit" style="color: darkgray;font-size: 20px"></i>
                                            <i class="fas fa-trash btn_delete_gateway" title="Delete" id="{{$data->id}}" style="color: darkgray;font-size: 20px"></i>

                                        </td>
                                        <td style="width: 12%;">
                                            <a href="{{url('https://procuriot.ioptime.com/beacons/'.$data->id)}}"
                                               class="btn btn-sm" style="background-color: #6860FF;color: white;font-size: 14px;">
                                                Add Beacon </a>
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
{{--                                        <select  class="form-control" name="venue">--}}
{{--                                            <option value=''>Select venue</option>--}}
{{--                                            @foreach($locations as $location)--}}
{{--                                                <option value={{$location->id}}>{{$location->name}}</option>--}}
{{--                                            @endforeach--}}
{{--                                        </select>--}}
                                        <select name="venue" class="organization" style="border: none;width: 164px;margin-top: 8%;" required="" tabindex="-98">
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
                            <button type="submit" class="btn" style="background-color: #6860FF;color: white;font-size: 14px;">Add</button>
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
{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputEmail1">Title</label>--}}
{{--                            <input type="text" name="edit_gateway_title" style="border: 2px solid lightblue;" class="form-control" id="edit_gateway_title" aria-describedby="emailHelp">--}}
{{--                        </div>
--}}
                        <div class="form-group form-float">
                            <div class="form-line">
                                <label for="exampleInputEmail1">Gateway Title</label>
                                <input type="text" name="edit_gateway_title" id="edit_gateway_title" class="form-control"  required>
                            </div>
                        </div>

{{--                        <div class="form-group">--}}
{{--                            <label for="exampleInputEmail1">Mac address</label>--}}
{{--                            <input type="text" name="edit_gateway_mac_address" style="border: 2px solid lightblue;" class="form-control" id="edit_gateway_mac_address" aria-describedby="emailHelp">--}}
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
                    <button type="submit" class="btn btn-primary custom-confirmation">Ok</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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
        $('#set_org_id').val(null);
        $('.dropdown-toggle').css('display', 'none');

        $(".table").DataTable({
            "ordering": false
        });

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

    // $(".btn_delete_gateway").click(function(){
    //
    //     var gateway_id = $(this).attr("id");
    //
    //     if (confirm("If you delete this gateway then the devices linked with this will also delete, Are you sure to delete ?")) {
    //
    //         $.ajax({
    //             headers: {
    //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //             },
    //             url: "https://procuriot.ioptime.com/delete/gateway/"+gateway_id,
    //             contentType: false,
    //             cache: false,
    //             processData: false,
    //             dataType: "json",
    //             success: function (data) {
    //                 if(data.response){
    //                     window.location.reload();
    //                 }
    //             }
    //         })
    //     }
    //     return false;
    // });

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
                    window.location.reload();
                }
            });
        }else{
            alert('something went wrong');
        }
    });
</script>

@include('components.footer')


@include('components.head')


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&libraries=places"></script>

<link rel="stylesheet" href="{{asset('/build/css/intlTelInput.css')}}">

<style>
    #geomap{
        width: 100%;
        height: 400px;
    }
    .dropdown-toggle {
        display: none;
    }
    i:hover {
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

    <section class="content">

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-4" style="text-align: left;">
                    <h4 style="font-weight: bold;font-size: 18px;">Moderators</h4>
                </div>
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
{{--                    <button id="fa-plus" class="btn"--}}
{{--                            style="float: right;margin-right: 2%;background-color: #6860FF;color: white;font-size: 14px;">Add Moderator</button>--}}
                    <a href="/create/moderator" class="btn"  style="float: right;background-color: #6860FF;font-size: 14px;color: white;">Add Moderator</a>

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
                                        <th style="width: 14%" scope="col">First Name</th>
                                        <th style="width: 14%" scope="col">Last Name</th>
                                        <th style="width: 14%" scope="col">Organization</th>
                                        <th style="width: 14%" scope="col">Email</th>
                                        <th style="width: 14%" scope="col">Contact</th>
                                        <th style="width: 18%" scope="col">Address</th>
                                        <th style="width: 22%" scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($moderators as $value)
                                        <tr>
                                            <td style="width: 14%"> {{$value->first_name}}</td>
                                            <td style="width: 14%"> {{ $value->last_name }}</td>
                                            <td style="width: 14%"> {{ \App\Organization::where(['id' => $value->company])->pluck('name')->first() }}</td>
                                            <td style="width: 14%"> {{ $value->email }}</td>
                                            <td style="width: 14%"> {{ $value->phone }}</td>
                                            <td style="width: 18%"> {{ $value->address }}</td>
                                            <td style="width: 22%">
{{--                                                <i class="fa fa-edit" title="Edit" id="{{$value->id}}" style="color: darkgray;font-size: 20px;"></i>--}}
                                                <a href="{{url('https://procuriot.ioptime.com/create/moderator/'.$value->id)}}"
                                                   title="Edit" style="font-size: 20px;color: darkgray !important;"> <i class="fa fa-edit"></i> </a>
                                                <i class="fa fa-trash" title="Delete" id="{{$value->id}}" style="color: darkgray;font-size: 20px;"></i>
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

        <div class="modal add_moderator_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Moderator</h5>
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
                        <form id="add_moderator_form">

                            <span id="form_result15" style="color: blue;"></span>

                            <div class="row processing" style="display: none;">
                                <div class="col-md-12"; style="text-align: center;">
                                    <span style="color: blue;">processing...</span>
                                </div>
                            </div>

                            @csrf
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">First Name</label>
                                        <div class="form-line">
                                            <input type="text" name="first_name"  maxlength="100" class="form-control" id="first_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Last Name</label>
                                        <div class="form-line">
                                            <input type="text" name="last_name"  maxlength="100" class="form-control" id="last_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Email</label>
                                        <div class="form-line">
                                            <input type="email" name="email" class="form-control" id="email" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Organization</label>
                                        <div class="form-line">
                                            <input type="text" name="organization" value="@if($organization->name) {{$organization->name}} @endif"  maxlength="100" class="form-control" id="organization" required readonly>
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">--}}
{{--                                    <div class="form-group form-float">--}}
{{--                                        <label class="form-label">Contact</label>--}}
{{--                                        <div class="form-line">--}}
{{--                                            <input type="number" name="phone"  maxlength="100" class="form-control" id="phone" required>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}



                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <label for="phone">Contact (format: xxx-xxx-xxxx)</label><br/>
                                        <div class="form-line">
                                            {{--                                            <input id="phone" class="phone" name="phone" class="phone" type="tel" style="border: none;">--}}
                                            <input  id="phone" class="phone form-control" name="phone" type="tel" pattern="\d{3}[\-]\d{3}[\-]\d{4}" style="border: none;" required >

                                            <input type="hidden" name="get_c_code" id="get_c_code">
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="col-lg-1 col-md-2 col-sm-1 col-xs-1">--}}
{{--                                    <div class="form-group form-float">--}}
{{--                                        <div style="margin-top: 58px;">--}}
{{--                                            <span id="spnPhoneStatus"></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <label class="form-label">Address</label>
                                        <div class="form-line">
                                            <input type="text" name="address"  maxlength="100" class="form-control" id="address" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn" style="background-color: #6860FF;color: white;font-size: 14px;float: right;">Add</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

        <div class="modal admin_edit_modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Update Moderator</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <span id="send_link_response" style="color: #6860FF;"></span>
                        <div class="row">
                            <div class="col-md-12" style="text-align: center;">
                                <span id="spnPhoneStatus3" style="color: red;"></span>
                            </div>
                        </div>
                        <form id="update_admin_form">

                            <input type="hidden" name="edit_admin_id" id="edit_admin_id">
                            <span id="form_result12" style="color: blue;"></span>
                            @csrf
                            <div class="row clearfix">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">First Name</label>
                                        <div class="form-line">
                                            <input type="text" name="edit_first_name"  maxlength="100" class="form-control" id="edit_first_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Last Name</label>
                                        <div class="form-line">
                                            <input type="text" name="edit_last_name"  maxlength="100" class="form-control" id="edit_last_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Email</label>
                                        <div class="form-line">
                                            <input type="email" name="edit_email" class="form-control" id="edit_email" required readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="form-group form-float">
                                        <label class="form-label">Organization</label>
                                        <div class="form-line">
                                            <input type="text" name="edit_organization" value="{{$organization->name}}" placeholder="{{$organization->name}}"  maxlength="100" class="form-control" id="edit_organization" required readonly>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <label for="phone">Contact (format: xxx-xxx-xxxx)</label><br/>
                                        <div class="form-line">
                                            {{--                                            <input id="phone" class="phone" name="phone" class="phone" type="tel" style="border: none;">--}}
                                            <input  id="edit_phone" class="phone form-control" name="edit_phone" type="tel" pattern="\d{3}[\-]\d{3}[\-]\d{4}" style="border: none;" required >

                                            <input type="hidden" name="get_c_code" id="get_c_code">
                                        </div>
                                    </div>
                                </div>

{{--                                <div class="col-lg-1 col-md-2 col-sm-1 col-xs-1">--}}
{{--                                    <div class="form-group form-float">--}}
{{--                                        <div style="margin-top: 48px;">--}}
{{--                                            <span id="spnPhoneStatus5"></span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="form-group form-float">
                                        <label class="form-label">Address</label>
                                        <div class="form-line">
                                            <input type="text" name="edit_address"  maxlength="100" class="form-control" id="edit_address" required>
                                        </div>
                                    </div>
                                </div>

{{--                                    <div class="row">--}}

{{--                                        <div class="col-md-6">--}}
{{--                                            <button type="submit" style="width: 50%;background-color: #6860FF;color: white;font-size: 14px;"--}}
{{--                                                    class="btn btn-lg m-l-15 waves-effect">Update</button>--}}
{{--                                        </div>--}}

{{--                                        <div class="col-md-6">--}}
{{--                                            <a type="button" class="btn btn-lg m-l-15 waves-effect send-link"--}}
{{--                                                    style="background-color: #6860FF;color: white;width: 50%; font-size: 14px;">Password Reset</a>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}

                                <div class="row" style="text-align: right;">
                                    <button type="submit" class="btn" style="background-color: #6860FF;width: 20%;
                                    color: white; font-size: 14px;">Update</button>
                                    <button type="button" class="btn send-link"
                                            style="background-color: #6860FF;color: white;font-size: 14px;margin-right: 5%;">Reset Password</button>
                                </div>


                            </div>

                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="modal processing_modal34" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">

                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12" style="text-align: center;">
                            <p style="color: blue;">Data updated successfully</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="modal response_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <span>Moderator Deleted Successfully</span>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal add_response_modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                   <span style="background-color: #6860FF;color: white;font-size: 14px;">Moderator Added Successfully</span>
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
                    <p>Are you sure to delete this moderator ?</p>
                    <input type="hidden" id="set_org_id">
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn custom-confirmation" style="background-color: #6860FF;color: white;font-size: 14px;">Ok</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

</section>

<script src="{{asset('/build/js/intlTelInput.js')}}"></script>
<script>
    $(document).ready(function() {
        $('#set_org_id').val(null);
        $(".table").DataTable({
            "ordering": false
        });

        $('#spnPhoneStatus').html(null);
        $('#spnPhoneStatus2').html(null);
        {{--var input = document.querySelector("#phone");--}}
        {{--window.intlTelInput(input, {--}}
        {{--    allowDropdown: true,--}}
        {{--    utilsScript: "{{asset('/build/js/utils.js')}}",--}}
        {{--});--}}

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

    $(document).on("keyup",".edit_phone",function() {
        var mobile_number = $(this).val();
        if(mobile_number.length >= 7 && mobile_number.length <=11 ){


            if(isNaN(mobile_number)){

                $('#spnPhoneStatus5').html('<i class="far fa-window-close"></i>');
                $('#spnPhoneStatus5').css('color', 'red');

            }else{
                $('#spnPhoneStatus5').html('<i class="fas fa-check-square"></i>');
                $('#spnPhoneStatus5').css('color', 'green');
                $('#spnPhoneStatus3').html(null);
            }

        }else{
            $('#spnPhoneStatus5').html('<i class="far fa-window-close"></i>');
            $('#spnPhoneStatus5').css('color', 'red');
        }
    });
    $(document).on("click",".fa-edit",function() {
        $('#admin_edit_modal').html(null);
        $('#form_result12').html(null);
        var admin_id = $(this).attr("id");
        $.ajax({
            url: "https://procuriot.ioptime.com/edit/admin/"+admin_id,
            success: function(res){
                $('#edit_admin_id').val(res.data.id);
                $('.send-link').attr("id", res.data.id);
                $('#edit_first_name').val(res.data.first_name);
                $('#edit_last_name').val(res.data.last_name);
                $('#edit_email').val(res.data.email);
                $('#edit_organization option[value="' + res.data.organization +'"]').prop("selected", true);
                $('#edit_phone').val(res.data.phone);
                $('#edit_address').val(res.data.address);
                $('.admin_edit_modal').modal('show');
            }
        });
    });

    // this is the id of the form
    $("#update_admin_form").submit(function(e) {

        // var boolean2 = check_number_for_update();
        //
        // if(boolean2){
            e.preventDefault(); // avoid to execute the actual submit of the form.

            var form = $(this);
            var actionUrl = form.attr('action');

            $.ajax({
                type: "POST",
                url: "https://procuriot.ioptime.com/update/self/admin",
                data: form.serialize(), // serializes the form's elements.
                success: function(data)
                {
                    $('.processing_modal34').modal('show');

                    setTimeout(function(){
                        window.location.reload(1);
                    }, 2000);
                }
            });
        // }else{
        //     return false;
        // }
    });


    // $(document).on("click",".fa-trash",function() {
    //     var admin_id = $(this).attr("id");
    //
    //     if (confirm("Are you sure to delete this admin ?")) {
    //         $.ajax({
    //             headers:
    //                 { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
    //             type: "POST",
    //             url: "https://procuriot.ioptime.com/delete/admin/"+admin_id,
    //             success: function(data)
    //             {
    //                 //alert(data.response);
    //                 window.location.reload();
    //                 $('.response_modal').modal('show');
    //             }
    //         });
    //     }
    //     return false;
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
                url: "https://procuriot.ioptime.com/delete/admin/"+get_orgn_id,
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
        $('#form_result15').html(null);
        $('.add_moderator_modal').modal('show');
    });


    // $(document).on("click",".send-link",function() {
    //     var moderator_id = $(this).attr("id");
    //     if (confirm("Confirm to send password reset link to this moderator ?")) {
    //         $('.processing_modal').modal('show');
    //         $.ajax({
    //             url: "https://procuriot.ioptime.com/send/link/"+moderator_id,
    //             success: function(res){
    //                 $('.processing_modal').modal('hide');
    //                 alert(res.response);
    //             }
    //         });
    //     }
    //     return false;
    // });

    $(document).on("click",".send-link",function() {
        $('.processing_modal').modal('hide');
        var moderator_id = $(this).attr("id");
        $.ajax({
            url: "https://procuriot.ioptime.com/send/link/"+moderator_id,
            success: function(res){
                $('#send_link_response').html('<p>'+res.response+'</p>');
            }
        });
    });

    function check_number(){
        var mobile_number = $('.phone').val();
        if(mobile_number.length >= 7 && mobile_number.length <=11 ){


            if(isNaN(mobile_number)){

                $('#spnPhoneStatus2').html('<p>invalid contact number</p>');
                $('#spnPhoneStatus2').css('color', 'red');
                return false;

            }else{
                $('#spnPhoneStatus2').html(null);
                return true;
            }

        }else{
            $('#spnPhoneStatus2').html('<p>Contact length should between 7 and 11</p>');
            $('#spnPhoneStatus2').css('color', 'red');
            return false;
        }
    }

    function check_number_for_update(){
        var mobile_number = $('.edit_phone').val();
        if(mobile_number.length >= 7 && mobile_number.length <=11 ){


            if(isNaN(mobile_number)){

                $('#spnPhoneStatus3').html('<p>Invalid contact number</p>');
                $('#spnPhoneStatus3').css('color', 'red');
                return false;

            }else{
                $('#spnPhoneStatus3').html(null);
                return true;
            }

        }else{
            $('#spnPhoneStatus3').html('<p>Contact length should between 7 and 11</p>');
            $('#spnPhoneStatus3').css('color', 'red');
            return false;
        }
    }
    $("#add_moderator_form").submit(function(e) {

        $('#spnPhoneStatus2').html(null);
       //  var boolean_val = check_number();
       //
       // if(boolean_val){
           $('.processing').css('display', 'block');
           $('.btn-add').prop('disabled', true);
           e.preventDefault(); // avoid to execute the actual submit of the form.
           var form = $(this);

           $.ajax({
               type: "POST",
               url: "https://procuriot.ioptime.com/add/moderator",
               data: form.serialize(), // serializes the form's elements.
               success: function(data)
               {
                   var html = '';
                   if(data.errors)
                   {
                       $('.processing').css('display', 'block');
                       html = '<div class="alert alert-danger">';
                       for(var count = 0; count < data.errors.length; count++)
                       {
                           html += '<p>' + data.errors[count] + '</p>';
                       }
                       html += '</div>';


                       $('.processing').css('display', 'none');
                       $('.btn-add').prop('disabled', false);

                       $('#form_result15').html(html);

                   }
                   if(data.success)
                   {
                       $('.processing').css('display', 'none');
                       $('.btn-add').prop('disabled', false);
                       html = '<div class="alert alert-success">' + data.success + '</div>';
                       window.location.reload();
                       $('.add_response_modal').modal('show');
                   }

               }
           });
       // }else{
       //     return false;
       // }

    });

</script>

@include('components.footer')
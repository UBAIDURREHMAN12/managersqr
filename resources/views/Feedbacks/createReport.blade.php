{{--<script type="text/javascript" src='http://code.jquery.com/jquery-latest.min.js'></script>--}}
<script type="text/javascript" src="/public/assets/multiple-emails.js"></script>
<link type="text/css" rel="stylesheet" href="/public/assets/multiple-emails.css" />
{{--<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.12.2/semantic.min.css" />--}}
{{--<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/1.12.2/semantic.min.js"></script>--}}
{{--<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/js/bootstrap.min.js"></script>--}}

<style>
    /*@import url("//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css");*/

    .multiple_emails-container input{
        clear: both;
        width: 100%;
        border: 0;
        outline: none;
        margin-bottom: 3px;
        padding-left: 5px;
        box-sizing: border-box;
        font-size: 17px;
    }
    .multiple_emails-container ul {
        list-style-type: none;
        padding-left: 0;
        font-size: 14px;
    }
    .table {
        width: 100%;
        max-width: 100%;
        margin-bottom: 1rem;
        background-color: transparent;
        font-size: 14px;
    }

    .btn:focus, .btn:active, button:focus, button:active {
        outline: none !important;
        box-shadow: none !important;
    }

    #image-gallery .modal-footer{
        display: block;
    }

    .thumb{
        margin-top: 15px;
        margin-bottom: 15px;
    }

    .modal .modal-dialog {
        margin-top: 5px;
    }
    .checkbox label, .radio label, label {
        font-size: 17px;
    }

</style>
<script>
    $(function() {
        //To render the input device to multiple email input using BootStrap icon
        $('#example_emailBS').multiple_emails({position: "bottom",placeholder:"To"});
        //OR $('#example_emailBS').multiple_emails("Bootstrap");

        //Shows the value of the input device, which is in JSON format
        $('#current_emailsBS').text($('#example_emailBS').val());
        $('#example_emailBS').change( function(){
            $('#current_emailsBS').text($(this).val());
        });
    });
</script>
<div class="col-md-12">
    <form id="RegisterValidation" >
        <div class="card">

            <div class="card-body ">

                <div class="row">
                    <div class="col-lg-12  main-section bg-white">
                        <div class="row">
                            <div class="col-lg-12 p-2">
                                <h2>Send Report</h2>
                            </div>
                        </div>
                        <div class="row">

                                    <div class="col-lg-12 p-0 message-box-input">

                                            <div class="form-group">
                                                <input type="hidden" name="id" value="{{$feedback->order_id}}">
                                                <label>Email</label>
                                                <input type='text' id='example_emailBS' placeholder="To" name='example_emailBS' value="{example@email.com}" class='form-control' onkeyup="test()"  required>
                                               <h3>Feedback received from guest</h3>

                                                <table class="table table-bordered">

                                                    <tbody>

                                                    @if(isset($feedback->area) && !empty($feedback->area))
                                                        <tr>
                                                            <td style="background: #F3F3F3;" colspan="5"><b>Common Area</b></td>
                                                            <td>{{$feedback->area}}</td>

                                                        </tr>
                                                        @else
                                                    <tr>
                                                        <td style="background: #F3F3F3;" colspan="5"><b>Floor</b></td>
                                                        <td>{{str_pad($feedback->floor_id, 2, '0', STR_PAD_LEFT)}}</td>

                                                    </tr>
                                                    @if(str_pad($feedback->room_id, 2, '0', STR_PAD_LEFT)!=00)
                                                    <tr>
                                                        <td style="background: #F3F3F3;" colspan="5"><b>Room</b></td>
                                                        <td>{{str_pad($feedback->room_id, 2, '0', STR_PAD_LEFT)}}</td>

                                                    </tr>
                                                        @endif
                                                    @endif
                                                    <tr>
                                                        <td style="background: #F3F3F3;" colspan="5"><b>Category</b></td>
                                                        <td>{{$feedback->name}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td style="background: #F3F3F3;" colspan="5"><b>Note</b></td>
                                                        <td>{{$feedback->note}}</td>

                                                    </tr>
                                                    <tr>
                                                        <td style="background: #F3F3F3;" colspan="5"><b>Date</b></td>
                                                        <td>{{date('d-m-Y', strtotime($feedback->created_at))}}</td>
                                                    </tr>

                                                    </tbody>
                                                </table>



{{--                                                <input type="text" class="form-control" id="exampleInputEmail2" name="category_name"  value="{{$feedback->name}}" aria-describedby="emailHelp"  disabled>--}}
{{--                                                <input type="text" class="form-control" id="exampleInputEmail3" name="note"  value="{{$feedback->note}}" aria-describedby="emailHelp"  disabled>--}}

                                                <textarea class="form-control"  name="admin_note"  id="exampleFormControlTextarea1" placeholder="Want add something" rows="6"></textarea>

                                                @if(isset($feedbackImages) && count($feedbackImages)>0)
                                                    <div class="checkbox" style="margin-top: 10px">
                                                        <label><input type="checkbox" name="attachment" value="1"> Attach Images</label>
                                                    </div>
                                                    @endif


                                            </div>



                                        @if(isset($feedbackImages) && count($feedbackImages)>0)



                                                <div class="row">
                                                    <div class="row">
                                                        @foreach($feedbackImages as $image)
                                                        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                                            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                                                               data-image="{{$image->image}}"
                                                               data-target="#image-gallery">
                                                                <img class="img-thumbnail"
                                                                     src="{{$image->image}}"
                                                                     alt="Another alt text">
                                                            </a>
                                                        </div>
                                                        @endforeach



                                                    </div>


                                                    <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h4 class="modal-title" id="image-gallery-title"></h4>
                                                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>
                                                                    </button>

                                                                    <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>







                                        @endif

                                         </div>
                                    <div class="co-lg-12 message-box-last-content p-2">
                                        <input onclick="sendReport()" id="submitButton" type="button" value="SEND" class="btn btn-primary btn-lg pl-3 pr-3">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




</form>
            </div>

        </div>

</div>


<script>
    $( "#submitButton" ).click(function(e) {

         var val=$('#example_emailBS').val();

         if(val=='undefined' || val=='' || val==null){

             alert('Email field is required!');

         }else{

             $('#submitButton').val('Sending...');
             $('#submitButton').prop('disabled',true);


             var form =$("#RegisterValidation").serializeArray();
             $.ajaxSetup({
                 headers: {
                     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                 }
             });
             jQuery.ajax({
                 url: '/sendReport',
                 method: 'post',
                 data: {
                     form: form,
                 },

                 success: function(result){
                     $('#submitButton').val('Send');
                     $('#submitButton').prop('disabled',false);

                     location.reload();
                 }});

         }


    });



</script>

<script>
    document.getElementById('RegisterValidation').addEventListener('submit', function(e) {

        e.preventDefault();
    }, false);
</script>




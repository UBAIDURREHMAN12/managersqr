<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        .inputstl {
            padding: 9px;
            border: solid 1px #4B718B;
            outline: 0;
            background: -webkit-gradient(linear, left top, left 25, from(#FFFFFF), color-stop(4%, #CDDBE4), to(#FFFFFF));
            background: -moz-linear-gradient(top, #FFFFFF, #CDDBE4 1px, #FFFFFF 25px);
            box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;
            -moz-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;
            -webkit-box-shadow: rgba(0,0,0, 0.1) 0px 0px 8px;

        }

        body{
            /*background-color: lightgray;*/
            background-image: url('http://managersqr.managershq.com.au/public/pexels-photo-1032650.jpeg');
        }

        label {
            font-size: 15px;
        }

        .preview-images-zone {
            width: 100%;
            border: 1px solid #ddd;
            min-height: 180px;
            /* display: flex; */
            padding: 5px 5px 0px 5px;
            position: relative;
            overflow:auto;
        }
        .preview-images-zone > .preview-image:first-child {
            height: 185px;
            width: 185px;
            position: relative;
            margin-right: 5px;
        }
        .preview-images-zone > .preview-image {
            height: 90px;
            width: 90px;
            position: relative;
            margin-right: 5px;
            float: left;
            margin-bottom: 5px;
        }
        .preview-images-zone > .preview-image > .image-zone {
            width: 100%;
            height: 100%;
        }
        .preview-images-zone > .preview-image > .image-zone > img {
            width: 100%;
            height: 100%;
        }
        .preview-images-zone > .preview-image > .tools-edit-image {
            position: absolute;
            z-index: 100;
            color: #fff;
            bottom: 0;
            width: 100%;
            text-align: center;
            margin-bottom: 10px;
            display: none;
        }
        .preview-images-zone > .preview-image > .image-cancel {
            font-size: 18px;
            position: absolute;
            top: 0;
            right: 0;
            font-weight: bold;
            margin-right: 10px;
            cursor: pointer;
            display: none;
            z-index: 100;
        }
        .contact{
            padding: 4%;
            height: 400px;
        }
        .col-md-3{
            background: #ff9b00;
            padding: 4%;
            border-top-left-radius: 0.5rem;
            border-bottom-left-radius: 0.5rem;
        }
        .contact-info{
            margin-top:10%;
        }
        .contact-info img{
            margin-bottom: 15%;
        }
        .contact-info h2{
            margin-bottom: 10%;
        }
        .col-md-9{
            background: #fff;
            padding: 3%;
            border-top-right-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }
        .contact-form label{
            font-weight:600;
        }
        .contact-form button{
            background: #25274d;
            color: #fff;
            font-weight: 600;
            width: 25%;
        }
        .contact-form button:focus{
            box-shadow:none;
        }
    </style>


</head>

<body>
<div class="container">

    {{--    <div class="row">--}}
    {{--        <div class="col-md-12" style="text-align: center;">--}}
    {{--            @if(isset($property->image))--}}
    {{--                <img class="d-block mx-auto mb-4" style='height:170px;width:170px;' src="{{$property->image}}" alt="" >--}}

    {{--            @else--}}
    {{--                <img class="d-block mx-auto mb-4" style='height:170px;width:170px;'  src="/public/logo-default.png" alt="" >--}}

    {{--            @endif--}}
    {{--        </div>--}}
    {{--    </div>--}}

    <div class="contact-info">
        @if ($message = Session::get('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <p>{{ $message }}</p>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show">

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(isset($property->image))
            <img class="d-block mx-auto mb-4" style='height:170px;width:170px;' src="{{$property->image}}" alt="" >

        @else
            <img class="d-block mx-auto mb-4" style='height:170px;width:170px;'  src="/public/logo-default.png" alt="" >

        @endif
<div class="row">
    <div  class="col-md-12" style="text-align: center;">
        @if($errors->any())
            <h4 style="color: red;">{{$errors->first()}}</h4>
        @endif
            @if(session()->has('message'))
                <div class="alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
    </div>
</div>
        @if($property->des=='units')
            @if($qrCodeData->floor_no>0 && $qrCodeData->room_no>0)

                <h4><b> Unit : {{$qrCodeData->floor_no}} Room : {{$qrCodeData->room_no}}</b></h4>

            @else

                <h4><b> Unit : {{$qrCodeData->floor_no}}</b></h4>

            @endif


        @elseif($property->des=='Apartments')

            @if($qrCodeData->floor_no>0 && $qrCodeData->room_no>0)

              <div class="container" style="text-align: center;">
                  <h4><b> Apartment : {{$qrCodeData->floor_no}} Room : {{$qrCodeData->room_no}}</b></h4>
              </div>

            @else

               <div class="container" style="text-align: center;">
                   <h4><b> Apartment : {{$qrCodeData->floor_no}}</b></h4>
               </div>

            @endif

        @elseif($property->des=='other')
            <h4><b>{{ucfirst($qrCodeData->area)}}</b></h4>

        @else
            <h4><b>{{ucfirst($property->title)}}</b></h4>
        @endif


        @if(isset($property->formNote) && !empty($property->formNote))

            <div class="continer" style="text-align: center;">
                {{strip_tags($property->formNote)}}
            </div>

        @else
                <div class="continer" style="text-align: center;">
                    {{strip_tags($property->formNote)}}
                </div>

        @endif
    </div>

    <form class="needs-validation" method="post" action="/submitForm" enctype="multipart/form-data" novalidate>
        @csrf
        <input type="hidden" value="{{$qrCodeData->id}}" name="qrCode_id">
        <input type="hidden" value="{{$qrCodeData->floor_no}}" name="floor_id">
        <input type="hidden" value="{{$qrCodeData->room_no}}" name="room_id">
        <input type="hidden" value="{{$qrCodeData->room_no}}" name="room_id">
        <input type="hidden" id ="property_id" value="{{$qrCodeData->property_id}}" name="property_id">
        <input type="hidden" value="{{$qrCodeData->area}}" name="area">
        <div class="col-md-12 mb-3">
            <label for="country">User Type</label>
            <select onchange="userSelection()" class="custom-select d-block w-100" name="user" id="user"  required>
                <option value="">Select User Type</option>

                @foreach($feedbacks as $feedback)

                    <option value="{{$feedback->feedback}}">{{$feedback->feedback}}</option>

                @endforeach

            </select>
            <div class="invalid-feedback">
                Please Choose Order Option
            </div>

        </div>
        <div class="col-md-12 mb-3" id="key">


        </div>
        <div class="col-md-12 mb-3 form-group">
            <label for="country">Select Category</label>
            <select class="custom-select d-block w-100" name="order" id="country"  required>
                <option value="">Choose...</option>
                @foreach($categories as $c)
                    <option value="{{$c->id}}" {{ old('order') == $c->name ? 'selected' : '' }}>{{$c->name}}</option>
                @endforeach
            </select>
            <div class="invalid-feedback">
                Please Choose Order Option
            </div>

        </div>

        <div class="col-md-12 mb-3">
            <label for="firstName">Add Note</label>
            <textarea rows="10" class="form-control" id="firstName" name="note" required>{{ old('note') }}</textarea>
            <div class="invalid-feedback">
                Please Add Note
            </div>
        </div>

        <div class="col-md-12 mb-3">

            <fieldset class="form-group">
                <a style="font-size: 15px;" href="javascript:void(0)" onclick="$('#pro-image').click()">Upload Image</a>
                <input type="file" id="pro-image" name="pro-image[]" style="display: none;" class="form-control" multiple>
            </fieldset>
            <div  style="display: none" class="preview-images-zone">

            </div>

        </div>

        {{--                <div class="form-group{{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">--}}
        {{--                    <label class="col-md-4 control-label">Captcha</label>--}}
        {{--                    <div class="col-md-6">--}}
        {{--                        {!! app('captcha')->display() !!}--}}
        {{--                        @if ($errors->has('g-recaptcha-response'))--}}
        {{--                            <span class="help-block">--}}
        {{--                                        <strong>{{ $errors->first('g-recaptcha-response') }}</strong>--}}
        {{--                                    </span>--}}
        {{--                        @endif--}}
        {{--                    </div>--}}
        {{--                </div>--}}





        <hr class="mb-4">
        <button class="btn btn-primary btn-lg btn-block" type="submit">Send</button>
    </form>
</div>
</div>
</div>

<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict';

        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');

            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        }, false);
    })();
</script>

<script>
    $(document).ready(function() {

        var ident = 'Guest';
        $('select option[value="' + ident +'"]').prop("selected", true);


        $('.mdb-select').materialSelect();
    });

    function userSelection() {
        var user=$('#user').val();
        var property=$('#property_id').val();


        $.ajax({
            url: '/getFeedbackType',
            type: 'POST',
            data: {user:user,property:property,"_token": "{{ csrf_token() }}"},

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

</script>


<script>
    $(document).ready(function() {
        document.getElementById('pro-image').addEventListener('change', readImage, false);

        $( ".preview-images-zone" ).sortable();

        $(document).on('click', '.image-cancel', function() {
            let no = $(this).data('no');
            $(".preview-image.preview-show-"+no).remove();
        });
    });



    var num = 4;
    function readImage() {

        $('.preview-images-zone').show();

        if (window.File && window.FileList && window.FileReader) {
            var files = event.target.files; //FileList object
            var output = $(".preview-images-zone");

            for (let i = 0; i < files.length; i++) {
                var file = files[i];
                if (!file.type.match('image')) continue;

                var picReader = new FileReader();

                picReader.addEventListener('load', function (event) {
                    var picFile = event.target;
                    var html =  '<div class="preview-image preview-show-' + num + '">' +
                        '<div class="image-cancel" data-no="' + num + '">x</div>' +
                        '<div class="image-zone"><img id="pro-img-' + num + '" src="' + picFile.result + '"></div>' +
                        '<div class="tools-edit-image"><a href="javascript:void(0)" data-no="' + num + '" class="btn btn-light btn-edit-image">edit</a></div>' +
                        '</div>';

                    output.append(html);
                    num = num + 1;
                });

                picReader.readAsDataURL(file);
            }
            // $("#pro-image").val('');
        } else {
            console.log('Browser not support');
        }
    }


</script>

</div>
</body>
</html>


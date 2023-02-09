@extends('layouts.admin_layout')
@section('title')
  Properties

@endsection

@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            top:8px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;

        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #F56530;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #F56530;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
        .container {
            max-width: 500px;
        }
        dl, ol, ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
        .preview img {
            padding: 8px;
            max-width: 100px;
        }
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .bs-example{
            margin: 20px;
        }
        .accordion .fa{
            margin-right: 0.5rem;
        }


        .input-group-addon {
            padding: .375rem .75rem;
            margin-bottom: 0;
            font-size: 1rem;
            font-weight: 400;
            line-height: 1.5;
            color: #495057;
            text-align: center;
            background-color: #e9ecef;
            border: 1px solid #ced4da;
        }
        .btn-link {
            font-weight: 400;
            color: #515151;
            text-decoration: none;
        }
        #main-heading{
            font-weight: 400;
            font-size: 24px;
            text-align: left;
            margin-top: 19px;
            margin-left: 19px;

        }
        .apply-button{
            width: 270px;
            margin-left: 38px !important;
        }
        .panel-title {
            position: relative;
        }

        .panel-title::after {
            content: "\f107";
            color: #333;
            top: -2px;
            right: 0px;
            position: absolute;
            font-family: "FontAwesome"
        }

        .panel-title[aria-expanded="true"]::after {
            content: "\f106";
        }
        .angles{
            float: right !important;
            margin-top: 5px;
        }
        .btn-link:hover  {

            text-decoration: none !important;
        }
        .btn-link:visited  {

            text-decoration: none !important;
        }
        .btn-link:focus  {

            text-decoration: none !important;
        }
        .btn-link:active {

            text-decoration: none !important;
        }
        .card-body{
            background: #F4F8FF;
        }
        .card-header{
            background: white;
        }
        .card-header .icon{
            background: #F4F8FF;
        }
        .icon{
            background: #F4F8FF;
            position: relative;
            right: 20px;
            height: 44px !important;
            bottom: 12px;
        }
        .heading-button{
            margin-bottom: -6px;
            position: relative;
            bottom: 14px;
            right: 20px;
            font-size: 15px;
            border: none !important;
            outline: none !important;
     box-shadow: none !important;
        }


        @keyframes ldio-hncy58lj4t7 {
            0% { opacity: 1 }
            100% { opacity: 0 }
        }
        .ldio-hncy58lj4t7 div {
            left: 94px;
            top: 48px;
            position: absolute;
            animation: ldio-hncy58lj4t7 linear 1s infinite;
            background: #8d77ff;
            width: 12px;
            height: 24px;
            border-radius: 6px / 12px;
            transform-origin: 6px 52px;
        }.ldio-hncy58lj4t7 div:nth-child(1) {
             transform: rotate(0deg);
             animation-delay: -0.9166666666666666s;
             background: #8d77ff;
         }.ldio-hncy58lj4t7 div:nth-child(2) {
              transform: rotate(30deg);
              animation-delay: -0.8333333333333334s;
              background: #8d77ff;
          }.ldio-hncy58lj4t7 div:nth-child(3) {
               transform: rotate(60deg);
               animation-delay: -0.75s;
               background: #8d77ff;
           }.ldio-hncy58lj4t7 div:nth-child(4) {
                transform: rotate(90deg);
                animation-delay: -0.6666666666666666s;
                background: #8d77ff;
            }.ldio-hncy58lj4t7 div:nth-child(5) {
                 transform: rotate(120deg);
                 animation-delay: -0.5833333333333334s;
                 background: #8d77ff;
             }.ldio-hncy58lj4t7 div:nth-child(6) {
                  transform: rotate(150deg);
                  animation-delay: -0.5s;
                  background: #8d77ff;
              }.ldio-hncy58lj4t7 div:nth-child(7) {
                   transform: rotate(180deg);
                   animation-delay: -0.4166666666666667s;
                   background: #8d77ff;
               }.ldio-hncy58lj4t7 div:nth-child(8) {
                    transform: rotate(210deg);
                    animation-delay: -0.3333333333333333s;
                    background: #8d77ff;
                }.ldio-hncy58lj4t7 div:nth-child(9) {
                     transform: rotate(240deg);
                     animation-delay: -0.25s;
                     background: #8d77ff;
                 }.ldio-hncy58lj4t7 div:nth-child(10) {
                      transform: rotate(270deg);
                      animation-delay: -0.16666666666666666s;
                      background: #8d77ff;
                  }.ldio-hncy58lj4t7 div:nth-child(11) {
                       transform: rotate(300deg);
                       animation-delay: -0.08333333333333333s;
                       background: #8d77ff;
                   }.ldio-hncy58lj4t7 div:nth-child(12) {
                        transform: rotate(330deg);
                        animation-delay: 0s;
                        background: #8d77ff;
                    }
        .loadingio-spinner-spinner-97dn2w5f2pq {
            width: 200px;
            height: 200px;
            display: inline-block;
            overflow: hidden;
            background: #F4F8FF;
            margin-top: 50px;
            position: relative;
            left: 7rem;
            top: 5rem;
        }
        .ldio-hncy58lj4t7 {
            width: 100%;
            height: 100%;
            position: relative;
            transform: translateZ(0) scale(1);
            backface-visibility: hidden;
            transform-origin: 0 0; /* see note above */
        }
        .ldio-hncy58lj4t7 div { box-sizing: content-box; }

        .bodyShape {
            position: absolute;
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* IMAGE STYLES */
        .bodyShape + img {
            cursor: pointer;
            height: 102px;
            background: white;
        }

        /* CHECKED STYLES */
        .bodyShape:checked + img {
            outline: 2px solid #8D77FF;

        }

        #applyButton{
            position: relative;
            right: 1rem;
        }
        #downloadButton{
            position: relative;
            right: 1rem;
        }
        p {
            font-family: 'Montserrat', sans-serif;
        }

        label {
            color: #000;
        }

        .box img{
            width: 7rem;
            position: relative;
            top:48px;
        }

        .text{
            margin: 0 auto;
        }

    </style>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <div class="col-md-12">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

{{--        <form method="post" action="{{route('store.webcontent')}}"  enctype="multipart/form-data">--}}
            <form id="web_form" enctype="multipart/form-data">

            <input type="text" class="form-control input1" placeholder="Enter Title" name="company_name_or_title" required>

            {{ csrf_field() }}
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Create Website</h4>

                </div>
                <div class="card-body ">
                    @if ($message = Session::get('link'))
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p>{{ $message }}</p>
                    </div>
                    @endif
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        @if ($message = Session::get('error'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <p>{{ $message }}</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                    <div class="row">
                        <div class="col-lg-12">
                        <div class="card mb-3">
                            <div style="height: 45px;" class="card-header" id="headingOne" data-toggle="collapse" data-target="#title">
                            <button type="button" class="btn btn-link heading-button"> Set Title</button>
                            <i style="float: right" class="fa fa-plus angles"></i>
                            </div>
                            <div id="title" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                            <h6 class="mt-3" >Title</h6>
                            <div class="row">
                            <div class="col-md-12">
                            <div class="form-group bmd-form-group is-filled has-label">
                                <input type="text" name="title" class="form-control input-lg input1" required>
                            </div>
                            </div>
                            </div>
                            </div>


                            </div>
                        </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                        <div class="card mb-3">
                            <div style="height: 45px;" class="card-header" id="headingOne" data-toggle="collapse" data-target="#content">
                            <button type="button" class="btn btn-link heading-button"  > Set HomePage</button>
                            <i style="float: right" class="fa fa-plus angles"></i>
                            </div>
                            <div id="content" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                            <h6 class="mt-3" >Content</h6>
                            <div class="row">
                            <div class="col-md-12">
                            <div class="form-group bmd-form-group is-filled has-label">
                                <textarea id="editor" name="home"></textarea>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                        <div class="card mb-1">
                            <div style="height: 45px;" class="card-header" id="headingOne" data-toggle="collapse" data-target="#bgcolors">
                            <button type="button" class="btn btn-link heading-button"> Set Colors</button>
                            <i style="float: right" class="fa fa-plus angles"></i>
                            </div>
                            <div id="bgcolors" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                            <div class="row">
                            <div class="col-md-2">
                            <label>Body Background</label>
                            <div id="cp3" class="input-group colorpicker-component" title="Using color option">
                            <input name="bg_color" value="#ffffff" type="color" class="form-control input-lg" required/>
                            <span class="input-group-append">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span></span>
                            </div>
                            </div>
                            <div class="col-md-2">
                            <label>Header</label>
                            <div id="cp3" class="input-group colorpicker-component" title="Using color option">
                            <input name="header_color" value="#ffffff" type="color" class="form-control input-lg" required/>
                            <span class="input-group-append">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span></span>
                            </div>
                            </div>
                            <div class="col-md-2">
                            <label>Button Color</label>
                            <div id="cp3" class="input-group colorpicker-component" title="Using color option">
                            <input name="btn_color" value="#ffffff" type="color" class="form-control input-lg" required/>
                            <span class="input-group-append">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span></span>
                            </div>
                            </div>
                            <div class="col-md-2">
                            <label>Button Text Color</label>
                            <div id="cp3" class="input-group colorpicker-component" title="Using color option">
                            <input name="btn_txt_color" value="#000" type="color" class="form-control input-lg" required/>
                            <span class="input-group-append">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span></span>
                            </div>
                            </div>
                            <div class="col-md-2">
                            <label>Headings Text Color</label>
                            <div id="cp3" class="input-group colorpicker-component" title="Using color option">
                            <input name="heading_color" value="#000" type="color" class="form-control input-lg" required/>
                            <span class="input-group-append">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span></span>
                            </div>
                            </div>
                            <div class="col-md-2">
                            <label>Footer Color</label>
                            <div id="cp3" class="input-group colorpicker-component" title="Using color option">
                            <input name="footer_bgcolor" value="#000" type="color" class="form-control input-lg" required/>
                            <span class="input-group-append">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span></span>
                            </div>
                            </div>
                            <div class="col-md-2">
                            <label>Footer Text Color</label>
                            <div id="cp3" class="input-group colorpicker-component" title="Using color option">
                            <input name="footer_txt_color" value="#ffffff" type="color" class="form-control input-lg" required/>
                            <span class="input-group-append">
                            <span class="input-group-text colorpicker-input-addon"><i></i></span></span>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                        <div class="card mb-1">
                            <div style="height: 45px;" class="card-header" id="headingOne" data-toggle="collapse" data-target="#social">
                            <button type="button" class="btn btn-link heading-button"  > Set Social Links</button>
                            <i style="float: right" class="fa fa-plus angles"></i>
                            </div>
                            <div id="social" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                            <div class="row">
                            <div class="col-md-12">
                            <div class="form-group bmd-form-group is-filled has-label">
                            <input type="text" name="fb_link" id="fb_link" class="form-control input-lg" placeholder="Facebook Link" required>
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group bmd-form-group is-filled has-label">
                            <input type="text" name="insta_link" id="insta_link" class="form-control input-lg" placeholder="Instagram Link" required>
                            </div>
                            </div>
                            <div class="col-md-12">
                            <div class="form-group bmd-form-group is-filled has-label">
                            <input type="text" name="twitter_link" id="twitter_link" class="form-control input-lg" placeholder="Twitter Link" required>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12">
                        <div class="card mb-3">
                            <div style="height: 45px;" class="card-header" id="headingOne" data-toggle="collapse" data-target="#gallery">
                            <button type="button" class="btn btn-link heading-button"> Add Gallery Images</button>
                            <i style="float: right" class="fa fa-plus angles"></i>
                            </div>
                            <div id="gallery" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                            <h6 class="mt-3" >Add Images</h6>
                            <div class="row">
                            <div class="col-lg-12"><br>
                            <div class="mb-3 text-center">
                                 <div class="preview"></div>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="files[]" class="custom-file-input" accept=".jpg, .png" id="multiImg" multiple="multiple">
                                <label class="custom-file-label" for="images">Select File</label>
                            </div>
                            </div>
                             </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                        <div class="card mb-3">
                            <div style="height: 45px;" class="card-header" id="headingOne" data-toggle="collapse" data-target="#contact">
                            <button type="button" class="btn btn-link heading-button"> Contact Information</button>
                            <i style="float: right" class="fa fa-plus angles"></i>
                            </div>
                            <div id="contact" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                            <div class="card-body">
                            <h6 class="mt-3" >Add Contact information</h6>
                            <div class="row">
                            <div class="col-md-12 " >
                            <div class="input-group" title="Address">
                            <input name="address" class="form-control" id="origin-input" placeholder="Address" autocomplete="on" required>
                            <input type="hidden" name="latitude"  id="origin_latitude">
                            <input type="hidden" name="longitude" id="origin_longitude">
                            <div class="map-responsive" hidden="">
                            <div id="map" style="width: 100%; height: 450px;"></div>
                            </div>
                            <span class="input-group-append">
                            </span>
                            </div>
                            </div>
                            </div><br>

                            <div class="row">
                            <div class="col-lg-12">
                            <div class="input-group" title="Email">
                            <input name="email" placeholder="Add Email" type="email" class="form-control input-lg" required/>
                            <span class="input-group-append"></span>
                            </div>
                            </div>
                            </div><br>

                            <div class="row">
                            <div class="col-lg-12">
                            <div class="input-group" title="Phone">
                            <input id="" name="phone" placeholder="Add Phone Number" type="number" class="form-control input-lg" required/>
                            <span class="input-group-append"></span>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                            </div>
                        </div>
                    </div>
                <input type="submit" class="btn btn-primary" value="Save">
{{--                <div class="card-footer ml-auto mr-auto">--}}
{{--                    <button type="submit" class="btn btn-primary">Save<div class="ripple-container"></div></button>--}}
{{--                </div>--}}
            </div>
        </form>
    </div>

<script  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzf7KnzVx3iLASRh25OP_bYgTpUD-dIW8&libraries=places"></script>
<script type="text/javascript">
 function initialize() {
          var input = document.getElementById('origin-input');
          var autocomplete = new google.maps.places.Autocomplete(input);

            google.maps.event.addListener(autocomplete, 'place_changed', function () {
                var place = autocomplete.getPlace();
                //document.getElementById('city2').value = place.name;
                document.getElementById('origin_latitude').value = place.geometry.location.lat();
                document.getElementById('origin_longitude').value = place.geometry.location.lng();
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
</script>
<script src="//cdn.ckeditor.com/4.16.1/full/ckeditor.js"></script>

<script>
CKEDITOR.replace( 'editor' );
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script>
    $(function() {
        var imgPrev = function(input, imgPlaceholder) {

            if (input.files) {
                var allFiles = input.files.length;

                for (i = 0; i < allFiles; i++) {
                    var reader = new FileReader();

                    reader.onload = function(event) {
                        $($.parseHTML('<img >')).attr('src', event.target.result).appendTo(imgPlaceholder);
                    }

                    reader.readAsDataURL(input.files[i]);
                }
            }
        };

        $('#multiImg').on('change', function() {
            imgPrev(this, 'div.preview');
        });
    });

    // $('.input1').bind('keyup blur',function(){
    //     var node = $(this);
    //     node.val(node.val().replace(/[^a-z ]/g,'') ); }
    //
    // );

    $(".input1").keydown(function(event){
        var userGetData = event.which;
        // allow letters and whitespaces only.
        if(!(userGetData >= 65 && userGetData <= 120) && (userGetData != 32 && userGetData != 0)) {
            event.preventDefault();
        }
    });

    $('#web_form').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url:"/store/web-content",
            method:"POST",
            data:$('#web_form').serialize(),
            success:function(data)
            {
                // $('#web_form')[0].reset();
            }
        });
    });

    </script>
@endsection







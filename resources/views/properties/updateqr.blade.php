@extends('layouts.admin_layout')
@section('title')
    Properties

@endsection

@section('content')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/css/bootstrap-colorpicker.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/checkout/">
    <link rel="stylesheet" href="https://qrcodegenerator.ioptime.com//public/js/basic.css">

    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->

    <!-- Material Design Bootstrap -->
    <link rel="stylesheet" href="https://qrcodegenerator.ioptime.com/public/assets/css/mdb.min.css">
    <!-- Your custom styles (optional) -->
    <link rel="stylesheet" href="https://qrcodegenerator.ioptime.com/public/assets/css/style.css">

    <link rel="stylesheet" href="https://qrcodegenerator.ioptime.com/public/plugin/fancy_fileupload.css">
    <style>

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
            bottom: 19px;
            right: 70px;
            font-size: 15px;
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





        .box img{
            width: 7rem;
            position: relative;
            top:48px;
        }

        .text{
            margin: 0 auto;
        }

    </style>

    <div class="col-md-12">


        <form method="post" action="{{route('properties.store')}}" id="RegisterValidation" enctype="multipart/form-data">

            {{ csrf_field() }}
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Generate Custom Qrcode</h4>

                </div>
                <div class="card-body ">
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
                        @if(isset($qrcodeData)&&$qrcodeData>0)
                            <div class="alert alert-warning mt-4">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <p>Note : On generating new qrcodes,previous qrcodes will be replaced for this property !</p>

                            </div>
                        @endif


                    <div class="col-md-12 pb-5">

                        <div class="row pb-5">
                            <div class="col-md-6 pb-5" style="background: #F4F8FF;border-radius: 5px 5px 5px 5px">

                                <h3 id="main-heading">Update Qr Code Layout</h3>
                                @if (Session::has('success'))
                                    <div class="alert alert-success">
                                        <ul>
                                            <li>{{ Session::get('success') }}</li>
                                        </ul>
                                    </div>
                                @endif
                                <div class="bs-example">
                                    <div class="accordion" id="accordionExample">

                                        {{--Company Logo--}}

                                        <div class="card mb-3" style="display: none;">
                                                <div style="height: 45px;" class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree">
                                                    <i style="background: #F4F8FF;" id="icon-1" class="fas fa-image fa-1x p-3 mr-4 float-left black-text icon" aria-hidden="true"></i>

                                                    <button type="button" class="btn btn-link heading-button"> Company Logo </button>
                                                    <i style="float: right" class="fa fa-plus angles"></i>

                                                </div>
                                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <form method="post" action="/fileuploader2" enctype="multipart/form-data">

                                                            <input id="logo-image" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png">

                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        {{--Enter your text  Form--}}
                                        <form id="text-setting" style="display: none;">
                                            {{--Enter your text --}}
                                        <div class="card mb-3">
                                            <div style="height: 45px;" class="card-header" id="headingFour" data-toggle="collapse" data-target="#collapseFour">
                                                <i style="background: #F4F8FF;" id="icon-1" class="fas fa-pen fa-1x p-3 mr-4 float-left black-text icon" aria-hidden="true"></i>

                                                <button type="button" class="btn btn-link heading-button">Enter Your Text </button>
                                                <i style="float: right" class="fa fa-plus angles"></i>

                                            </div>
                                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                                <div class="card-body">

                                                    <h6 class="mt-3" >TEXT 1</h6>

                                                    <div class="row">

                                                        <div class="col-md-12">
                                                            <div  class="input-group" title="Using color option">
                                                                <input  name="textLine1"  maxlength="40"  type="text" placeholder="Your Text here" class="form-control input-lg"/>

  </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                        <h6 class="mt-3" >TEXT 2</h6>
                                                    <div class="row">
                                                        <div class="col-md-12 " >
                                                            <div class="input-group" title="Using color option">
                                                                <input  name="textLine2"  maxlength="40"  type="text" placeholder="Scan this!" class="form-control input-lg"/>

                                                                </span>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <h6 class="mt-3" >Text Color</h6>
                                                    <div class="row">

                                                        <div class="col-md-12 " >
                                                            <div id="cp2" class="input-group" title="Using color option">
                                                                <input  name="textColor"  type="text" class="form-control input-lg"/>
                                                                <span class="input-group-append">
    <span class="input-group-text colorpicker-input-addon"><i></i></span>
  </span>
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>
                                            </div>
                                        </div>

                                        </form>

                                        {{--Qr settings--}}
                                        <div class="card mb-3">
                                                <div style="height: 45px;" class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne">
                                                    <i style="background: #F4F8FF;" id="icon-1" class="fas fa-cogs fa-1x p-3 mr-4 float-left black-text icon" aria-hidden="true"></i>

                                                    <button type="button" class="btn btn-link heading-button"  > Qr Settings </button>
                                                    <i style="float: right" class="fa fa-plus angles"></i>

                                                </div>
                                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <form id="qr-setting">

                                                        <h6 class="mt-3" >Foreground Color</h6>
                                                        <div class="row">

                                                            <div class="col-md-12 " >
                                                                <div id="cp1" class="input-group" title="Using color option">
                                                                    <input id="foreground-1st-color" name="foregroundOne"  type="text" class="form-control input-lg"/>
                                                                    <span class="input-group-append">
                                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                                  </span>
                                                                </div>
                                                            </div>

                                                        </div>

                                                        <div class="row mt-2">




                                                        </div>

                                                        <h6 class="mt-3">Background Color</h6>
                                                        <div class="row">

                                                            <div class="col-md-12">
                                                                <div id="cp6" class="input-group" title="Using color option">
                                                                    <input id="background-color" name="background" type="text" class="form-control input-lg"/>
                                                                    <span class="input-group-append">
                                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                                          </span>
                                                                </div>
                                                            </div>


                                                        </div>

                                                        </form>
                                                        <h6 class="mt-3">Qrcode Logo</h6>
                                                         <div class="row">
                                                             <div class="col-md-12">
                                                        <form method="post" action="/fileuploader2" enctype="multipart/form-data">

                                                            <input id="demo-image" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png">

                                                            <div class="form-check-inline mt-3">
                                                                <label class="form-check-label">
                                                                    <input type="checkbox" id="eye-checkbox"  class="form-check-input" value="" >Remove background from image
                                                                </label>

                                                            </div>

                                                        </form>
                                                             </div>
                                                         </div>




                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                             <br>
                                             <input type='hidden' class="plain" value="0" style="width: 18px;">
                                             <input @if($data->is_plain_text) checked @endif type='checkbox' class="plain" onchange="plainchanged()" value="1" name="" style="width: 18px;">
                                             <label>Plain Text</label>

                                             <input type='hidden' class="add" value="0" style="width: 18px;">
                                             <input @if($data->is_address) checked @endif type='checkbox' class="add" onchange="addressChanged()" value="1" name="" style="width: 18px;">
                                             <label>Address</label>

                                             <input type='hidden' class="web" value="0" style="width: 18px;">
                                             <input @if($data->is_web) checked @endif type='checkbox' class="web" onchange="webChanged()" value="1" name="" style="width: 18px;">
                                             <label>Website</label>
                                            </div>

                                            <div class="card mb-3 plaintxt" style="display: none;">
                                                <div style="height: 45px;" class="card-header" id="headingOne" data-toggle="collapse" data-target="#plaintext">
                                                    <i style="background: #F4F8FF;" id="icon-1" class="fas fa-cogs fa-1x p-3 mr-4 float-left black-text icon" aria-hidden="true"></i>
                                                    <button type="button" class="btn btn-link heading-button"  > Set Text</button>
                                                    <i style="float: right" class="fa fa-plus angles"></i>
                                                </div>
                                                <div id="plaintext"  aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <form id="plain-text">
                                                         <h6 class="mt-3" >Plain Text</h6>
                                                        <div class="row">
                                                            <div class="col-md-12 " >
                                                                <div class="input-group" title="Plain Text">
                                                                    <input @if($data->is_plain_text) value="{{$data->web_link}}" @endif id="plaintexts" name="plaintext"  type="text" class="form-control input-lg"/>
                                                                    <span class="input-group-append">
                                                                  </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card mb-3 location" style="display: none;">
                                                <div style="height: 45px;" class="card-header" id="headingOne" data-toggle="collapse" data-target="#address">
                                                    <i style="background: #F4F8FF;" id="icon-1" class="fas fa-cogs fa-1x p-3 mr-4 float-left black-text icon" aria-hidden="true"></i>

                                                    <button type="button" class="btn btn-link heading-button"  > Set Address</button>
                                                    <i style="float: right" class="fa fa-plus angles"></i>
                                                </div>
                                                <div id="address"  aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <form id="location-address">
                                                         <h6 class="mt-3" >Address</h6>
                                                        <div class="row">
                                                            <div class="col-md-12 " >
                                                                <div class="input-group" title="Address">
                                                                    <input @if($data->is_address) value="{{$data->web_link}}" @endif name="address" class="form-control" required id="origin-input" placeholder="Address" autocomplete="on">
                                                                    <input type="hidden" name="latitude" id="origin_latitude">
                                                                    <input type="hidden" name="longitude" id="origin_longitude">
                                                                    <div class="map-responsive" hidden="">
                                                                    <div id="map" style="width: 100%; height: 450px;"></div>
                                                                    </div>
                                                                    <span class="input-group-append">
                                                                  </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="card mb-3 site" style="display: none;">
                                                <div style="height: 45px;" class="card-header" id="headingOne" data-toggle="collapse" data-target="#website">
                                                    <i style="background: #F4F8FF;" id="icon-1" class="fas fa-cogs fa-1x p-3 mr-4 float-left black-text icon" aria-hidden="true"></i>
                                                    <button type="button" class="btn btn-link heading-button"  > Set Website</button>
                                                    <i style="float: right" class="fa fa-plus angles"></i>
                                                </div>
                                                <div id="website"  aria-labelledby="headingOne" data-parent="#accordionExample">
                                                    <div class="card-body">
                                                        <form id="website-link">
                                                         <h6 class="mt-3" >Website Link</h6>
                                                         <div class="row">
                                                            <div class="col-md-12 " >
                                                                <div class="input-group" title="Add Link">

                                                                    <input id="web_link" @if($data->is_web) value="{{$data->web_link}}" @endif name="web_link"  type="text" class="form-control input-lg"/>
                                                                    <input style="display: none;" type="text" name="web_id" value="{{ request()->query('id') }}">
                                                                    <span class="input-group-append">
                                                                  </span>
                                                                </div>
                                                            </div>
                                                         </div>
{{--                                                         <h6 class="mt-3" >Or</h6>--}}
{{--                                                         <div class="row">--}}
{{--                                                            <div class="col-md-12 " >--}}
{{--                                                                <div class="input-group" title="Add Link">--}}
{{--                                                                    <a href="{{route('custom.web')}}" class="btn btn-info btn-md">Create Website</a>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
{{--                                                         </div>--}}
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                        {{--Website Link--}}
                                        <form id="add-link" style="display: none;">
                                        <div class="card mb-3">
                                            <div style="height: 45px;" class="card-header" id="headingFive" data-toggle="collapse" data-target="#collapseFive">
                                                <i style="background: #F4F8FF;" id="icon-1" class="fas fa-link fa-1x p-3 mr-4 float-left black-text icon" aria-hidden="true"></i>

                                                <button type="button" class="btn btn-link heading-button">Bottom Text</button>
                                                <i style="float: right" class="fa fa-plus angles"></i>

                                            </div>
                                            <div id="collapseFive" class="collapse" aria-labelledby="headingFour" data-parent="#accordionExample">
                                                <div class="card-body">

                                                    <div class="form-check-inline mt-3">
                                                        <label class="form-check-label">
                                                            <input type="checkbox" id="link"  class="form-check-input" value="" checked>Show Web link
                                                        </label>

                                                    </div>

                                                    <h6 class="mt-3" >Title</h6>

                                                    <div class="col-md-12">


                                                        <div  class="input-group" title="Using color option">
                                                            <input  name="title"    type="url" placeholder="Visit US" class="form-control input-lg"/>

                                                            </span>
                                                        </div>
                                                    </div>

                                                    <h6 class="mt-3" >Text</h6>

                                                    <div class="col-md-12">


                                                        <div  class="input-group" title="Using color option">
                                                            <input  name="link"    type="url" placeholder="www.example.com" class="form-control input-lg"/>

                                                            </span>
                                                        </div>
                                                    </div>
                                                    <h6 class="mt-3" >Text Color</h6>
                                                    <div class="row">

                                                        <div class="col-md-12 " >
                                                            <div id="cp3" class="input-group" title="Using color option">
                                                                <input  name="linkcolor"  type="text" class="form-control input-lg"/>
                                                                <span class="input-group-append">
    <span class="input-group-text colorpicker-input-addon"><i></i></span>
  </span>
                                                            </div>
                                                        </div>

                                                    </div>





                                                </div>
                                            </div>
                                        </div>
                                        <div class="card mb-3">
                                            <div style="height: 45px;" class="card-header" id="headingSix" data-toggle="collapse" data-target="#collapseSix">
                                                <i style="background: #F4F8FF;" id="icon-1" class="fas fa-paint-brush fa-1x p-3 mr-4 float-left black-text icon" aria-hidden="true"></i>

                                                <button type="button" class="btn btn-link heading-button">Background Color</button>
                                                <i style="float: right" class="fa fa-plus angles"></i>

                                            </div>
                                            <div id="collapseSix" class="collapse" aria-labelledby="headingSix" data-parent="#accordionExample">
                                                <div class="card-body">

                                                    <div class="row">

                                                        <div class="col-md-12 " >
                                                            <div id="cp5" class="input-group" title="Using color option">
                                                                <input id="foreground-1st-color" name="Adbackground"  type="text" class="form-control input-lg"/>
                                                                <span class="input-group-append">
                                                                    <span class="input-group-text colorpicker-input-addon"><i></i></span>
                                                                  </span>
                                                            </div>
                                                        </div>

                                                    </div>


                                                </div>
                                            </div>
                                        </div>
                                        </form>


                                     @if(isset($id))
                                            <button type="button" class="btn btn-success mt-4 mb-2 btn-lg btn-block apply-button" id="applyButton" onclick="generateQr()">Apply</button>
                                        <form method="post" action="/downloadQrcode2">
                                            @csrf
                                            <input type="hidden" value="{{$id}}" name="property">
                                            <button  onclick="hideButton()" value="Download" id="downloadButton" type="submit" class="btn btn-primary mt-3 mb-2 btn-lg btn-block apply-button" disabled>Save & Download</button>

                                        </form>

                                        @else
                                            <button type="button" class="btn btn-success mt-4 mb-2 btn-lg btn-block apply-button" id="applyButton" onclick="generateQr()">Apply Changes</button>

                                          <!--    <a  href="/properties/create" onclick="hideButton()" id="downloadButton" type="submit" class="btn btn-primary mt-3 mb-2 btn-lg btn-block apply-button" disabled>Setup Property</a> -->

                                         @endif

   <form method="post" action="{{route('download.updateqr',request()->route('id'))}}">
                                            @csrf
                                            <input type="hidden" value="{{session()->get('property')}}" name="property">
                                            <button  value="Download" style="display: none;" id="downloadButton" type="submit" class="btn btn-primary mt-3 mb-2 btn-lg btn-block apply-button btn_update_qr" >Update</button>

                                        </form>


                                    </div>
                                </div>


    </div>


    <div class="col-md-6" id="qrCodeDiv">


        <div style=" position: absolute;
            z-index: 99999;
            width: 80%;
            text-align: center;
            font-size: 1.5em;
            color: #fff;
            line-height: 1.5;
            background: #f4f8ff;" class=" col-md-12">
            <div class="row" >
                <div class="box text col-md-6">

                    <img class="d-block mx-auto " style="display: none;" src="{{asset('/public/logimage.png')}}"  alt="" >


                </div>
            </div>

            <div class="row"  style="margin-top: 5rem;display: none;">
                <div class="text col-md-12">

                    <h3 style="text-align:center;font-weight: 600;font-size:39px; ">Your text here..</h3>
                    <h3 style="text-align:center;font-weight: 600;font-size:39px;bottom: 1.5rem;position: relative; ">Scan this !</h3>

                </div>

            </div>

            <div class="row">
                <div class=" text col-md-8 ">
                    <img class="d-block mx-auto" height="200" src="/public/qrcodeimage6.png"  alt="" >

                </div>

            </div>
            <div  class="row" style="padding: 10px">

            </div>
            <div class="row mt-5" style="display: none;">
                <div class=" text col-md-6 ">
                    <h5 style="font-weight: 800;">Visit us @</h5>
                    <small style="    position: relative;
    font-weight: 100;

    bottom: 20px;    font-size: 1vw;">www.example.com</small>

                </div>

            </div>

        </div>


    </div>



    </div>
                    </div>




    </div>

    </div>





@endsection

@section('scripts')

    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="https://qrcodegenerator.ioptime.com/public/assets/js/mdb.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/js/bootstrap-colorpicker.js"></script>

    <script src="https://qrcodegenerator.ioptime.com/public/plugin/jquery.ui.widget.js"></script>
    <script src="https://qrcodegenerator.ioptime.com/public/plugin/jquery.fileupload.js"></script>
    <script src="https://qrcodegenerator.ioptime.com/public/plugin/jquery.iframe-transport.js"></script>
    <script src="https://qrcodegenerator.ioptime.com/public/plugin/jquery.fancy-fileupload.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js"></script>

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

<script type="text/javascript">

$('input[type="checkbox"]').on('change', function() {
   $('input[type="checkbox"]').not(this).prop('checked', false);
});

	function plainchanged()
    {

        if($('.plain').is(":checked"))
            $(".plaintxt").show();

        else
            $(".plaintxt").hide();
            $(".location").hide();
            $(".site").hide();
    }

    function addressChanged()
    {

        if($('.add').is(":checked"))
            $(".location").show();

        else
            $(".location").hide();
            $(".plaintxt").hide();
            $(".site").hide();
    }

    function webChanged()
    {

        if($('.web').is(":checked"))
            $(".site").show();

        else
            $(".site").hide();
            $(".location").hide();
            $(".plaintxt").hide();
    }

</script>
    <script>






        $(function() {
            $('.cp2').colorpicker({
                    color: '#AA3399',

                }


            );
            $('#cp1').colorpicker(
                {"color": "#000000",format: "rgb"}
            );
            $('#cp2').colorpicker(
                {"color": "#ffffff",format: "rgb"}
            );
            $('#cp3').colorpicker(
                {"color": "#ffffff",format: "rgb"}
            );
            $('#cp4').colorpicker(
                {"color": "#ffffff",format: "rgb"}
            );
            $('#cp5').colorpicker(
                {"color": "#f4f8ff",format: "rgb"}
            );
            $('#cp6').colorpicker(
                {"color": "#ffffff",format: "rgb"}
            );
        });
        $('#results').click(function (){
            alert("clicked");
        });
    </script>

    <script>
        $(document).ready(function() {

            if($('.plain').is(':checked')){

                    $(".plaintxt").show();

                // $(".location").hide();
                // $(".site").hide();

            }
            if($('.add').is(':checked')){
                $(".location").show();
            }
            if($('.web').is(':checked')){
                $(".site").show();
            }

            // Add minus icon for collapse element which is open by default
            $(".collapse.show").each(function () {
                $(this).prev(".card-header").find(".fa").addClass("fa-angle-up").removeClass("fa-angle-down");

            });


            $("#my-awesome-dropzone").dropzone({url: "/file/post"});

            // Toggle plus minus icon on show hide of collapse element
            $(".collapse").on('show.bs.collapse', function () {
                $(this).prev(".card-header").find(".fa").removeClass("fa-angle-down").addClass("fa-angle-up");
                $(this).prev(".card-header").css('background', '#F0EEFF');
                $(this).prev(".card-header").find(".icon").css('background', '#8D77FF');
                $(this).prev(".card-header").find(".icon").addClass('white-text');
                $(this).prev(".card-header").find(".icon").removeClass('black-text');


            }).on('hide.bs.collapse', function () {
                $(this).prev(".card-header").find(".fa").removeClass("fa-angle-up").addClass("fa-angle-down");
                $(this).prev(".card-header").css('background', 'white');
                $(this).prev(".card-header").find(".icon").css('background', '#F4F8FF');
                $(this).prev(".card-header").find(".icon").removeClass('white-text');
                $(this).prev(".card-header").find(".icon").addClass('black-text');

            });






        });
    </script>
    <script>
        $('input[type="checkbox"]').click(function(){
            if($(this).prop("checked") == true){
                $('.eye-section').fadeIn(800);
            }
            else if($(this).prop("checked") == false){
                $('.eye-section').fadeOut(800);
            }
        });

        function showDiv(id) {

            if(id=='double'){
                $('.color-gradient-section').fadeIn(800)
            }else{
                $('.color-gradient-section').fadeOut(800)

            }

        }


        function generateQr() {

            var form = $('#qr-setting').serializeArray();
            var form2 = $('#text-setting').serializeArray();
            var form3 = $('#add-link').serializeArray();
            var form4 = $('#plain-text').serializeArray();
            var form5 = $('#location-address').serializeArray();
            var form6 = $('#website-link').serializeArray();

            let eye=0;
            if($('#eye-checkbox').prop("checked") == true){
                eye=1;
            }

            let link=0;
            if($('#link').prop("checked") == true){
                link=1;
            }

            // $('#downloadButton').show();
            $('#downloadButton').prop('disabled', false);




            $('#qrCodeDiv').html('<div class="loadingio-spinner-spinner-97dn2w5f2pq"><div class="ldio-hncy58lj4t7">\n' +
                '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>\n' +
                '</div></div>');


            $('#applyButton').attr('disables',true);



            var p=$('#property_id').val();
            var property=0;
            if(p != '' && p != undefined ){
                property=p;
            }

            jQuery.ajax({
                url: '/generateQr2',
                method: 'post',
                data:{'form':form,'form2':form2,'form3':form3,'form4':form4,'form5':form5,'form6':form6,'eye':eye,'link':link,'property':property,"_token": "{{ csrf_token() }}"},

                success: function(result,xhr){

                    console.log(xhr)

                    if(xhr=='success'){

                        $('#qrCodeDiv').html(result);
                        $('#applyButton').attr('disables',false);
                    }else{
                        $('#qrCodeDiv').html('');
                        $('#applyButton').attr('disables',true);

                    }

            $('.btn_update_qr').css('display', 'block');

                }});
        }

    </script>

    <script>
        $('#demo-image').FancyFileUpload({
            params : {
                action : 'fileuploader'
            },
            retries : 1,
            url:'/fileuploader2',
            accept : ['png','jpg'] ,
            'uploadcancelled' : function(e, data) {

            },

            // uploadcompleted : function(e, data) {
            //     data.ff_info.RemoveFile();
            // },


            maxfilesize : 1000000
        });
    </script>
        <script>


            $('#logo-image').FancyFileUpload({
                params : {
                    action : 'fileuploaderlogo'
                },
                url:'/fileuploaderlogo2',
                retries : 1,
                accept : ['png','jpg'] ,
                'uploadcancelled' : function(e, data) {

                },

                // uploadcompleted : function(e, data) {
                //     data.ff_info.RemoveFile();
                // },


                // maxfilesize : 1000000
            });
        </script>

    <script>
        $( ".ff_fileupload_remove_file" ).click(function() {
            alert( "Handler for .click() called." );
        });
    </script>

    <script>

        function getRooms() {



            var floors=$('#floors').val();

            var field='';
            $('#roomsFeilds').empty();
            for(var i=1 ; i<=floors ;i++ ){
                field='<div class="md-form md-outline">\n' +
                    '                          <input type="number" name="rooms[]" id="inputValidationEx'+i+'" class="form-control validate" required>\n' +
                    '                          <label for="inputValidationEx'+i+'" data-error="wrong" data-success="right" class="">Add no of rooms for floor '+i+'</label>\n' +
                    '                      </div>';


                $('#roomsFeilds').append(field)

            }
        }



        function showRange() {
            // console.log($('#size').val());
            $('#valBox').text($('#size').val()+' px');
        }


    </script>
@endsection














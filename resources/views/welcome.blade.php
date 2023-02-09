<!doctype html>
<html lang="en">
<head>

    @if(Session::has('downloadFile'))
        <meta http-equiv="refresh" content="5;url={{ Session::get('downloadFile') }}">

        {{ Session::forget('downloadFile') }}
    @endif
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.0.1">
    <title>Qr Generator</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/css/bootstrap-colorpicker.css">
    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/checkout/">
    <link rel="stylesheet" href="https://qrcodegenerator.ioptime.com//public/js/basic.css">

    <link rel="icon" href="img/mdb-favicon.ico" type="image/x-icon">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://qrcodegenerator.ioptime.com/public/assets/css/bootstrap.min.css">
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
            background: #ffffff;
            margin-top: 50px;
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




    </style>
    <!-- Custom styles for this template -->
    <link href="form-validation.css" rel="stylesheet">
</head>
<body class="bg-light" style="background-image: url('/public/img/wizard-v10-bg.jpg');color: #797979;background-repeat: no-repeat;
    height: 100%;
    background-size: cover;
}">


<div class="container mt-5 main-div">
    <div class="col-md-12 pb-5">







        <div class="row pb-5">
            <div class="col-md-8 pb-5" style="background: #F4F8FF;border-radius: 5px 5px 5px 5px">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success mt-4">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p>{{ $message }}</p>

                    </div>
                @endif
                  @if($qrcodeData>0)
                    <div class="alert alert-warning mt-4">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <p>Note : On generating new qrcodes,previous qrcodes will be replaced for this property !</p>

                    </div>
                    @endif


                <h3 id="main-heading">Setup Qr Code Layout</h3>
                <div class="bs-example">
                    <div class="accordion" id="accordionExample">
                        <form id="form">
                            <div class="card mb-3">
                                <div style="height: 45px;" class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne">
                                    <i style="background: #F4F8FF;" id="icon-1" class="fas fa-paint-brush fa-1x p-3 mr-4 float-left black-text icon" aria-hidden="true"></i>

                                    <button type="button" class="btn btn-link heading-button"  > Select Color </button>
                                    <i style="float: right" class="fa fa-angle-down angles"></i>

                                </div>
                                <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                    <div class="card-body">
{{--                                        <div class="form-check form-check-inline">--}}
{{--                                            <label class=" form-check-label">--}}
{{--                                                <input type="radio" name="colorOption" value="single" id="materialInline3" onchange="showDiv('single')" class="form-check-input"  checked>Single color--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
                                        {{--                                          <div class="form-check-inline">--}}
                                        {{--                                              <label class="form-check-label">--}}
                                        {{--                                                  <input type="radio" name="colorOption" value="double" class="form-check-input" onchange="showDiv('double')" name="optradio">Color Gradient--}}
                                        {{--                                              </label>--}}
                                        {{--                                          </div>--}}

                                        <h6 class="mt-3" >Foreground Color</h6>
                                        <div class="row">

                                            <div class="col-md-6 " >
                                                <div id="cp1" class="input-group" title="Using color option">
                                                    <input id="foreground-1st-color" name="foregroundOne"  type="text" class="form-control input-lg"/>
                                                    <span class="input-group-append">
    <span class="input-group-text colorpicker-input-addon"><i></i></span>
  </span>
                                                </div>
                                            </div>
                                            {{--                                              <span id="color-gradient-section" style="display: none">--}}


                                            {{--                                              </span>--}}
                                        </div>

                                        <div class="row mt-2">




                                        </div>

                                        <h6 class="mt-3">Background Color</h6>
                                        <div class="row">

                                            <div class="col-md-6">
                                                <div id="cp6" class="input-group" title="Using color option">
                                                    <input id="background-color" name="background" type="text" class="form-control input-lg"/>
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
                                <div style="height: 45px;" class="card-header" id="headingThree" data-toggle="collapse" data-target="#collapseThree">
                                    <i style="background: #F4F8FF;" class="fas fa-pen fa-1x p-3 mr-4 float-left black-text icon" aria-hidden="true"></i>


                                    <button type="button" class="btn btn-link collapsed heading-button" > Label Setting</button>
                                    <i style="float: right" class="fa fa-angle-down angles"></i>

                                </div>
                                <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordionExample">
                                    <div class="card-body">

                                        <div class="md-form md-outline">
                                            <input type="text" maxlength="25" id="label"  name="label" class="form-control validate">
                                            <label for="label" data-error="wrong" data-success="right">Label Text</label>
                                        </div>
                                        <h5>Margin</h5>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <input type="number" placeholder="Bottom"  id="bottom"  name="bottom" class="form-control validate">
                                            </div>
                                            <div class="col-md-6">
                                                <input type="number"  placeholder="Top" id="top"  name="top" class="form-control validate">
                                            </div>

                                        </div>
                                        <h5 class="mt-3">Alignment</h5>
                                        <label class="radio-inline">
                                            <input type="radio" value="center" name="optradio" checked> Center
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" value="left" name="optradio"> Left
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" value="right" name="optradio"> Right
                                        </label>

                                        <input type="hidden" name="property_id" value="{{$id}}">


                                    </div>
                                </div>
                            </div>

                        </form>

                        <form method="post" action="/fileuploader" enctype="multipart/form-data">

                            <div class="card mb-3">
                                <div style="height: 45px;" class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo">
                                    <i style="background: #F4F8FF;" class="fas fa-image fa-1x p-3 mr-4 float-left black-text icon" aria-hidden="true"></i>


                                    <button type="button" class="btn btn-link collapsed heading-button" > Upload Logo</button>
                                    <i style="float: right" class="fa fa-angle-down angles"></i>

                                </div>
                                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                    <div class="card-body">

                                        <input id="demo-image" type="file" name="files" accept=".jpg, .png, image/jpeg, image/png">

                                        <div class="form-check-inline mt-3">
                                            <label class="form-check-label">
                                                <input type="checkbox" id="eye-checkbox"  class="form-check-input" value="" >Remove background from image
                                            </label>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </form>





                        @if (count($errors) > 0)
                            <div class="alert alert-danger alert-dismissible fade show mt-4">
                                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form  method="post" action="/downloadQrcode" >

                            <input type="hidden" name="property" value="{{$id}}">




{{--                            <h3 id="main-heading">Setup Property</h3>--}}

{{--                            <div class="md-form md-outline">--}}
{{--                                <input type="text" id="property" name="property" class="form-control validate" required>--}}
{{--                                <label for="property" data-error="wrong" data-success="right">Property Name</label>--}}
{{--                            </div>--}}
{{--                            <div class="md-form md-outline">--}}
{{--                                <input type="number" id="floors" name="floors" class="form-control validate" required>--}}
{{--                                <label for="floors" data-error="wrong" data-success="right">Add no of floors</label>--}}
{{--                            </div>--}}
{{--                            <button style="position: relative;--}}
{{--    bottom: 31px;" onclick="getRooms()" type="button" class="btn btn-primary">Add rooms</button>--}}

{{--                            <div id="roomsFeilds">--}}

{{--                            </div>--}}
                    </div>
                </div>
                <!-- Grid row -->

            </div>
            <div class="clearfix"></div>
            <div class="col-md-4 qrcode-div pb-5" style="background: white;border-radius: 5px 5px 5px 5px" >
                <div id="qr-img" style="text-align: center;height: 350px;margin-top: 21px; overflow-x: auto;overflow-y: auto">
                    <img class="mt-5" src="/public/qrcode.png"  >
                </div>
                <div class="ml-5 mt-5">
                              <span   style="position: relative;
    top: -23px;
    right: -118px;">Size</span>
                    <span>200</span>
                    <input type="range" onchange="showRange()" id="size" name="size" min="200" max="2000" value="50">
                    <span>2000</span>
                    <span id="valBox" style="position: relative;
    top: 1rem;
    right: 7rem;">200</span>
                </div>


                <button type="button" class="btn btn-success mt-4 mb-2 btn-lg btn-block apply-button" id="applyButton" onclick="generateQr()">Apply</button>
                <button style="display: none"  onclick="hideButton()" id="downloadButton" type="submit" class="btn btn-primary mt-3 mb-2 btn-lg btn-block apply-button">Download</button>

            </div>


        </div>

        @csrf
        </form>
    </div>

</div>

</body>



<script type="text/javascript" src="https://qrcodegenerator.ioptime.com/public/assets/js/jquery.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="https://qrcodegenerator.ioptime.com/public/assets/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="https://qrcodegenerator.ioptime.com/public/assets/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="https://qrcodegenerator.ioptime.com/public/assets/js/mdb.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.2.0/js/bootstrap-colorpicker.js"></script>

<script src="https://qrcodegenerator.ioptime.com/public/plugin/jquery.ui.widget.js"></script>
<script src="https://qrcodegenerator.ioptime.com/public/plugin/jquery.fileupload.js"></script>
<script src="https://qrcodegenerator.ioptime.com/public/plugin/jquery.iframe-transport.js"></script>
<script src="https://qrcodegenerator.ioptime.com/public/plugin/jquery.fancy-fileupload.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-slider/11.0.2/bootstrap-slider.min.js"></script>

<script>






    $(function() {
        $('.cp2').colorpicker({
                color: '#AA3399',

            }


        );
        $('#cp1, #cp2, #cp3 ,#cp4,#cp5').colorpicker(
            {"color": "#000000",format: "rgb"}
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


        let eye=0;
        if($('input[type="checkbox"]').prop("checked") == true){
            eye=1;
        }

        $('#downloadButton').show();


        var form = $('#form').serializeArray();
        $('#qr-img').html('<div class="loadingio-spinner-spinner-97dn2w5f2pq"><div class="ldio-hncy58lj4t7">\n' +
            '<div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div><div></div>\n' +
            '</div></div>');
        $('#applyButton').attr('disables',true);

        jQuery.ajax({
            url: '/generateQr',
            method: 'post',
            data:{'form':form,'eye':eye,"_token": "{{ csrf_token() }}"},

            success: function(result){

                $('#qr-img').html('<img  class="mt-5"  src="'+result+'"  />');
                $('#applyButton').attr('disables',false);

            }});
    }

</script>

<script>
    $('#demo-image').FancyFileUpload({
        params : {
            action : 'fileuploader'
        },
        retries : 1,
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
        $('#valBox').text($('#size').val()+'px');
    }


</script>


</html>

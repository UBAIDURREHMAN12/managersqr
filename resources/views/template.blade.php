<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>template</title>
    <link href="{{asset('/public/vendor/css/material-dashboard.css?v=2.1.2')}}" rel="stylesheet" />
    <link href="{{asset('/public/vendor/demo/demo.css')}}" rel="stylesheet" />
    <link href="{{asset('/fonts/fontawesome-free/css/all.css')}}" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Montserrat|Oswald');
        body {
            margin: 0;
            padding: 0;
            font-family: 'Montserrat', sans-serif;
        }

        h1 {
            font-family: 'Oswald', sans-serif;
        }

        p {
            font-family: 'Montserrat', sans-serif;
        }



        .banner-content {
            position: absolute;
            z-index: 99999;
            top: 55%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%;
            text-align: center;
            font-size: 1.5em;
            color: #fff;
            line-height: 1.5;
            background: #012D52;
        }

        
        .box img{
            width: 11rem;
            position: relative;
            top: 79px;
        }

        .text{
            margin: 0 auto;
        }


    </style>
</head>

<body>



<div class="banner-content col-md-6">
    <div class="row" style="height: 200px">
        <div class="box text col-md-4">

                <img class="d-block mx-auto mb-4 mt-4" src="https://www.google.com/images/branding/googlelogo/1x/googlelogo_color_272x92dp.png"  alt="" >


        </div>
    </div>

    <div class="row">
        <div class="text col-md-6">

             <h1>Your text here</h1>
             <h1>Scan this!</h1>
        </div>

    </div>

    <div class="row">
        <div class=" text col-md-6 ">
            <img class="d-block mx-auto mb-4 mt-4" src="/public/qrcode.png"  alt="" >

        </div>

    </div>
    <div class="row">
        <div class=" text col-md-4 ">
            <h3>Visit Us @</h3>
            <small>www.example.com</small>

        </div>

    </div>

</div>




</body>
</html>

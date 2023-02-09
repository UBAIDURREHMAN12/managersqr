<html>
<head>
    <title>Report email</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        body{margin-top:20px;}
        .mail-seccess {
            text-align: center;
            background: #fff;
            border-top: 1px solid #eee;
        }
        .mail-seccess .success-inner {
            display: inline-block;
        }
        .mail-seccess .success-inner h1 {
            font-size: 100px;
            text-shadow: 3px 5px 2px #3333;
            color: #006DFE;
            font-weight: 700;
        }
        .mail-seccess .success-inner h1 span {
            display: block;
            font-size: 25px;
            color: #333;
            font-weight: 600;
            text-shadow: none;
            margin-top: 20px;
        }
        .mail-seccess .success-inner p {
            padding: 20px 15px;
        }
        .mail-seccess .success-inner .btn{
            color:#fff;
        }
    </style>
</head>
<body>
<section class="mail-seccess section">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-12">
                <!-- Error Inner -->
                <div class="success-inner">
                    <h1><i class="fa fa-envelope"></i><span>Manager QR Report!</span></h1>

                    <table class="table">
                        <thead>
                        <tr>
                            <th style="width: 30%;border: 2px solid gray;" scope="col">Category</th>
                            <th style="width: 70%;border: 2px solid gray;" scope="col">Note</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td style="width: 30%;border: 2px solid gray;">{{$name}}</td>
                            <td style="width: 70%;border: 2px solid gray;"><p style="text-align: justify;">{{$note}}</p> </td>
                        </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col-md-12" style="text-align: left;">
                            Thanks,<br>
                            {{ config('app.name') }}
                        </div>
                    </div>
                </div>
                <!--/ End Error Inner -->
            </div>
        </div>
    </div>
</section>
</body>
</html>

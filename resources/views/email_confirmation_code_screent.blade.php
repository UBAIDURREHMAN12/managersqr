<!DOCTYPE html>
<html>
<head>
    <title>Email Confirmation</title>
    <style>
        .form-gap {
            padding-top: 70px;
        }
    </style>
</head>
<body style="background-image: url('/public/loginPage/images/bg-01.jpg');">

<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<div class="form-gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-check"></i></h3>
                        <h2 class="text-center">Email Confirmation</h2>
                        <p>please enter the code below which you received at your provided email.</p>
                        <div class="panel-body">

                            @if (\Session::has('success'))
                                <div class="alert alert-danger">
                                    <ul>
                                        <li>{!! \Session::get('success') !!}</li>
                                    </ul>
                                </div>
                            @endif

                            <form role="form"class="form" method="post" action="/condeconfirmation">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <lavel>Re Enter Your Email for Confirmation</lavel>
                                        <input type="email" name="email" id="email" class="form-control">
                                    </div>
                                </div>

                              <div class="row">
                                  <div class="col-md-12">
                                      <lavel>Enter Code</lavel>
                                      <input type="number" name="code" class="form-control">
                                  </div>
                              </div>

                                <input type="submit" class="btn btn-primary btn-lg" style="margin-top: 2%;" value="Confirm">

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

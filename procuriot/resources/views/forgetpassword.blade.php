
<!DOCTYPE html>
<html>
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        .form-gap {
            margin-top: 10%;
        }

    </style>
</head>
<body style="background-color: #6860FF;">


<div class="container">
    <div class="row form-gap">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
                <div class="panel-body">
                    <div class="text-center">
                        <h3><i class="fa fa-lock fa-4x" style="font-size: 25px;"></i></h3>
                        <h2 class="text-center" style="font-size: 14px;"><b>Forget Password?</b></h2>
                        <p style="font-size: 14px;">You can reset password here</p>

                        <div class="panel-body">

                            @if (count($errors) > 0)
                                <div class="alert alert-danger alert-block">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif


                            @if ($message = Session::get('success'))
                                <div class="alert alert-success alert-block">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @endif

                            <form action="https://procuriot.ioptime.com/send_mail" role="form"  method="post">
                                @csrf
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                        <input id="email" name="email" placeholder="Email " class="form-control"  type="email">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <input name="recover-submit" style="background-color: #6860FF;font-size: 13px;" class="btn btn-lg btn-primary btn-block btn-reset-meail" value="Reset Password" type="submit">
                                </div>

                                {{--                                <input type="hidden" class="hide" name="token" id="token" value="">--}}
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>


    $(".btn-reset-meail").click(function(){
        $(this).hide();
    });

</script>

</body>
</html>
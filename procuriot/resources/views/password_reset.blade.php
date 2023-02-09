<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<style>
    html,body { height: 100%; }

    body{
        display: -ms-flexbox;
        display: -webkit-box;
        display: flex;
        -ms-flex-align: center;
        -ms-flex-pack: center;
        -webkit-box-align: center;
        align-items: center;
        -webkit-box-pack: center;
        justify-content: center;
        background-color: #6860FF;
    }

    form{
        padding-top: 10px;
        font-size: 13px;
        margin-top: 30px;
    }

    .card-title{ font-weight:300; }

    .btn{
        font-size: 13px;
    }

    .login-form{
        width:320px;
        margin:20px;
    }

    .sign-up{
        text-align:center;
        padding:20px 0 0;
    }

    span{
        font-size:14px;
    }

    .submit-btn{
        margin-top:20px;
    }
</style>

<div class="card login-form">
    <div class="card-body">
        <h3 class="card-title text-center">Reset Password</h3>

        <!--Password must contain one lowercase letter, one number, and be at least 7 characters long.-->

        <div class="card-text">

            @if ($message = Session::get('error'))
                <div class="alert alert-danger alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-block">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong>{{ $message }}</strong>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{url('/update/password')}}" method="post">
                @csrf
                <input type="hidden" name="email" value="{{ $email }}">
                <input type="hidden" name="id" value="{{ $id }}">

                <div class="form-group">
                    <label for="exampleInputEmail1">New password</label>
                    <input type="password" class="form-control form-control-sm" name="password" validate>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Confirm password</label>
                    <input type="password" class="form-control form-control-sm" name="password_confirmation">
                </div>
                <button type="submit" class="btn btn-block submit-btn"
                        style="background-color: #6860FF;font-size: 14px;color: white;">Reset</button>
            </form>
        </div>
    </div>
</div>

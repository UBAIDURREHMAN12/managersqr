
<!DOCTYPE html>
<html>
<head>
    <title>Email Confirmation</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-12" style="text-align: left;">
            Hi, {{$name}}
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: left;">
           <p>We're excited to have you get started.
               First, you need to confirm your account. Just use the code below</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: center;">
          <h3>Your Code is: {{$code}}</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: left;">
            <p style="font-size: 14px;padding-left: 2%;padding-top: 2%;color: black;"> If you did not request for account registration, please ignore this email.</p>
            <br>
            <p style="font-size: 8px;padding-left: 2%;color: black;"><b>This is an automatically generated email, please do not reply ... It's basically set by the system and “responds” while “other person can't”.</b>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: left;">
           <h3>Regard,</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12" style="text-align: left;">
            <h5>Managers Qr Team</h5>
        </div>
    </div>
</div>

</body>
</html>

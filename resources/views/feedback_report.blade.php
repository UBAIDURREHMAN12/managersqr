<!DOCTYPE html>
<html>
<head>

    <title>Survey feedback</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <style>
        body{
            background:#eee;
            margin-top:20px;
        }
        .card-header {
            border-bottom: 1px solid transparent;
            background-color: transparent;
        }
    </style>

</head>
<body>

<div class="container">
    <div class="col-lg-12 col-xl-12">
        <div class="card m-b-30">
            <div class="card-header" style="text-align: center;">
                <h5 class="card-title mb-0" style="background: yellow;">Survey & Feedback Report</h5>
            </div>
            <div class="card-body">
                @for($i=0; $i<count($answers); $i++)

                    @if($i>0)
                        @if($answers[$i]->u_id != $answers[$i-1]->u_id)
                            <div class="row">
                                <div class="col-md-12">
                                    <p style="width: 100%;text-align: center;">----------------------------------------------------------------------------------
                                    --------------------------------------------------------</p>
                                </div>
                            </div>
                        @endif
                    @endif
                    <p style="color: blue;"> <b>Question:</b> {{ \App\SurveyQuestion::where('id', $answers[$i]->question_id)->pluck('question')->first() }}</p>
                    <p> <b>Answer:</b> {{ $answers[$i]->answer }}</p>
                @endfor
            </div>
        </div>
    </div>
</div>

</body>
</html>

@extends('layouts.admin_layout')

@section('title')
    Custom QrCodes
@endsection
@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="row">

                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" style="height: 217px;" src="http://managersqr.managershq.com.au/public/assets/img/customqr_image.png" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">Manage QR</h4>
                            <a href="{{url('/manageQrcode')}}" class="btn btn-primary btn1"> Start </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" style="height: 217px;" src="http://managersqr.managershq.com.au/public/assets/img/customqr_image.png" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title">Custom QR</h4>
                            <a href="{{url('/load/view')}}" class="btn btn-primary btn1"> Start </a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <img class="card-img-top" style="height: 215px;" src="http://managersqr.managershq.com.au/public/assets/img/custom_website_icon.png" alt="Card image cap">
                        <div class="card-body">
                            <h4 class="card-title"> Custom Websites</h4>
                            <a href="{{url('/load/web/view')}}" class="btn btn-primary"> Start </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script type="text/javascript">
        setTimeout(function() {
            $('.alert').fadeOut('slow');
            $('#alert').fadeOut('slow');
        }, 2000); // <-- time in milliseconds
    </script>
@endsection

@extends('layouts.admin_layout')

@section('title')
   Feedbacks

@endsection
@section('content')
    <style>
        @keyframes ldio-652z7f9mdql {
            0% { opacity: 1 }
            100% { opacity: 0 }
        }
        .ldio-652z7f9mdql div {
            left: 94px;
            top: 48px;
            position: absolute;
            animation: ldio-652z7f9mdql linear 1s infinite;
            background: #f56530;
            width: 12px;
            height: 24px;
            border-radius: 6px / 12px;
            transform-origin: 6px 52px;
        }.ldio-652z7f9mdql div:nth-child(1) {
             transform: rotate(0deg);
             animation-delay: -0.9166666666666666s;
             background: #f56530;
         }.ldio-652z7f9mdql div:nth-child(2) {
              transform: rotate(30deg);
              animation-delay: -0.8333333333333334s;
              background: #f56530;
          }.ldio-652z7f9mdql div:nth-child(3) {
               transform: rotate(60deg);
               animation-delay: -0.75s;
               background: #f56530;
           }.ldio-652z7f9mdql div:nth-child(4) {
                transform: rotate(90deg);
                animation-delay: -0.6666666666666666s;
                background: #f56530;
            }.ldio-652z7f9mdql div:nth-child(5) {
                 transform: rotate(120deg);
                 animation-delay: -0.5833333333333334s;
                 background: #f56530;
             }.ldio-652z7f9mdql div:nth-child(6) {
                  transform: rotate(150deg);
                  animation-delay: -0.5s;
                  background: #f56530;
              }.ldio-652z7f9mdql div:nth-child(7) {
                   transform: rotate(180deg);
                   animation-delay: -0.4166666666666667s;
                   background: #f56530;
               }.ldio-652z7f9mdql div:nth-child(8) {
                    transform: rotate(210deg);
                    animation-delay: -0.3333333333333333s;
                    background: #f56530;
                }.ldio-652z7f9mdql div:nth-child(9) {
                     transform: rotate(240deg);
                     animation-delay: -0.25s;
                     background: #f56530;
                 }.ldio-652z7f9mdql div:nth-child(10) {
                      transform: rotate(270deg);
                      animation-delay: -0.16666666666666666s;
                      background: #f56530;
                  }.ldio-652z7f9mdql div:nth-child(11) {
                       transform: rotate(300deg);
                       animation-delay: -0.08333333333333333s;
                       background: #f56530;
                   }.ldio-652z7f9mdql div:nth-child(12) {
                        transform: rotate(330deg);
                        animation-delay: 0s;
                        background: #f56530;
                    }
        .loadingio-spinner-spinner-ep5abeuld3o {
            width: 200px;
            height: 200px;
            display: inline-block;
            overflow: hidden;
            background: #ffffff;
            position: relative;
            left: 15rem;
        }
        .ldio-652z7f9mdql {
            width: 100%;
            height: 100%;
            position: relative;
            transform: translateZ(0) scale(1);
            backface-visibility: hidden;
            transform-origin: 0 0; /* see note above */
        }
        .ldio-652z7f9mdql div { box-sizing: content-box; }


        .modal-body{
            height: 500px;
            overflow-y: auto;
        }
        @import url(https://fonts.googleapis.com/css?family=Roboto:300,400);

        #image-gallery .modal-footer{
            display: block;
        }

        .thumb{
            margin-top: 15px;
            margin-bottom: 15px;
        }

        .modal .modal-dialog {
            margin-top: 5px;
        }
        .checkbox label, .radio label, label {
            font-size: 17px;
        }


        /** SPINNER CREATION **/

        .loader {
            position: relative;
            text-align: center;
            margin: 15px auto 35px auto;
            z-index: 9999;
            display: block;
            width: 80px;
            height: 80px;
            border: 10px solid rgba(0, 0, 0, .3);
            border-radius: 50%;
            border-top-color: #000;
            animation: spin 1s ease-in-out infinite;
            -webkit-animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }

        @-webkit-keyframes spin {
            to {
                -webkit-transform: rotate(360deg);
            }
        }




    </style>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>Feedback Data</h3>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">

                            <tbody>
                            <tr>
                                <td style="background: #F3F3F3;" colspan="5"><b>Floor</b></td>
                                <td>{{str_pad($feedback->floor_id, 2, '0', STR_PAD_LEFT)}}</td>

                            </tr>
                            @if(str_pad($feedback->room_id, 2, '0', STR_PAD_LEFT)!=00)
                            <tr>
                                <td style="background: #F3F3F3;" colspan="5"><b>Room</b></td>
                                <td>{{str_pad($feedback->room_id, 2, '0', STR_PAD_LEFT)}}</td>

                            </tr>
                            @endif
                            <tr>
                                <td style="background: #F3F3F3;" colspan="5"><b>Category</b></td>
                                <td>{{$feedback->name}}</td>

                            </tr>
                            <tr>
                                <td style="background: #F3F3F3;" colspan="5"><b>Note</b></td>
                                <td>{{$feedback->note}}</td>

                            </tr>

                            </tbody>
                        </table>





                        {{--                        {!! $user->render() !!}--}}

                        @if(isset($feedbackImages) && count($feedbackImages)>0)



                            <div class="row">
                                <div class="row">
                                    @foreach($feedbackImages as $image)
                                        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                                            <a class="thumbnail" href="#" data-image-id="{{$image->image}}" data-toggle="modal" data-title=""
                                               data-image="{{$image->image}}"
                                               data-target="#image-gallery">
                                                <img class="img-thumbnail"
                                                     src="{{$image->image}}"
                                                     alt="Another alt text">
                                            </a>
                                        </div>
                                    @endforeach



                                </div>


                                <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="image-gallery-title"></h4>
                                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <img id="image-gallery-image" class="img-responsive col-md-12" src="">
                                            </div>
                                            <div class="modal-footer">
                                                <!--<button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>-->
                                                <!--</button>-->

                                                <!--<button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>-->
                                                <!--</button>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>







                        @endif

                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3>Report Sent History</h3>
                    </div>

                    <div class="card-body">



                        <div class="table-responsive material-datatables">
                            <table class="table" id="datatables">
                                <thead class=" text-primary">
                                <tr>
                                    <th>Serial No</th>
                                    <th>Emails</th>
                                    <th>Admin Note</th>
                                    <th>Created at</th>

                                </tr>
                                </thead>
                                 <?php $i=1 ?>
                                @foreach ($feedbacks as $key => $user)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>
                                            @foreach(json_decode($user->receiver_email) as $email)

                                                <p>{{$email}}</p>


                                            @endforeach


                                        </td>

                                        <td>{{ $user->admin_note }}</td>
                                        <td>{{ $user->date }}</td>


                                    </tr>
                                    <?php $i++?>
                                @endforeach
                            </table>
                        </div>




                        {{--                        {!! $user->render() !!}--}}


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">

                <div class="modal-body" id="reportsDetail">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" integrity="sha512-3P8rXCuGJdNZOnUx/03c1jOTnMn3rP63nBip5gOP2qmUh5YAdVAvFZ1E+QLZZbC1rtMrQb+mah3AfYW11RUrWA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
        $(".thumbnail").click(function(){
        var image = $(this).data('image-id');
        console.log(image);
        $("#image-gallery-image").attr('src',image);

        $("#image-gallery").modal("show");
    });
</script>


@endsection

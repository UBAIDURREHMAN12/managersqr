@extends('layouts.admin_layout')

@section('title')
      Dashboard

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
    </style>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">store</i>
                            </div>
                            <p class="card-category">Properties</p>
                            <a href="/properties">  <h3 class="card-title">{{$properties}}</h3></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <a href="/properties">Manage Properties</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">people</i>
                            </div>
                            <p class="card-category">Open Feedback</p>
                            <a href="#"> <h3 class="card-title">{{$open}}</h3></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats">

                                <ul class="list-group">
                                    @foreach($openArray as $u)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <h6><b>{{$u['userType']}}</b></h6>
                                        <a href="/feedback/{{$u['userType']}}/open">   <span style="position: relative;
    left: 20px;" class="badge badge-primary badge-pill">{{$u['counter']}}</span></a>
                                    </li>
                                        @endforeach


                                </ul>


                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-4 col-md-6 col-sm-6">
                    <div class="card card-stats">
                        <div class="card-header card-header-success card-header-icon">
                            <div class="card-icon">
                                <i class="material-icons">people</i>
                            </div>
                            <p class="card-category">Closed Feedback</p>
                            <a href="#"> <h3 class="card-title">{{$closed}}</h3></a>
                        </div>
                        <div class="card-footer">
                            <div class="stats">
                                <ul class="list-group">
                                    @foreach($closedArray as $u)

                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <h6><b>{{$u['userType']}}</b></h6>
                                        <a href="/feedback/{{$u['userType']}}/closed">   <span style="position: relative;
    left: 20px;" class="badge badge-primary badge-pill">{{$u['counter']}}</span></a>

                                    </li>

                                        @endforeach

                                </ul>

                            </div>
                        </div>
                    </div>
                </div>



            </div>





            <div class="row">

                <div class="col-lg-12 col-md-12">
                    <div class="card">
                        <div class="card-header card-header-primary">
                            <h4 class="card-title">Recent Activity</h4>
                        </div>
                        <div class="card-body table-responsive">
                            @if(Session::has('message'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <p>{{ Session::get('message') }}</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>


{{--                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>--}}
                            @endif
                            <table class="table table-hover" id="activity">
                                <thead class="text-warning">
                                <th>ID</th>
                                <th>Activity</th>
                                <th>Action</th>

                                </thead>
                                <tbody>

                                @foreach($notifications as $n)
                                    @if($n->active==0)
                                    <tr @if($n->user=='housekeeping') style="color:red" @endif>
                                        <td >{{$n->not_id}}</td>
                                        <td><a @if($n->user=='housekeeping') style="color:red" @else style="color: black" @endif href="/feedback/{{$n->feedback_id}}">{!! $n->message !!}
                                            </a></td>
                                        <td>

                                            <a   href="/closedFeedback/{{$n->feedback_id}}"   data-toggle="tooltip" data-placement="top" title="Close Feedback" class="btn  btn-success">Close and remove</a>


                                                <button id="send{{$n->feedback_id}}}"  data-toggle="tooltip" data-placement="top" onclick="createReport({{$n->feedback_id}})" title="Send Report" class="btn btn-info">Send</button>

                                        </td>
                                    </tr>
                                    @endif

                                @endforeach

                                </tbody>
                            </table>
                        </div>
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


@endsection

@extends('layouts.admin_layout')

@section('title')

    Manage Completed Rooms

@endsection
@section('content')
    <style>
        .radio-toolbar {
            margin: 10px;
        }

        .radio-toolbar input[type="radio"] {
            opacity: 0;
            position: fixed;
            width: 0;
        }

        .radio-toolbar label {
            display: inline-block;
            padding: 10px 20px;
            font-family: sans-serif, Arial;
            font-size: 16px;
            border: 2px solid;
            border-radius: 4px;
            background-color: #999;
            border-color: #999;
            box-shadow: 0 2px 2px 0 hsla(0,0%,60%,.14), 0 3px 1px -2px hsla(0,0%,60%,.2), 0 1px 5px 0 hsla(0,0%,60%,.12);
            color: white;
        }

        .radio-toolbar label:hover {
            background-color: #F56530;
            color:white;
            border: 2px solid;
            border-color: #F56530;

        }

        .radio-toolbar input[type="radio"]:focus + label {
            border: 2px dashed #444;
        }

        .radio-toolbar input[type="radio"]:checked + label {
            background-color: #F56530;
            border-color: #F56530;
            color:white;
        }
        .modal .modal-dialog {
            margin-top: 15px;
        }
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




        /** MODAL STYLING **/


    </style>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6"   style="margin-left: 13%;">
                        <div class="card card-stats">
                            <div class="card-header card-header-danger card-header-icon" style="height: 95px;">
                                <div class="card-icon">
                                    <i class="material-icons">home</i>
                                </div>
                                <p class="card-category">Incomplete</p>
                                <h3 class="card-title" id="incompleteCount">{{count($info)}}</h3>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-info card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">home</i>
                                </div>
                                <p class="card-category">Cleaning Commenced</p>
                                <h3 class="card-title">{{count($inprogress)}}</h3>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon" style="height: 95px;">
                                <div class="card-icon">
                                    <i class="material-icons">home</i>
                                </div>
                                <p class="card-category">Completed</p>
                                <h3 class="card-title">{{count($completed)}}</h3>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="card">
                    <div class="card-header card-header-tabs card-header-primary">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <span class="nav-tabs-title">Rooms:</span>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#profile" data-toggle="tab">
                                            <i class="material-icons">pending</i> Incomplete
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#messages" data-toggle="tab">
                                            <i class="material-icons">cleaning_services</i> Cleaning Commenced
                                            <div class="ripple-container"></div>
                                            <div class="ripple-container"></div></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#settings" data-toggle="tab">
                                            <i class="material-icons">done</i> Completed
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="profile">
                               <span class="pull-right" style="float: right">
                            <button  class="btn btn-success btn-sm" data-toggle="modal" data-target="#vendorcreatemodal" ><i class="fa fa-plus"></i> Assign Rooms</button>
                        </span>
                                <div class="table-responsive material-datatables">
                                    <table class="table" id="datatables">
                                        <thead class=" text-primary">

                                        <tr>
                                            <th>Floor No</th>
                                            <th>Room No</th>
                                            <th>Assigned to</th>
                                            <th>Assign date</th>
                                            <th>Assign time</th>

                                            <th width="15%">Action</th>
                                        </tr>
                                        </thead>
                                        @foreach ($info as $key => $user)
                                            <tr>

                                                <td>{{ str_pad($user->floor, 2, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ str_pad($user->room, 2, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->date }}</td>
                                                <td>{{ $user->time }}</td>
                                                <td>

                                                    <button onclick="editRoom({{$user->room_id}})" id="edit{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Edit Assign Room" class="btn btn-link btn-primary btn-just-icon edit" ><i class="material-icons">edit</i></button>
                                                    <button  onclick="deleteRoom({{$user->room_id}})"  id="del_{{$user->room_id}}" data-toggle="tooltip" data-placement="top" title="Delete Assign Room" class="btn btn-link btn-danger btn-just-icon"><i class="material-icons ">delete</i></button>

                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="messages">
                                <div class="table-responsive material-datatables">
                                    <table style="width: 100%" class="table datatables">
                                        <thead class=" text-primary">

                                        <tr>

                                            <th>Floor No</th>
                                            <th>Room No</th>
                                            <th>Assigned to</th>
                                            <th>Assign date</th>
                                            <th>Assign time</th>
                                            <th>Activity Start time</th>




                                        </tr>
                                        </thead>
                                        @foreach ($inprogress as $key => $user)
                                            <tr>

                                                <td>{{ str_pad($user->floor, 2, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ str_pad($user->room, 2, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->date }}</td>
                                                <td>{{ $user->time }}</td>
                                                <td>{{ $user->start_time }}</td>

                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="settings">
                                <div class="table-responsive material-datatables">
                                    <table style="width: 100%" class="table datatables">
                                        <thead class=" text-primary">

                                        <tr>

                                            <th>Floor No</th>
                                            <th>Room No</th>
                                            <th>Assigned to</th>
                                            <th>Assign date</th>
                                            <th>Assign time</th>
                                            <th>Completed date</th>
                                            <th>Time Taken</th>
                                            <th>Action</th>


                                        </tr>
                                        </thead>
                                        @foreach ($completed as $key => $user)
                                            <tr>

                                                <td>{{ str_pad($user->floor, 2, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ str_pad($user->room, 2, '0', STR_PAD_LEFT) }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->date }}</td>
                                                <td>{{ $user->time }}</td>

                                                <td>{{ $user->completed_date }}</td>
                                                <td>{{ $user->time_taken }}</td>
                                                <td><a onclick="showDetails({{$user->room_id}})"><i class="material-icons">visibility</i></a></td>




                                            </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <div class="card-header card-header-danger">--}}
{{--                            <h4 class="card-title">Incomplete Rooms</h4>--}}
{{--                            <p class="card-category">Table of rooms that are yet to be completed</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="card-body">--}}
{{--                        @if ($message = Session::get('success'))--}}
{{--                            <div class="alert alert-success alert-dismissible fade show">--}}
{{--                                <p>{{ $message }}</p>--}}
{{--                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        @endif--}}



{{--                        --}}{{--                        {!! $user->render() !!}--}}


{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <div class="card-header card-header-info">--}}
{{--                            <h4 class="card-title">Cleaning Commenced</h4>--}}
{{--                            <p class="card-category">Rooms where cleaning activity has been started</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="card-body">--}}
{{--                        @if ($message = Session::get('success'))--}}
{{--                            <div class="alert alert-success alert-dismissible fade show">--}}
{{--                                <p>{{ $message }}</p>--}}
{{--                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        @endif--}}



{{--                        --}}{{--                        {!! $user->render() !!}--}}


{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="card">--}}
{{--                    <div class="card-header">--}}
{{--                        <div class="card-header card-header-success">--}}
{{--                            <h4 class="card-title">Completed Rooms</h4>--}}
{{--                            <p class="card-category">Table of rooms that are already completed</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="card-body">--}}
{{--                        @if ($message = Session::get('success'))--}}
{{--                            <div class="alert alert-success alert-dismissible fade show">--}}
{{--                                <p>{{ $message }}</p>--}}
{{--                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
{{--                                    <span aria-hidden="true">&times;</span>--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                        @endif--}}



{{--                        --}}{{--                        {!! $user->render() !!}--}}


{{--                    </div>--}}
{{--                </div>--}}


            </div>
        </div>
    </div>
    <div class="modal fade" id="vendorcreatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="
    margin-top: 15px;
    height: 500px;
    overflow-y: auto;
">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Assign Room</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create-vendor-form">
                        <div class="form-group mb-5">

                            <select id="floor" onchange="getRoomsDetail({{$property->id}})" class="form-control" name="floor">

                                <option value="">Select Floor</option>

                                @for($i=1 ; $i<=$property->floors;$i++)
                                <option value="{{$i}}">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>

                                    @endfor

                            </select>
                        </div>
                        <div id="showRooms" >

                        </div>

                        <div class="form-group mb-5" style="display: none" id="users">

                            <select  onchange="showTask('mainTask')"  class="form-control" id="staffuser" name="user">

                                <option value="">Select Staff Member</option>

                             @foreach($users as $u)
                                <option value="{{$u->user_id}}">{{$u->first_name}}</option>

                                @endforeach

                            </select>
                        </div>


                       <div id="mainTask" style="display:none">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" name="clean" value="14" class="custom-control-input" id="defaultUnchecked">
                            <label class="custom-control-label" for="defaultUnchecked">Routine Clean Complete</label>
                        </div>
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox"  onchange="showTask('specialTask')" class="custom-control-input" id="defaultUnchecked1">
                            <label class="custom-control-label" for="defaultUnchecked1">Special Clean</label>
                        </div>
                       </div>

                        <div id="specialTask" style="display: none">
                        <ul class="list-group list-group-flush">

                            @foreach($roomTask as $rt)

                                @if($rt->id!=14)
                            <li class="list-group-item">
                                <!-- Default checked -->
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="task[]" value="{{$rt->id}}" class="custom-control-input" id="check{{$rt->id}}" >
                                    <label class="custom-control-label" for="check{{$rt->id}}">{{ucfirst($rt->name)}}</label>
                                </div>
                            </li>
                                @endif
                                @endforeach

                        </ul>
                        </div>




                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add-vendor-button" class="btn btn-success" onclick="assignRoom()"> Assign</button>
                </div>
            </div>
        </div>
    </div>
{{--    <div class="modal fade" id="vendoreditemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--        <div class="modal-dialog" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header">--}}
{{--                    <h5 class="modal-title" id="exampleModalLabel">Edit Vendor</h5>--}}
{{--                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                        <span aria-hidden="true">&times;</span>--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <form id="edit-vendor-form">--}}
{{--                        <input type="hidden" name="id" class="form-control" id="recipient-id" autocomplete="off">--}}

{{--                        <div class="form-group">--}}

{{--                            <input type="text" name="name" class="form-control" id="recipient-name" autocomplete="off">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}

{{--                            <input type="email" name="email" class="form-control" id="recipient-email" autocomplete="off">--}}
{{--                        </div>--}}
{{--                        <div class="form-group">--}}

{{--                            <textarea type="text" name="address" class="form-control" id="recipient-address" autocomplete="off"></textarea>--}}
{{--                        </div>--}}

{{--                        <div class="form-group">--}}

{{--                            <input type="text" name="category" class="form-control" id="recipient-category" autocomplete="off">--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--                <div class="modal-footer">--}}
{{--                    <button type="button" id="edit-vendor-button" class="btn btn-primary" onclick="updateVendor()">Update</button>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
    <div class="modal fade" id="vendoreditemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Assign Rooms</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>


                </div>


                <div class="modal-body" id="showForm">



                </div>
                <div class="modal-footer">
                    <button type="button" id="edit-vendor-button" class="btn btn-primary" onclick="updateRoom()">Update</button>
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

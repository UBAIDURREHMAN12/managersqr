


@extends('layouts.admin_layout')

@section('title')
    Feedback

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

        .row-background{
            background: whitesmoke;
        }

        #searchbutton{
            position: relative;
            left: 21rem;
            top: 1rem;
        }
        #searchbuttoninactive{
            position: relative;
            left: 21rem;
            top: 1rem;
        }

        .filter{
            float: right;
            position: relative;
            bottom: 22px;
            left: 1rem;
        }



    </style>

    {{--    @if($type=='Units')--}}
    {{--        Property type units--}}
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-tabs card-header-primary">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                {{--                                <span class="nav-tabs-title">Feebacks:</span>--}}
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link {{ (request()->segment(3) == 'open') ? 'active' : '' }}" href="#profile" data-toggle="tab">
                                            <i class="material-icons"></i> Open
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ (request()->segment(3) == 'closed') ? 'active' : '' }}" href="#messages" data-toggle="tab">
                                            <i class="material-icons"></i> Closed
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>

                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">

                            <div class="tab-pane {{ (request()->segment(3) == 'open') ? 'active' : '' }}" id="profile">
                                <div class="card">
                                    <button  style="float: right;
    position: relative;
    bottom: 0px;
    left: 58rem;" class="pull-right btn btn-link btn-info btn-just-icon" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="material-icons ">filter_alt</i>
                                    </button>
                                    <h4 class="filter"><b>Apply filters</b> </h4>
                                    <div class="collapse" id="collapseExample">
                                        <div class="card-header">

                                        </div>
                                        <div class="card-body">

                                            <form id="searchForm">

                                                <div class="row ml-4">

                                                    @if(isset($property->des) )
                                                    @if($property->des=='units')
                                                        <div class="col-lg-4 col-md-4 col-sm-12 p-0" id="rooms">
                                                            <select class="form-control search-slt" id="area" name="room">
                                                                <option value="">Select Unit</option>


                                                                @foreach($propertyInfo as $info)
                                                                    @if(isset($info->floorNo))
                                                                        <Option value="{{$info->floorNo}}">{{$info->floorNo}}</Option>

                                                                    @else
                                                                        <Option value="{{$info->floor_no}}">{{$info->floor_no}}</Option>

                                                                    @endif
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    @endif
                                                        @if($property->des=='Apartments')
                                                            <div class="col-lg-4 col-md-4 col-sm-12 p-0" id="rooms">
                                                                <select class="form-control search-slt" id="area" name="room">
                                                                    <option value="">Select Apartment</option>


                                                                    @foreach($propertyInfo as $info)
                                                                        @if(isset($info->floorNo))
                                                                            <Option value="{{$info->floorNo}}">{{$info->floorNo}}</Option>

                                                                        @else
                                                                            <Option value="{{$info->floor_no}}">{{$info->floor_no}}</Option>

                                                                        @endif                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        @endif

                                                        @if($property->des=='other')
                                                            <div class="col-lg-4 col-md-4 col-sm-12 p-0" id="rooms">
                                                                <select class="form-control search-slt" id="area" name="room">
                                                                    <option>Select Area</option>


                                                                    @foreach($areaInfo as $info)
                                                                        <Option value="{{$info->area}}">{{$info->area}}</Option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        @endif

                                                    <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                                                        <select class="form-control search-slt" name="category" id="exampleFormControlSelect1">
                                                            <option value="">Select Category</option>
                                                            @foreach($categories as $c)
                                                                <option value="{{$c->id}}">{{$c->name}}</option>

                                                            @endforeach
                                                            <option value="all">All</option>


                                                        </select>
                                                    </div>
                                                    <div style="margin-top: 5px;"  class="col-lg-4 col-md-4 col-sm-12 p-0">
                                                        <input type="date" name="date"  class="form-control search-slt">

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 p-0">

                                                        <button type="button" id="searchbutton" onclick="searchRecords('{{$property->des}}')" class="btn btn-primary wrn-btn ml-5 mb-3">Search</button>


                                                    </div>
                                                </div>

                                                @else
                                                    <p style="color:red">Please select property !</p>
                                                @endif

                                            </form>



                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                        <span class="pull-right" style="float: right">
{{--                            <a href="/vendors/create" class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Add New Vendor</a>--}}
                        </span>
                                    </div>

                                    <div class="card-body">
                                        @if ($message = Session::get('success'))
                                            <div class="alert alert-success alert-dismissible fade show">
                                                <p>{{ $message }}</p>
                                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif

                                        @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                        @endif


                                        <div class="table-responsive material-datatables">
                                            <table class="table" id="datatable1">
                                                <thead class=" text-primary">
                                                <tr>
                                                    <th style="display: none;">Order Id</th>
                                                    <th>Property</th>
                                                    <th>Feedback type</th>
                                                    <th>Note</th>
                                                    @if(isset($property->des))

                                                        @if($property->des=='other')

                                                        <th>Area</th>
                                                        @endif

                                                            @if($property->des=='units')

                                                                <th>Unit</th>
                                                            @endif

                                                            @if($property->des=='Apartments')

                                                                <th>Apartment</th>
                                                            @endif
                                                        @endif

                                                    <th>Created at</th>
                                                    <th width="15%">Action</th>
                                                </tr>
                                                </thead>
                                                @foreach ($data as $key => $user)
                                                    @if($user->active==0)
                                                        <tr @if(session()->get('feedback')==$user->order_id) style="background: whitesmoke"  @endif>

                                                            <td style="display: none;">{{ $user->order_id }}</td>
                                                            <td>{{ $user->title }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->note }}</td>

                                                            @if(isset($property->des))
                                                                @if($property->des=='units' || $property->des=='Apartments')
                                                            <td>{{ str_pad($user->floor_id, 2, '0', STR_PAD_LEFT)}}{{ str_pad($user->room_id, 2, '0', STR_PAD_LEFT)}}</td>
                                                                 @endif

                                                                @if($property->des=='other')

                                                                    <td>{{$user->area}}</td>


                                                                    @endif
                                                            @endif
                                                            <td>{{ $user->create_date }}</td>

                                                            <td>
                                                            <div class="dropdown">

                                                                    <!--Trigger-->

                                                                    <a  type="button" id="dropdownMenu2" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>


                                                                    <!--Menu-->
                                                                    <div class="dropdown-menu dropdown-primary">
                                                                        <a data-toggle="tooltip" data-placement="top" class="dropdown-item" href="/closedFeedback/{{$user->order_id}}"><i class="fas fa-close"></i>&nbsp;&nbsp;Close Feedback</a>
                                                                        <a   class="dropdown-item"  href="/getFeedback/{{$user->order_id}}"><i class="fas fa-eye"></i>&nbsp;View Feedback</a>
                                                                        <a id="send{{$user->order_id}}}"  onclick="createReport({{$user->order_id}})"  class="dropdown-item"  herf="#"><i class="fas fa-envelope"></i>&nbsp;Send Feedback</a>
                                                                        <a id="del_{{$user->order_id}}"     class="dropdown-item delete_feedback_open"  herf="#"><i class="fas fa-trash"></i>&nbsp;Delete Feedback</a>

                                                                    </div>
                                                                </div>


                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>


                                        {{--                        {!! $user->render() !!}--}}


                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane {{ (request()->segment(3) == 'closed') ? 'active' : '' }}" id="messages">

                                <div class="card">
                                    <button  style="float: right;
    position: relative;
    bottom: 0px;
    left: 58rem;" class="pull-right btn btn-link btn-info btn-just-icon" data-toggle="collapse" href="#collapseExample5" role="button" aria-expanded="false" aria-controls="collapseExample">
                                        <i class="material-icons ">filter_alt</i>
                                    </button>
                                    <h4  class="filter"><b>Apply filters</b> </h4>
                                    <div class="collapse" id="collapseExample5">
                                        <div class="card-header">


                                        </div>

                                        <div class="card-body"  >

                                            <form id="searchForm">

                                                <div class="row ml-4">

                                                    @if(isset($property->des) )
                                                        @if($property->des=='units')
                                                            <div class="col-lg-4 col-md-4 col-sm-12 p-0" id="rooms">
                                                                <select class="form-control search-slt" id="area" name="room">
                                                                    <option value="">Select Unit</option>


                                                                    @foreach($propertyInfo as $info)
                                                                        @if(isset($info->floorNo))
                                                                            <Option value="{{$info->floorNo}}">{{$info->floorNo}}</Option>

                                                                        @else
                                                                            <Option value="{{$info->floor_no}}">{{$info->floor_no}}</Option>

                                                                        @endif
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        @endif
                                                        @if($property->des=='Apartments')
                                                            <div class="col-lg-4 col-md-4 col-sm-12 p-0" id="rooms">
                                                                <select class="form-control search-slt" id="area" name="room">
                                                                    <option value="">Select Apartment</option>


                                                                    @foreach($propertyInfo as $info)
                                                                        @if(isset($info->floorNo))
                                                                            <Option value="{{$info->floorNo}}">{{$info->floorNo}}</Option>

                                                                        @else
                                                                            <Option value="{{$info->floor_no}}">{{$info->floor_no}}</Option>

                                                                        @endif                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        @endif

                                                        @if($property->des=='other')
                                                            <div class="col-lg-4 col-md-4 col-sm-12 p-0" id="rooms">
                                                                <select class="form-control search-slt" id="area" name="room">
                                                                    <option>Select Area</option>


                                                                    @foreach($areaInfo as $info)
                                                                        <Option value="{{$info->area}}">{{$info->area}}</Option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        @endif

                                                        <div class="col-lg-4 col-md-4 col-sm-12 p-0">
                                                            <select class="form-control search-slt" name="category" id="exampleFormControlSelect1">
                                                                <option value="">Select Category</option>
                                                                @foreach($categories as $c)
                                                                    <option value="{{$c->id}}">{{$c->name}}</option>

                                                                @endforeach
                                                                <option value="all">All</option>


                                                            </select>
                                                        </div>
                                                        <div style="margin-top: 5px;"  class="col-lg-4 col-md-4 col-sm-12 p-0">
                                                            <input type="date" name="date"  class="form-control search-slt">

                                                        </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12 p-0">

                                                        <button type="button" id="searchbutton" onclick="searchRecords('{{$property->des}}')" class="btn btn-primary wrn-btn ml-5 mb-3">Search</button>


                                                    </div>
                                                </div>

                                                @else
                                                    <p style="color:red">Please select property !</p>
                                                @endif

                                            </form>



                                        </div>
                                    </div>
                                </div>
                                <div class="card">
                                    <div class="card-header">
                        <span class="pull-right" style="float: right">
{{--                            <a href="/vendors/create" class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Add New Vendor</a>--}}
                        </span>
                                    </div>

                                    <div class="card-body">


                                        @if(Session::has('message'))
                                            <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
                                        @endif


                                        <div class="table-responsive material-datatables">
                                            <table class="table" id="datatablesinactive">
                                                <thead class=" text-primary">
                                                <tr>
                                                    <th style="display: none;">Order Id</th>
                                                    <th>Property</th>
                                                    <th>Feedback type</th>
                                                    <th>Note</th>
                                                    @if(isset($property->des))

                                                        @if($property->des=='other')

                                                            <th>Area</th>
                                                        @endif

                                                        @if($property->des=='units')

                                                            <th>Unit</th>
                                                        @endif

                                                        @if($property->des=='Apartments')

                                                            <th>Apartment</th>
                                                        @endif
                                                    @endif
                                                    <th>Created at</th>
                                                    <th width="15%">Action</th>
                                                </tr>
                                                </thead>
                                                @foreach ($data as $key => $user)
                                                    @if($user->active==1)
                                                        <tr @if(session()->get('feedback')==$user->order_id) style="background: whitesmoke"  @endif>
                                                            <td style="display: none;">{{ $user->order_id }}</td>
                                                            <td>{{ $user->title }}</td>
                                                            <td>{{ $user->name }}</td>
                                                            <td>{{ $user->note }}</td>
                                                            @if(isset($property->des))
                                                                @if($property->des=='units' || $property->des=='Apartments')
                                                                    <td>{{ str_pad($user->floor_id, 2, '0', STR_PAD_LEFT)}}{{ str_pad($user->room_id, 2, '0', STR_PAD_LEFT)}}</td>
                                                                @endif

                                                                @if($property->des=='other')

                                                                    <td>{{$user->area}}</td>


                                                                @endif
                                                            @endif                                                            <td>{{ $user->create_date }}</td>

                                                            <td>


                                                                <div class="dropdown">

                                                                    <!--Trigger-->

                                                                    <a  type="button" id="dropdownMenu2" data-toggle="dropdown"
                                                                        aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>


                                                                    <!--Menu-->
                                                                    <div class="dropdown-menu dropdown-primary">
                                                                        <a   class="dropdown-item"  href="/getFeedback/{{$user->order_id}}"><i class="fas fa-eye"></i>&nbsp;View Feedback</a>
                                                                        <a id="send{{$user->order_id}}}"  onclick="createReport({{$user->order_id}})"  class="dropdown-item"  herf="#"><i class="fas fa-envelope"></i>&nbsp;Send Feedback</a>
                                                                        <a id="del_{{$user->order_id}}"     class="dropdown-item delete_feedback_close"  herf="#"><i class="fas fa-trash"></i>&nbsp;Delete Feedback</a>

                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </table>
                                        </div>


                                        {{--                        {!! $user->render() !!}--}}


                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>


    {{--    @else--}}
    {{--        Property type common area--}}
    {{--        <div class="container mt-3">--}}
    {{--            <div class="row justify-content-center">--}}
    {{--                <div class="col-md-12">--}}
    {{--                    <div class="card">--}}

    {{--                        <div class="card-header card-header-tabs card-header-primary">--}}
    {{--                            <div class="nav-tabs-navigation">--}}
    {{--                                <div class="nav-tabs-wrapper">--}}
    {{--                                    --}}{{--                                <span class="nav-tabs-title">Feebacks:</span>--}}
    {{--                                    <ul class="nav nav-tabs" data-tabs="tabs">--}}
    {{--                                        <li class="nav-item">--}}
    {{--                                            <a class="nav-link active" href="#profile" data-toggle="tab">--}}
    {{--                                                <i class="material-icons"></i> Open--}}
    {{--                                                <div class="ripple-container"></div>--}}
    {{--                                            </a>--}}
    {{--                                        </li>--}}
    {{--                                        <li class="nav-item">--}}
    {{--                                            <a class="nav-link" href="#messages" data-toggle="tab">--}}
    {{--                                                <i class="material-icons"></i> Closed--}}
    {{--                                                <div class="ripple-container"></div>--}}
    {{--                                            </a>--}}
    {{--                                        </li>--}}

    {{--                                    </ul>--}}
    {{--                                </div>--}}
    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                        <div class="card-body">--}}
    {{--                            <div class="tab-content">--}}
    {{--                                <div class="tab-pane active" id="profile">--}}
    {{--                                    <div class="card">--}}
    {{--                                        <button  style="float: right;--}}
    {{--    position: relative;--}}
    {{--    bottom: 0px;--}}
    {{--    left: 58rem;" class="pull-right btn btn-link btn-info btn-just-icon" data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample">--}}
    {{--                                            <i class="material-icons ">filter_alt</i>--}}
    {{--                                        </button>--}}
    {{--                                        <h4 class="filter"><b>Apply filters</b></h4>--}}

    {{--                                        <div class="collapse" id="collapseExample2">--}}
    {{--                                        <div class="card-header">--}}

    {{--                                        </div>--}}

    {{--                                        <div class="card-body">--}}

    {{--                                            <form id="searchForm">--}}


    {{--                                                <div class="row ml-4">--}}
    {{--                                                    <div class="col-lg-3 col-md-3 col-sm-12 p-0">--}}
    {{--                                                        <select  onchange="getData('area','active')" class="form-control search-slt" name="property" id="property">--}}
    {{--                                                            <option value="">Select Property</option>--}}
    {{--                                                            @foreach($property as $p)--}}
    {{--                                                                 @if($p->des=='other')--}}

    {{--                                                                <option value="{{$p->id}}">{{$p->title}}</option>--}}
    {{--                                                                @endif--}}


    {{--                                                            @endforeach--}}
    {{--                                                            <option value="all">All</option>--}}


    {{--                                                        </select>--}}
    {{--                                                    </div>--}}
    {{--                                                    <div class="col-lg-3 col-md-3 col-sm-12 p-0">--}}
    {{--                                                        <select class="form-control search-slt" id="area" name="area">--}}
    {{--                                                            <option value="">Select Area</option>--}}
    {{--                                                        </select>--}}
    {{--                                                    </div>--}}
    {{--                                                    <div class="col-lg-3 col-md-3 col-sm-12 p-0">--}}
    {{--                                                        <select class="form-control search-slt" name="category" id="exampleFormControlSelect1">--}}
    {{--                                                            <option value="">Select Category</option>--}}
    {{--                                                            @foreach($categories as $c)--}}
    {{--                                                                <option value="{{$c->id}}">{{$c->name}}</option>--}}

    {{--                                                            @endforeach--}}
    {{--                                                            <option value="all">All</option>--}}


    {{--                                                        </select>--}}
    {{--                                                    </div>--}}
    {{--                                                    <div style="margin-top: 5px;"  class="col-lg-3 col-md-3 col-sm-12 p-0">--}}
    {{--                                                        <input type="date" name="date"  class="form-control search-slt">--}}

    {{--                                                    </div>--}}
    {{--                                                </div>--}}
    {{--                                                <div class="row">--}}
    {{--                                                    <div class="col-md-12 p-0">--}}
    {{--                                                        <button type="button" id="searchbutton" onclick="searchRecords('area')" class="btn btn-primary wrn-btn ml-5 mb-3">Search</button>--}}
    {{--                                                    </div>--}}
    {{--                                                </div>--}}

    {{--                                            </form>--}}



    {{--                                        </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="card">--}}
    {{--                                        <div class="card-header">--}}
    {{--                        <span class="pull-right" style="float: right">--}}
    {{--                            <a href="/vendors/create" class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Add New Vendor</a>--}}
    {{--                        </span>--}}
    {{--                                        </div>--}}

    {{--                                        <div class="card-body">--}}
    {{--                                            @if ($message = Session::get('success'))--}}
    {{--                                                <div class="alert alert-success alert-dismissible fade show">--}}
    {{--                                                    <p>{{ $message }}</p>--}}
    {{--                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">--}}
    {{--                                                        <span aria-hidden="true">&times;</span>--}}
    {{--                                                    </button>--}}
    {{--                                                </div>--}}
    {{--                                            @endif--}}

    {{--                                            @if(Session::has('message'))--}}
    {{--                                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>--}}
    {{--                                            @endif--}}


    {{--                                            <div class="table-responsive material-datatables">--}}
    {{--                                                <table class="table" id="datatables">--}}
    {{--                                                    <thead class=" text-primary">--}}
    {{--                                                    <tr>--}}
    {{--                                                        <th>Property</th>--}}
    {{--                                                        <th>Feedback type</th>--}}
    {{--                                                        <th>Note</th>--}}
    {{--                                                        <th>Area</th>--}}
    {{--                                                        <th>Created at</th>--}}
    {{--                                                        <th width="15%">Action</th>--}}
    {{--                                                    </tr>--}}
    {{--                                                    </thead>--}}
    {{--                                                    @foreach ($data as $key => $user)--}}
    {{--                                                        @if($user->active==0 && $user->des=='other')--}}
    {{--                                                            <tr @if(session()->get('feedback')==$user->order_id) style="background: whitesmoke"  @endif>--}}

    {{--                                                                <td>{{ $user->title }}</td>--}}
    {{--                                                                <td>{{ $user->name }}</td>--}}
    {{--                                                                <td>{{ $user->note }}</td>--}}
    {{--                                                                <td>{{ $user->area}}</td>--}}
    {{--                                                                <td>{{ $user->created_at }}</td>--}}

    {{--                                                                <td>--}}
    {{--                                                                    <a  href="/closedFeedback/{{$user->order_id}}"   data-toggle="tooltip" data-placement="top" title="Close Feedback" class="btn btn-link btn-primary btn-just-icon"><i class="material-icons ">close</i></a>--}}

    {{--                                                                    <a  href="/getFeedback/{{$user->order_id}}"   data-toggle="tooltip" data-placement="top" title="View Feedback" class="btn btn-link btn-info btn-just-icon"><i class="material-icons ">visibility</i></a>--}}
    {{--                                                                    <button id="send{{$user->order_id}}}"  data-toggle="tooltip" data-placement="top" onclick="createReport({{$user->order_id}})" title="Send Report" class="btn btn-link btn-success  btn-just-icon "><i class="material-icons ">send</i></button>--}}
    {{--                                                                    <button  id="del_{{$user->order_id}}" data-toggle="tooltip" data-placement="top" title="Delete Feedback" class="btn btn-link btn-danger btn-just-icon delete_feedback_open"><i class="material-icons ">delete</i></button>--}}



    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                        @endif--}}
    {{--                                                    @endforeach--}}
    {{--                                                </table>--}}
    {{--                                            </div>--}}


    {{--                                            --}}{{--                        {!! $user->render() !!}--}}


    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}
    {{--                                <div class="tab-pane" id="messages">--}}
    {{--                                    <div class="card">--}}
    {{--                                        <button  style="float: right;--}}
    {{--    position: relative;--}}
    {{--    bottom: 0px;--}}
    {{--    left: 58rem;" class="pull-right btn btn-link btn-info btn-just-icon" data-toggle="collapse" href="#collapseExample1" role="button" aria-expanded="false" aria-controls="collapseExample">--}}
    {{--                                            <i class="material-icons ">filter_alt</i>--}}
    {{--                                        </button>--}}
    {{--                                        <h4 class="filter"><b>Apply filters</b></h4>--}}
    {{--                                        <div class="collapse" id="collapseExample1">--}}
    {{--                                        <div class="card-header">--}}

    {{--                                        </div>--}}

    {{--                                        <div class="card-body" >--}}

    {{--                                            <form id="searchForminactive">--}}
    {{--                                                <div class="row ml-4">--}}
    {{--                                                    <div class="col-lg-3 col-md-3 col-sm-12 p-0">--}}
    {{--                                                        <select  onchange="getData('area','inactive')" class="form-control search-slt" name="property" id="propertyInactive">--}}
    {{--                                                            <option value="">Select Property</option>--}}
    {{--                                                            @foreach($property as $p)--}}

    {{--                                                                @if($p->des=='other')--}}

    {{--                                                                    <option value="{{$p->id}}">{{$p->title}}</option>--}}
    {{--                                                                @endif--}}


    {{--                                                            @endforeach--}}
    {{--                                                            <option value="all">All</option>--}}


    {{--                                                        </select>--}}
    {{--                                                    </div>--}}
    {{--                                                    <div class="col-lg-3 col-md-3 col-sm-12 p-0">--}}
    {{--                                                        <select class="form-control search-slt" id="inactivearea" name="area">--}}
    {{--                                                            <option value="">Select Area</option>--}}
    {{--                                                        </select>--}}
    {{--                                                    </div>--}}
    {{--                                                    <div class="col-lg-3 col-md-3 col-sm-12 p-0">--}}
    {{--                                                        <select class="form-control search-slt" name="category" id="exampleFormControlSelect1">--}}
    {{--                                                            <option value="">Select Category</option>--}}
    {{--                                                            @foreach($categories as $c)--}}
    {{--                                                                <option value="{{$c->id}}">{{$c->name}}</option>--}}

    {{--                                                            @endforeach--}}
    {{--                                                            <option value="all">All</option>--}}


    {{--                                                        </select>--}}
    {{--                                                    </div>--}}
    {{--                                                    <div style="margin-top: 5px;"  class="col-lg-3 col-md-3 col-sm-12 p-0">--}}
    {{--                                                        <input type="date" name="date"  class="form-control search-slt">--}}

    {{--                                                    </div>--}}
    {{--                                                </div>--}}


    {{--                                                <div class="col-md-12">--}}
    {{--                                                    <button type="button" id="searchbuttoninactive" onclick="searchRecordsinactive('area')" class="btn btn-primary wrn-btn ml-5 mb-3">Search</button>--}}
    {{--                                                </div>--}}

    {{--                                            </form>--}}



    {{--                                        </div>--}}
    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                    <div class="card">--}}
    {{--                                        <div class="card-header">--}}
    {{--                        <span class="pull-right" style="float: right">--}}
    {{--                            <a href="/vendors/create" class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Add New Vendor</a>--}}
    {{--                        </span>--}}
    {{--                                        </div>--}}

    {{--                                        <div class="card-body">--}}


    {{--                                            @if(Session::has('message'))--}}
    {{--                                                <p class="alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>--}}
    {{--                                            @endif--}}


    {{--                                            <div class="table-responsive material-datatables">--}}
    {{--                                                <table class="table" id="datatablesinactive">--}}
    {{--                                                    <thead class=" text-primary">--}}
    {{--                                                    <tr>--}}
    {{--                                                        <th>Property</th>--}}
    {{--                                                        <th>Feedback type</th>--}}
    {{--                                                        <th>Note</th>--}}
    {{--                                                        <th>Area</th>--}}
    {{--                                                        <th>Created at</th>--}}
    {{--                                                        <th width="15%">Action</th>--}}
    {{--                                                    </tr>--}}
    {{--                                                    </thead>--}}
    {{--                                                    @foreach ($data as $key => $user)--}}
    {{--                                                        @if($user->active==1 && $user->des=='other')--}}
    {{--                                                            <tr @if(session()->get('feedback')==$user->order_id) style="background: whitesmoke"  @endif>--}}

    {{--                                                                <td>{{ $user->title }}</td>--}}
    {{--                                                                <td>{{ $user->name }}</td>--}}
    {{--                                                                <td>{{ $user->note }}</td>--}}
    {{--                                                                <td>{{$user->area }}</td>--}}
    {{--                                                                <td>{{ $user->created_at }}</td>--}}

    {{--                                                                <td>--}}
    {{--                                                                    <a  href="/getFeedback/{{$user->order_id}}"   data-toggle="tooltip" data-placement="top" title="View Feedback" class="btn btn-link btn-info btn-just-icon"><i class="material-icons ">visibility</i></a>--}}
    {{--                                                                    <button id="send{{$user->order_id}}}"  data-toggle="tooltip" data-placement="top" onclick="createReport({{$user->order_id}})" title="Send Report" class="btn btn-link btn-success  btn-just-icon "><i class="material-icons ">send</i></button>--}}
    {{--                                                                    <button  id="del_{{$user->order_id}}" data-toggle="tooltip" data-placement="top" title="Delete Feedback" class="btn btn-link btn-danger btn-just-icon delete_feedback_close"><i class="material-icons ">delete</i></button>--}}



    {{--                                                                </td>--}}
    {{--                                                            </tr>--}}
    {{--                                                        @endif--}}
    {{--                                                    @endforeach--}}
    {{--                                                </table>--}}
    {{--                                            </div>--}}


    {{--                                            --}}{{--                        {!! $user->render() !!}--}}


    {{--                                        </div>--}}
    {{--                                    </div>--}}
    {{--                                </div>--}}

    {{--                            </div>--}}
    {{--                        </div>--}}
    {{--                    </div>--}}
    {{--                </div>--}}


    {{--            </div>--}}
    {{--        </div>--}}






    {{--    @endif--}}

    <script>
        function getData(active) {
            var type = $('#propertyType').val();

            $.ajax({
                url: '/getpropertyareainfo',
                type: 'POST',
                data: {type:type},
                success: function(response) {
                    if(response==''){
                        $('#area').hide();

                    }
                    if(active=='active'){
                        $('#area').show();
                        $('#area').html(response);

                    }

                }
            });
        }
    </script>

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

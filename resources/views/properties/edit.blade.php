@extends('layouts.admin_layout')

@section('title')

    Properties

@endsection

@section('content')
    <style>
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
            top:8px;
        }

        .switch input {
            opacity: 0;
            width: 0;
            height: 0;

        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked + .slider {
            background-color: #F56530;
        }

        input:focus + .slider {
            box-shadow: 0 0 1px #F56530;
        }

        input:checked + .slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        /* Rounded sliders */
        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>

    <div class="col-md-12">

        <input class="form-control latitude"     type="hidden"  id="lat"  value ="25.2744"  aria-required="true">
        <input class="form-control longitude"    type="hidden"  id="long" value ="133.7751"  aria-required="true">
{{--        {{ Form::model($properties, array('route' => array('properties.update', $properties->id), 'method' => 'PUT', 'id' => 'RegisterValidation','files' =>true,'enctype'=>'multipart/form-data')) }}--}}
        <form method="POST" action="/properties/propertyUpdate"  enctype="multipart/form-data" id="RegisterValidation">

        @csrf
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit Property</h4>

                </div>
                <div class="card-body ">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger alert-dismissible fade show">
                            <strong>Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                        @if ($message = Session::get('error'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <p>{{ $message }}</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Title</label>
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled">
                                <input type="hidden" name="id" value="{{$properties->id}}">
                                <input class="form-control" name="title" id="input-name"  type="text" placeholder="Name" value="{{$properties->title}}"  required="true" aria-required="true">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <div class="col-sm-7">
                                {{--                                <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Open Modal</button>--}}
                                <div style='height: 15rem;
    position: relative;
    overflow: hidden;
    margin-left: 30%;
    width: 100%;' id="map-canvas"></div>

                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Location</label>
                            <div class="col-sm-7">
                                <div class="form-group bmd-form-group is-filled">
                                    <input class="form-control" id="map-search" name="location" id="input-name" minlength="5" type="text" placeholder="Name" value="{{$properties->location}}"  required="true" aria-required="true">
                                </div>
                            </div>
                        </div>
                        <input type="hidden"  value="{{$properties->des}}" id="des-hidden">

                        <div class="row">
                            <label class="col-sm-2 col-form-label">Property Type</label>
                            <div class="col-sm-7">


                                <div class="form-group bmd-form-group is-filled has-label">
                                    <select id="des" onchange="showFloors()" name="des" class="form-control" readonly="">
                                        <option value="Apartments"  @if($properties->des=='Apartments') selected @endif>Apartments</option>
                                        <option value="units" @if($properties->des=='units') selected @endif>Units</option>
                                        <option value="Townhouses" @if($properties->des=='Townhouses') selected @endif>Townhouses</option>
                                        <option value="Resort" @if($properties->des=='Resort') selected @endif>Resort</option>
                                        <option value="Hotel" @if($properties->des=='Hotel') selected @endif>Hotel</option>
                                        <option value="House" @if($properties->des=='House') selected @endif>House</option>
                                        <option value="Villas" @if($properties->des=='Villas') selected @endif>Villas</option>
                                        <option value="Community" @if($properties->des=='Community') selected @endif>Community</option>
                                        <option value="Duplex" @if($properties->des=='Duplex') selected @endif>Duplex</option>
                                        <option value="High Rise Building" @if($properties->des=='High Rise Building') selected @endif>High Rise Building</option>
                                        <option value="Cottage" @if($properties->des=='Cottage') selected @endif>Cottage</option>
                                        <option value="Air BnB" @if($properties->des=='Air BnB') selected @endif>Air BnB</option>
                                        <option value="BnB" @if($properties->des=='BnB') selected @endif>BnB</option>
                                        <option value="other" @if($properties->des=='other') selected @endif> Common Area</option>


                                    </select>
                                </div>
                            </div>
                        </div>




                </div>
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">Update<div class="ripple-container"></div></button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function showFloors() {

            var value=$('#des').val();


            if(value=='units' ||  value=='Apartments'){

                var hdes= $('#des-hidden').val();

                if(hdes == 'units' ||  value=='Apartments'){
                    $('#floorsDiv').show();


                }else{
                    $('#floorsDiv').show();
                    $('#floorsDiv').html('   <div class="row" id="floorsDiv">\n' +
                        '                            <label class="col-sm-2 col-form-label">Floors</label>\n' +
                        '                            <div class="col-sm-7">\n' +
                        '                                <div class="form-group bmd-form-group is-filled has-label">\n' +
                        '                                    <input class="form-control" id="floors"  name="floors" value="" placeholder=""  type="number"  >\n' +
                        '                                    <a style="position: relative;\n' +
                        '    left: 37%;" href="#" onclick="getRooms()" class="btn btn-primary">Update Rooms</a>\n' +
                        '                                </div>\n' +
                        '                            </div>\n' +
                        '                        </div>\n' +
                        '                        <div id="roomsFeilds">\n' +
                        '\n' +
                        '                        </div>');
                }
                $('#areaDiv').hide();

            }else if(value=='other'){
                var hdes= $('#des-hidden').val();

                if(hdes == 'other' ){
                    $('#areaDiv').show();

                }else{
                    $('#areaDiv').show();
                    $('#areaDiv').html('        <div class="row mt-5">\n' +
                        '                                <div class="col-sm-2 col-md-2">\n' +
                        '                                </div>\n' +
                        '                                <div class="col-sm-7 col-md-7" id="showFields">\n' +
                        '\n' +
                        '\n' +
                        '                                </div>\n' +
                        '\n' +
                        '                            </div>\n' +
                        '                            <div class="row">\n' +
                        '                                <div class="col-sm-2 col-md-2">\n' +
                        '                                </div>\n' +
                        '                                <div class="col-sm-7 col-md-7">\n' +
                        '                                    <button type="button" class="btn btn-primary mt-4" onclick="appendField()"><i class="fa fa-plus"></i> Add Common Area</button>\n' +
                        '\n' +
                        '\n' +
                        '                                </div>\n' +
                        '\n' +
                        '                            </div>');
                }


                $('#floorsDiv').hide();
            }else{
                $('#floorsDiv').hide();
                $('#areaDiv').hide();
            }
        }

        function appendField() {


            var text='<input class="form-control" placeholder="Add Common Area"  name="area[]"  placeholder=""  type="text"    aria-required="true" required>\n';

            $('#showFields').append(text);

        }
    </script>

@endsection


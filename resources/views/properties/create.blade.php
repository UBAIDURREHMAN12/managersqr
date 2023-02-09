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
        <form method="post" action="{{route('properties.store')}}" id="RegisterValidation" enctype="multipart/form-data">

            {{ csrf_field() }}
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Create Property</h4>

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
                            <div class="form-group bmd-form-group is-filled has-label">
{{--                                <input class="form-control"  name="title"--}}
{{--                                       value="{{ old('title') }}" minlength="100" onkeydown="return /[a-z]/i.test(event.key)" type="text"  required="true" aria-required="true">--}}
                                <input class="form-control"  name="title" id="title"
                                       value="{{ old('title') }}"  accept="text/richtext" type="text"  required="true" aria-required="true">
                            </div>
                        </div>
                    </div>

                        <div class="row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-7">
                                <div style='height: 15rem;
                                    position: relative;
                                    overflow: hidden;
                                    /*margin-left: 30%;*/
                                    width: 100%;' id="map-canvas" class="form-group bmd-form-group is-filled has-label" >

                                </div>
                            </div>
                        </div>

{{--                        <div class="row">--}}
{{--                            <div class="col-sm-7 col-offset-3" style="text-align: center;">--}}

{{--                                <div style='height: 15rem;--}}
{{--                                    position: relative;--}}
{{--                                    overflow: hidden;--}}
{{--                                    /*margin-left: 30%;*/--}}
{{--                                    width: 100%;' id="map-canvas" class="form-group bmd-form-group is-filled has-label" >--}}

{{--                                </div>--}}

{{--                            </div>--}}
{{--                        </div>--}}
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Location</label>
                            <div class="col-sm-7">
                                <div class="form-group bmd-form-group is-filled has-label">
                                    <input class="form-control" id="map-search" maxlength="255" onkeydown="return /[a-z]/i.test(event.key)"
                                           value="{{ old('location') }}"  name="location" placeholder=""  type="text"
                                           required="true" aria-required="true">
                                    <span style="font-size: 11px;color: red;">*  Locations should
not be longer than 255
characters and not have
characters like !, ?, (), *,
%</span>
                                </div>
                            </div>
                        </div>

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Property Type</label>
                        <div class="col-sm-7">


                            <div class="form-group bmd-form-group is-filled has-label">
                               <select id="des" onchange="showFloors()" name="des" class="form-control">
                                   <option value="Apartments">Apartments</option>
                                   <option value="units">Units</option>
                                   <option value="Townhouses">Townhouses</option>
                                   <option value="Resort">Resort</option>
                                   <option value="Hotel">Hotel</option>
                                   <option value="House">House</option>
                                   <option value="Villas">Villas</option>
                                   <option value="Community">Community</option>
                                   <option value="Duplex">Duplex</option>
                                   <option value="High Rise Building">High Rise Building</option>
                                   <option value="Cottage">Cottage</option>
                                   <option value="Air BnB">Air BnB</option>
                                   <option value="BnB">BnB</option>
                                   <option value="other">Common Area</option>

                               </select>
                            </div>
                        </div>
                    </div>

                        <div id="floorsDiv">

                        <div class="row">
                            <label class="col-sm-2 col-form-label" id="setName">Enter no of Apartments</label>
                            <div class="col-sm-7">
                                <div class="form-group bmd-form-group is-filled has-label">
                                    <input class="form-control" id="floors"  maxlength="3"  name="floors" value="{{ old('floors') }}" placeholder=""  type="number"   required="true" aria-required="true">

                                </div>
                            </div>
                        </div>
                            <a style="position: relative;
    left: 37%;" href="#" onclick="getRooms()" class="btn btn-primary">Add Rooms</a>
                        <div id="roomsFeilds">

                        </div>
                        </div>

                      <div id="areaDiv" style="display:none">
                            <div class="row mt-5">
                                <div class="col-sm-2 col-md-2">
                                </div>
                                <div class="col-sm-7 col-md-7" id="showFields">


                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-2 col-md-2">
                                </div>
                                <div class="col-sm-7 col-md-7">
                                    <button type="button" class="btn btn-primary mt-4" id="areaButton" onclick="appendField()"><i class="fa fa-plus"></i> Add Common Area</button>


                                </div>

                            </div>





                        </div>
                      <div class="row mt-3">
                            <label class="col-sm-2 col-form-label">Logo</label>
                        <div class="col-md-7">
                            <input type="file" name="image" class="form-control inputFileHidden" accept="image/*"  >

                        </div>
                        </div>

{{--                        <div class="row">--}}
{{--                            <label class="col-sm-2 col-form-label">Set as default</label>--}}
{{--                            <div class="col-sm-7">--}}
{{--                                <label class="switch">--}}
{{--                                    <input type="checkbox" name="defaultProperty" value="1">--}}
{{--                                    <span class="slider round"></span>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}

                </div>
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">Save<div class="ripple-container"></div></button>
                </div>
            </div>
        </form>
    </div>

       <script>

           // $('#title').bind('keyup blur',function(){
           //     var node = $(this);
           //     node.val(node.val().replace(/[^a-z ]/g,'') ); }
           // );

           // $(document).on('keyup', '#title', function (e) {
           //     alert('sdfdsf');
           //     var regex = new RegExp(/^[a-zA-Z\s]+$/);
           //     var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
           //     if (regex.test(str)) {
           //         return true;
           //     }
           //     else {
           //         e.preventDefault();
           //         return false;
           //     }
           // });


        function showFloors() {

             var value=$('#des').val();

            if(value=='Apartments' || value=='units' ){

                text="Enter no of "+value;

                $('#setName').text(text);

                $('#floorsDiv').show();
                $('#floors').attr('name','floors');
                $("#roomsFeilds :input").attr('name','rooms[]');
                $("#areaDiv :input").removeAttr('name');

                $('#areaDiv').hide();
            }else{
                $('#floorsDiv').hide();
                $('#areaDiv').hide();
                $('#floors').removeAttr('name');
                $("#roomsFeilds :input").removeAttr('name');
                $("#areaDiv :input").removeAttr('name');


            }

            if(value=='other'){
                $('#areaDiv').show();
                $('#floorsDiv').hide();
                $("#areaDiv :input").attr('name','area[]');
                $('#floors').removeAttr('name');
                $("#roomsFeilds :input").removeAttr('name');
            }


            // if(value=='units' ){
            //
            //     $('#floorsDiv').show();
            //     $('#areaDiv').hide();
            // }else{
            //     $('#areaDiv').show();
            //     $('#floorsDiv').hide();
            // }
        }
        function appendField() {


           var text='<input class="form-control" placeholder="Add Common Area"  name="area[]"  placeholder=""  type="text"    aria-required="true" required>\n';

            $('#showFields').append(text);

        }



    </script>




@endsection














@extends('layouts.admin_layout')
@section('title')
    Vendors

@endsection

@section('content')

    <div class="col-md-12">
        <form method="post" action="/vendors/store" id="RegisterValidation" >
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Add Vendor</h4>

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

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled has-label">
                                <input class="form-control"  name="name" value="{{ old('name') }}"  type="text" placeholder="Name"  required="true" aria-required="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled has-label">
                                <input class="form-control" name="email" value="{{ old('email') }}"  type="email" placeholder="Email"  required="">
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
    width: 100%;' id="map-canvas-vendor"></div>

                            </div>
                        </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled has-label">
                                <textarea class="form-control" id="map-search-vendor" name="address"   placeholder="Address"  required>{{old('address')}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled has-label">
                                <select name="category" onchange="checkCategory()" class="form-control mdb-select md-form" data-style="btn btn-link" id="categorySelect" >
                                    <option value="">Select Category</option>
                                      @foreach($categories as $c)
                                          <option value="{{ucfirst($c->name)}}">{{ucfirst($c->name)}}</option>

                                      @endforeach
{{--                                    <option value="other">Others</option>--}}

                                </select>
                            </div>
                        </div>
                    </div>

{{--                        <div style="display: none;margin-top: 20px" class="row" id="showField">--}}
{{--                            <label class="col-sm-2 col-form-label"></label>--}}
{{--                            <div class="col-sm-7">--}}
{{--                                <div class="form-group bmd-form-group is-filled has-label">--}}
{{--                                    <input  class="form-control"   name="other"  type="text" placeholder="Add Category"  required="">--}}

{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}


                </div>
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">Generate Account<div class="ripple-container"></div></button>
                </div>
            </div>
        </form>
    </div>


@endsection

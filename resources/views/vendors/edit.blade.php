@extends('layouts.admin_layout')

@section('title')

    Vendors
    @endsection

@section('content')

    <div class="col-md-12">
        <form method="post" action="/vendors/update" id="RegisterValidation"  >
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit Vendor</h4>

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
                        <input class="form-control" name="id"  type="hidden" value="{{$vendor->id}}" >

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled">
                                <input class="form-control" name="name" id="input-name" minlength="5" type="text" placeholder="Name" value="{{$vendor->name}}"  required="true" aria-required="true">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled">
                                <input class="form-control" name="email" id="input-email" value="{{$vendor->email}}"  type="email" placeholder="Email"  required="">
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
                            <div class="form-group bmd-form-group is-filled">
                                <textarea class="form-control" id="map-search-vendor" name="address" id="input-email" type=""   placeholder="Address"  required="">{{$vendor->address}}</textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <label class="col-sm-2 col-form-label">Category</label>
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled ">
                                <select name="category" onchange="checkCategory()" class="form-control mdb-select md-form" data-style="btn btn-link" id="categorySelect" >
                                    <option value="">Select Category</option>
                                    @foreach($categories as $c)
                                        <option value="{{$c->name}}" @if($c->name==$vendor->category) selected @endif>{{ucfirst($c->name)}}</option>

                                    @endforeach
                                    {{--                                    <option value="other">Others</option>--}}

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



@endsection

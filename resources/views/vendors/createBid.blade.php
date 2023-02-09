@extends('layouts.vendor_layout')
@section('title')
   Dashboard

@endsection

@section('content')

    <div class="col-md-12">
        <form method="post" action="/vendor/addBid" id="RegisterValidation" >
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Add Bid</h4>

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
                        <input class="form-control" value="{{$id}}"  name="report_id"  type="hidden" >

                    <div class="row">
                        <label class="col-sm-2 col-form-label">No of days</label>
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled has-label">
                                <input class="form-control"  name="no_of_days"  type="number" placeholder="No of days to complete job"  required="true" aria-required="true">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-7">
                                <div class="form-group bmd-form-group is-filled has-label">
                                    <input class="form-control"  name="price"  type="number" placeholder="Price"  required="true" aria-required="true">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Note</label>
                            <div class="col-sm-7">
                                <div class="form-group bmd-form-group is-filled has-label">
                                    <textarea class="form-control"  name="bid_note"   placeholder="Note"  required="true" aria-required="true"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-7">
                                <div class="form-group bmd-form-group is-filled has-label">
                                    <h6 style="color:#aaa;font-weight:400">Is site inspection or further reporting is required !</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"></label>

                            <div class="col-sm-7">
                                <div class="form-group bmd-form-group is-filled has-label">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="inspection_required" value="1" checked="" required> Yes
                                            <span class="circle">
                              <span class="check"></span>
                            </span>
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="inspection_required" value="0" checked="" required> No
                                            <span class="circle">
                              <span class="check"></span>
                            </span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>


                </div>
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">Save<div class="ripple-container"></div></button>
                </div>
            </div>
        </form>
    </div>



@endsection

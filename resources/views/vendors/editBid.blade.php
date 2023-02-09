@extends('layouts.vendor_layout')
@section('title')
   Dashboard

@endsection

@section('content')

    <div class="col-md-12">
        <form method="post" action="/vendor/updateBid" id="RegisterValidation" >
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit Bid</h4>

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
                        <input class="form-control" value="{{$bid->report_id}}"  name="report_id"  type="hidden" >
                        <input class="form-control" value="{{$bid->vendor_id}}"  name="vendor_id"  type="hidden" >
                        <input class="form-control" value="{{$bid->id}}"  name="id"  type="hidden" >

                    <div class="row">
                        <label class="col-sm-2 col-form-label">No of days</label>
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled has-label">
                                <input class="form-control"  name="no_of_days"  value="{{$bid->no_of_days}}" type="number" placeholder="No of days to complete job"  required="true" aria-required="true">
                            </div>
                        </div>
                    </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Price</label>
                            <div class="col-sm-7">
                                <div class="form-group bmd-form-group is-filled has-label">
                                    <input class="form-control"  name="price"  value="{{$bid->price}}" type="number" placeholder="Price"  required="true" aria-required="true">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label">Note</label>
                            <div class="col-sm-7">
                                <div class="form-group bmd-form-group is-filled has-label">
                                    <textarea class="form-control"  name="bid_note" placeholder="Note"  required="true" aria-required="true">{{$bid->bid_note}}</textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"></label>
                            <div class="col-sm-7">
                                <div class="form-group bmd-form-group is-filled has-label">
                                    <h6 style="color:#aaa;font-weight:400">Is site inspection and further reporting is required !</h6>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <label class="col-sm-2 col-form-label"></label>

                            <div class="col-sm-7">
                                <div class="form-group bmd-form-group is-filled has-label">
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="inspection_required" value="1" @if($bid->inspection_required==1) checked="" @endif required> Yes
                                            <span class="circle">
                              <span class="check"></span>
                            </span>
                                        </label>
                                        <label class="form-check-label">
                                            <input class="form-check-input" type="radio" name="inspection_required" value="0" @if($bid->inspection_required==0) checked @endif  required> No
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
                    <button type="submit" class="btn btn-primary">Update<div class="ripple-container"></div></button>
                </div>
            </div>
        </form>
    </div>



@endsection

@extends('layouts.vendor_layout')

@section('title')
    Dashboard

@endsection
@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-6"   >
                        <div class="card card-stats">
                            <div class="card-header card-header-info card-header-icon" >
                                <div class="card-icon">
                                    <i class="material-icons">request_quote</i>
                                </div>
                                <p class="card-category">Quote Request</p>
                                <h3 class="card-title" id="incompleteCount">{{$quoteRequestCount}}</h3>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6" >
                        <div class="card card-stats">
                            <div class="card-header card-header-warning card-header-icon" >
                                <div class="card-icon">
                                    <i class="material-icons">request_quote</i>
                                </div>
                                <p class="card-category">Pending</p>
                                <h3 class="card-title" id="incompleteCount">{{$pendinCount}}</h3>
                            </div>

                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-success card-header-icon">
                                <div class="card-icon">
                                    <i class="material-icons">request_quote</i>
                                </div>
                                <p class="card-category">approved</p>
                                <h3 class="card-title">{{$approved}}</h3>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-6">
                        <div class="card card-stats">
                            <div class="card-header card-header-danger card-header-icon" >
                                <div class="card-icon">
                                    <i class="material-icons">request_quote</i>
                                </div>
                                <p class="card-category">Declined</p>
                                <h3 class="card-title">{{$declinedCount}}</h3>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="card">
                    <div class="card-header card-header-tabs card-header-primary">
                        <div class="nav-tabs-navigation">
                            <div class="nav-tabs-wrapper">
                                <span class="nav-tabs-title">Quotes:</span>
                                <ul class="nav nav-tabs" data-tabs="tabs">
                                    <li class="nav-item">
                                        <a class="nav-link {{ (session()->has('vendor_section')) ? '' : 'active show' }}" href="#QuoteRequest" data-toggle="tab">
                                            <i class="material-icons">request_quote</i> Quote Request
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link {{ (session()->get('vendor_section') == 'pending') ? 'active' : '' }}" href="#profile" data-toggle="tab">
                                            <i class="material-icons">pending</i> Pending
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#messages" data-toggle="tab">
                                            <i class="material-icons">done</i> Approved
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="#settings" data-toggle="tab">
                                            <i class="material-icons">clear</i> Declined
                                            <div class="ripple-container"></div>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane {{ (session()->has('vendor_section')) ? '' : 'active show' }}" id="QuoteRequest">

                                <div class="table-responsive material-datatables">
                                    <table class="table datatables" style="width:100% !important;" >
                                        <thead class=" text-primary">
                                        <tr>
                                            <th>Report Title</th>
                                            <th>Ref No</th>
                                            <th>Property</th>
                                            <th>Manager</th>
                                            <th>Email</th>
                                            <th>date</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                        </thead>
                                        @foreach ($data as $key => $user)

                                            @if($user->bid_status==0)

                                                <tr>
                                                    <td>{{ $user->report_title }}</td>

                                                    <td>{{ $user->ref_no }}</td>
                                                    <td>{{ $user->title }}</td>
                                                    <td>{{ $user->first_name }}{{ $user->last_name }}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td>@if($user->created_at){{date('d-m-Y', strtotime($user->created_at))}}@endif</td>
                                                    <td>
                                                        <a  data-toggle="tooltip" data-placement="top" title="Report Details" class="btn btn-link btn-default btn-just-icon edit"  href="/vendor/reportDetails/{{$user->report_id}}"><i class="material-icons">visibility</i></a>
                                                        @if(empty($user->bids) )
                                                            <a  data-toggle="tooltip" data-placement="top" title="Add bid" class="btn btn-link btn-primary btn-just-icon"  href="/vendor/createBid/{{$user->report_id}}"><i class="material-icons">create</i></a>
                                                            <a  data-toggle="tooltip" data-placement="top" title="Decline" class="btn btn-link btn-danger btn-just-icon"  href="/vendor/declineQuote/{{$user->report_id}}"><i class="material-icons">clear</i></a>

                                                        @else
                                                            <a  data-toggle="tooltip" data-placement="top" title="Edit bid" class="btn btn-link btn-success btn-just-icon"  href="/vendor/editBid/{{$user->report_id}}"><i class="material-icons">update</i></a>
                                                            <a  data-toggle="tooltip" data-placement="top" id="delete_{{$user->report_id}}" title="withdraw Bid" id="" class="btn btn-link btn-danger btn-just-icon bid_delete" ><i class="material-icons">delete</i></a>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endif


                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane {{ (session()->get('vendor_section') == 'pending') ? 'active' : '' }}{{session()->forget('vendor_section')}}" id="profile">
                                @if ($message = Session::get('success'))
                                    <div class="alert alert-success alert-dismissible fade show">
                                        <p>{{ $message }}</p>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                <div class="table-responsive material-datatables">
                                    <table class="table datatables" style="width:100% !important;" >
                                        <thead class=" text-primary">
                                        <tr>
                                            <th>Report Title</th>

                                            <th>Ref No</th>
                                            <th>Property</th>
                                            <th>Manager</th>
                                            <th>Email</th>

                                            <th>date</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                        </thead>
                                        @foreach ($data as $key => $user)

                                            @if($user->bid_status==1)

                                            <tr>
                                                <td>{{ $user->report_title }}</td>

                                                <td>{{ $user->ref_no }}</td>
                                                <td>{{ $user->title }}</td>
                                                <td>{{ $user->first_name }}{{ $user->last_name }} </td>
                                                <td>{{$user->email}}</td>
                                                <td>@if($user->created_at){{date('d-m-Y', strtotime($user->created_at))}}@endif</td>
                                                <td>
                                                    <a  data-toggle="tooltip" data-placement="top" title="Report Details" class="btn btn-link btn-default btn-just-icon edit"  href="/vendor/reportDetails/{{$user->report_id}}"><i class="material-icons">visibility</i></a>
{{--                                                    @if(empty($user->bids) )--}}
{{--                                                        <a  data-toggle="tooltip" data-placement="top" title="Add bid" class="btn btn-link btn-primary btn-just-icon"  href="/vendor/createBid/{{$user->report_id}}"><i class="material-icons">create</i></a>--}}
{{--                                                        <a  data-toggle="tooltip" data-placement="top" title="Decline" class="btn btn-link btn-danger btn-just-icon"  href="/vendor/declineQuote/{{$user->report_id}}"><i class="material-icons">clear</i></a>--}}

{{--                                                    @else--}}
{{--                                                        <a  data-toggle="tooltip" data-placement="top" title="Edit bid" class="btn btn-link btn-success btn-just-icon"  href="/vendor/editBid/{{$user->report_id}}"><i class="material-icons">update</i></a>--}}
{{--                                                        <a  data-toggle="tooltip" data-placement="top" id="delete_{{$user->report_id}}" title="withdraw Bid" id="" class="btn btn-link btn-danger btn-just-icon bid_delete" ><i class="material-icons">delete</i></a>--}}
{{--                                                    @endif--}}
                                                </td>
                                            </tr>
                                            @endif


                                        @endforeach
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane" id="messages">
                                <div class="table-responsive material-datatables">
                                    <table class="table datatables" style="width:100% !important;" >
                                        <thead class=" text-primary">
                                        <tr>
                                            <th>Report Title</th>

                                            <th>Ref No</th>
                                            <th>Property</th>
                                            <th>Manager</th>
                                            <th>Email</th>

                                            <th>date</th>
                                            <th width="15%">Action</th>
                                        </tr>
                                        </thead>
                                        @foreach ($data as $key => $user)
                                            @if($user->bid_status==2)
                                            <tr>
                                                <td>{{ $user->report_title }}</td>

                                                <td>{{ $user->ref_no }}</td>
                                                <td>{{ $user->title }}</td>
                                                <td>{{ $user->first_name }}{{ $user->last_name }} </td>
                                                <td>{{$user->email}}</td>
                                                <td>@if($user->created_at){{date('d-m-Y', strtotime($user->created_at))}}@endif</td>
                                                <td><a  data-toggle="tooltip" data-placement="top" title="Report Details" class="btn btn-link btn-default btn-just-icon edit"  href="/vendor/reportDetails/{{$user->report_id}}"><i class="material-icons">visibility</i></a></td>

                                            </tr>
                                            @endif


                                        @endforeach
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane" id="settings">
                                <div class="table-responsive material-datatables">
                                    <table class="table datatables" style="width:100% !important;" >
                                        <thead class=" text-primary">
                                        <tr>
                                            <th>Report Title</th>

                                            <th>Ref No</th>
                                            <th>Property</th>
                                            <th>Manager</th>
                                            <th>Email</th>

                                            <th>date</th>
                                            <th width="15%">Action</th>


                                        </tr>
                                        </thead>
                                        @foreach ($data as $key => $user)
                                            @if($user->bid_status==3)
                                            <tr>
                                                <td>{{ $user->report_title }}</td>

                                                <td>{{ $user->ref_no }}</td>
                                                <td>{{ $user->title }}</td>
                                                <td>{{ $user->first_name }}{{ $user->last_name }} </td>
                                                <td>{{$user->email}}</td>
                                                <td>@if($user->created_at){{date('d-m-Y', strtotime($user->created_at))}}@endif</td>
                                                <td><a  data-toggle="tooltip" data-placement="top" title="Report Details" class="btn btn-link btn-default btn-just-icon edit"  href="/vendor/reportDetails/{{$user->report_id}}"><i class="material-icons">visibility</i></a></td>

                                            </tr>

                                            @endif
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
    <div class="modal fade" id="vendorcreatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="create-vendor-form">
                        <div class="form-group">

                            <label for="recipient-name" class=" bmd-label-floating">Name:</label>
                            <input type="text" name="name" class="form-control"  autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class=" bmd-label-floating">Email:</label>
                            <input type="email" name="email" class="form-control"  autocomplete="off">
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="bmd-label-floating">Address:</label>
                            <textarea type="text" name="address" class="form-control"  5></textarea>
                        </div>

                        <div class="form-group">
                            <label for="message-text" class="bmd-label-floating">Category:</label>
                            <input type="text" name="category" class="form-control"  autocomplete="off">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add-vendor-button" class="btn btn-success" onclick="addVendor()"> Add</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="vendoreditemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Vendor</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="edit-vendor-form">
                        <input type="hidden" name="id" class="form-control" id="recipient-id" autocomplete="off">

                        <div class="form-group">

                            <input type="text" name="name" class="form-control" id="recipient-name" autocomplete="off">
                        </div>
                        <div class="form-group">

                            <input type="email" name="email" class="form-control" id="recipient-email" autocomplete="off">
                        </div>
                        <div class="form-group">

                            <textarea type="text" name="address" class="form-control" id="recipient-address" autocomplete="off"></textarea>
                        </div>

                        <div class="form-group">

                            <input type="text" name="category" class="form-control" id="recipient-category" autocomplete="off">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="edit-vendor-button" class="btn btn-primary" onclick="updateVendor()">Update</button>
                </div>
            </div>
        </div>
    </div>


@endsection

@extends('layouts.admin_layout')

@section('title')

    Manage Rooms

@endsection
@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="pull-right" style="float: right">
                            <button  class="btn btn-success btn-sm" data-toggle="modal" data-target="#vendorcreatemodal" ><i class="fa fa-plus"></i> Assign Rooms</button>
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
                        <div class="table-responsive material-datatables">
                        <table class="table" id="datatables">
                            <thead class=" text-primary">

                            <tr>

                                <th>Floor No</th>
                                <th>Room No</th>
                                <th>Assigned to</th>
                                <th>Assign date</th>

                                <th width="15%">Action</th>
                            </tr>
                            </thead>
                            @foreach ($info as $key => $user)
                                <tr>

                                    <td>{{ str_pad($user->floor, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ str_pad($user->room, 2, '0', STR_PAD_LEFT) }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->date }}</td>

                                    <td>

                                        <button onclick="editRoom({{$user->room_id}})" id="edit{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Edit Property" class="btn btn-link btn-primary btn-just-icon edit" ><i class="material-icons">edit</i></button>
                                        <button  onclick="deleteRoom({{$user->room_id}})"  id="del_{{$user->room_id}}" data-toggle="tooltip" data-placement="top" title="Delete Room" class="btn btn-link btn-danger btn-just-icon"><i class="material-icons ">delete</i></button>

                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        </div>


{{--                        {!! $user->render() !!}--}}


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="vendorcreatemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
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

                                <option>Select Floor</option>

                                @for($i=1 ; $i<=$property->floors;$i++)
                                <option value="{{$i}}">{{str_pad($i, 2, '0', STR_PAD_LEFT)}}</option>

                                    @endfor

                            </select>
                        </div>
                        <div id="showRooms" >

                        </div>

                        <div class="form-group mb-5" style="display: none" id="users">

                            <select   class="form-control" name="user">

                                <option>Select Staff Member</option>

                             @foreach($users as $u)
                                <option value="{{$u->user_id}}">{{$u->first_name}}</option>

                                @endforeach

                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="add-vendor-button" class="btn btn-success" onclick="assignRoom()"> Assign</button>
                </div>
            </div>
        </div>
    </div>
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


@endsection

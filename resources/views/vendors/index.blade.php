@extends('layouts.admin_layout')

@section('title')
    Vendors

@endsection
@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="pull-right" style="float: right">
                            <a href="/vendors/create" class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Add New Vendor</a>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Category</th>
                                <th width="15%">Action</th>
                            </tr>
                            </thead>
                            @foreach ($data as $key => $user)
                                <tr>

                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ ucfirst($user->category) }}</td>

                                    <td>
                                        {{--                                            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>--}}
{{--                                        <a class="btn btn-primary" href="{{ route('vendors.edit',$user->id) }}"><i class="fa fa-pencil"></i> Edit</a>--}}
{{--                                        {!! Form::open(['method' => 'DELETE','route' => ['vendors.destroy', $user->id],'style'=>'display:inline']) !!}--}}
{{--                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}--}}
{{--                                        {!! Form::close() !!}--}}

{{--                                        <a   id="edit{{$user->id}}" class="btn btn-primary btn-sm"  href="{{ route('vendors.edit',$user->id) }} "  ><i class="fa fa-pen"></i> Edit</a>--}}
{{--                                        <button  id="del_{{$user->id}}" class="btn btn-danger btn-sm mt-1 delete"  ><i class="fa fa-trash"></i> Delete</button>--}}
{{--                                        <button  id="generate_{{$user->id}}" class="btn btn-info btn-sm mt-1" onclick="generatePassword({{$user->id}})"  ><i class="fa fa-lock"></i> Generate Password</button>--}}

                                        <a id="edit{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Edit Vendor" class="btn btn-link btn-primary btn-just-icon edit"  href="{{ route('vendors.edit',$user->id) }}"><i class="material-icons">edit</i></a>
                                        <button  id="del_{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Delete Vendor" class="btn btn-link btn-danger btn-just-icon delete"><i class="material-icons ">delete</i></button>
{{--                                        <button  id="generate_{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Generate Password" class="btn btn-link btn-info btn-just-icon" onclick="generatePassword({{$user->id}})"  ><i class="material-icons ">lock</i></button>--}}


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

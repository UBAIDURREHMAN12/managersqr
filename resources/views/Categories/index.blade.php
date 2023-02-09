@extends('layouts.admin_layout')

@section('title')
Categories

@endsection
@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="pull-right" style="float: right">
                            <a href="{{route('categories.create')}}" class="btn btn-success btn-sm add-cat-btn" data-toggle="modal" data-target="#exampleModal" ><i class="fa fa-plus"></i> Add New Category</a>
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
                                <th width="15%">Action</th>
                            </tr>
                            </thead>
                            @foreach ($data as $key => $user)
                                <tr>

                                    <td>{{ $user->name }}</td>
                                    <td>
                                        {{--                                            <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>--}}
{{--                                        <a class="btn btn-primary" href="{{ route('vendors.edit',$user->id) }}"><i class="fa fa-pencil"></i> Edit</a>--}}
{{--                                        {!! Form::open(['method' => 'DELETE','route' => ['vendors.destroy', $user->id],'style'=>'display:inline']) !!}--}}
{{--                                        {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}--}}
{{--                                        {!! Form::close() !!}--}}

{{--                                        <a   id="edit{{$user->id}}" class="btn btn-primary btn-sm"  href="{{ route('vendors.edit',$user->id) }} "  ><i class="fa fa-pen"></i> Edit</a>--}}
{{--                                        <button  id="del_{{$user->id}}" class="btn btn-danger btn-sm mt-1 delete"  ><i class="fa fa-trash"></i> Delete</button>--}}
{{--                                        <button  id="generate_{{$user->id}}" class="btn btn-info btn-sm mt-1" onclick="generatePassword({{$user->id}})"  ><i class="fa fa-lock"></i> Generate Password</button>--}}

{{--                                        <a id="edit{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Edit Category" class="btn btn-link btn-primary btn-just-icon edit"  href="{{ route('categories.edit',$user->id) }}"><i class="material-icons">edit</i></a>--}}
                                        <i class="fa fa-edit" id="{{$user->id}}" title="Edit Category" onClick="divFunction({{ $user->id }})"></i>
                                        <button  id="del_{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Delete Category" class="btn btn-link btn-danger btn-just-icon deleteCategory"><i class="material-icons ">delete</i></button>
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


        <!-- Button trigger modal -->

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <form method="post" action="{{route('categories.store')}}" id="RegisterValidation" >
                                {{ csrf_field() }}
                                <div class="card">
                                    <div class="card-header card-header-primary">
                                        <h4 class="card-title">Add Category</h4>

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
                                                    <input class="form-control"  name="name" value="{{ old('name') }}" minlength="3" maxlength="30"  type="text" placeholder="Name"  required="true" aria-required="true">
                                                </div>
                                            </div>
                                        </div>



                                    </div>

                                </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Add<div class="ripple-container"></div></button>
                    </div>
                </div>
                </form>
            </div>
        </div>


        <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">

                            <div class="col-md-12">
                                <form method="post" action="/categories/update" id="RegisterValidation"  >
                                    {{ csrf_field() }}
                                    <div class="card">
                                        <div class="card-header card-header-primary">
                                            <h4 class="card-title">Update Category</h4>

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
                                            <input class="form-control" name="id"  type="hidden" id="edit_cat_id">

                                            <div class="row">
                                                <label class="col-sm-2 col-form-label">Name</label>
                                                <div class="col-sm-7">
                                                    <div class="form-group bmd-form-group is-filled">
                                                        <input class="form-control"  name="name" id="input-name" minlength="3" maxlength="30"  type="text" placeholder="Name"   required="true" aria-required="true">
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

                        </div>

                </div>
                </form>
            </div>
        </div>

    </div>
    </div>
@endsection

<script>
    $(document).on("click",".add-cat-btn",function() {
       $("#exampleModal").modal('show');
    });


    function divFunction(id){

        $.ajax({
            url: "/edit/cat/"+id,
            success: function(result){

                $("#edit_cat_id").val(result.data.id);
                $("#input-name").val(result.data.name);
                $("#exampleModal2").modal('show');

            }});

    }

</script>

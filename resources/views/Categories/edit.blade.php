@extends('layouts.admin_layout')

@section('title')

    Categories
    @endsection

@section('content')

    <div class="col-md-12">
        <form method="post" action="/categories/update" id="RegisterValidation"  >
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Edit Category</h4>

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
                        <input class="form-control" name="id"  type="hidden" value="{{$category->id}}" >

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled">
                                <input class="form-control" name="name" id="input-name" minlength="3" maxlength="30"  type="text" placeholder="Name" value="{{$category->name}}"  required="true" aria-required="true">
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

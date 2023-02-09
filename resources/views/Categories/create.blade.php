@extends('layouts.admin_layout')
@section('title')
    Vendors

@endsection

@section('content')

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
                <div class="card-footer ml-auto mr-auto">
                    <button type="submit" class="btn btn-primary">Add<div class="ripple-container"></div></button>
                </div>
            </div>
        </form>
    </div>


@endsection

@extends('layouts.admin_layout')
@section('title')
    Welcome Page Note

@endsection

@section('content')
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>


    <div class="col-md-12">
        <form method="post" action="/addNote" id="RegisterValidation" >
            {{ csrf_field() }}
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Add Note</h4>

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
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            <p>{{ $message }}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="row">
                        <label class="col-sm-2 col-form-label">Note</label>
                        <div class="col-sm-7">
                            <div class="form-group bmd-form-group is-filled has-label">
                                <textarea class="form-control"  name="note"  rows="5"  type="text"   required="true" aria-required="true">

                                    @if(isset($property->formNote) && !empty($property->formNote))

                                        {{trim($property->formNote)}}

                                    @else

                                        We give you a legendary welcome, every time you come back.

                                    @endif


                                </textarea>
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

    <script>
        CKEDITOR.replace( 'note' );
    </script>
@endsection

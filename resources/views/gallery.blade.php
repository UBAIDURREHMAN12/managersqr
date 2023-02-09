@extends('layouts.admin_layout')

@section('title')
   Gallery Images

@endsection
@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                  

                    <div class="card-body">
                        @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-dismissible fade show">
                                <p>{{ $message }}</p>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show">
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
                                <th>Image</th>
                                <th width="40%">Action</th>
                            </tr>
                            </thead>
                            @foreach ($data as $key => $user)
                                <tr>
                                    <td><img src="{{$user->image}}" style="height: 60px; margin-bottom: 15px; border-radius:1em;"></td>
                                    
                                    <td>
                                        <a href="{{route('delete.images',$user->id)}}" onclick="return confirm('This will delete image from the gallery')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> </a>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    setTimeout(function() {
    $('.alert').fadeOut('slow');
    $('#alert').fadeOut('slow');
}, 2000); // <-- time in milliseconds
</script>
@endsection

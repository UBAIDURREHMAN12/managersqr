@extends('layouts.admin_layout')

@section('title')
    Custom QrCodes
@endsection
@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="pull-right" style="float: right">
                            <a href="/createQrcode2" class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Generate Custom-Qrcode</a>
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

                        @if(Session::get('data2'))
                                <div class="alert alert-success alert-dismissible fade show">
                                    <p>{{ $data2 }}</p>
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
                                    <th>Company name or title</th>
                                    {{--                                    <th>Website</th>--}}
                                    <th>Info</th>
                                    <th width="40%" style="text-align: center;">Action</th>
                                </tr>
                                </thead>
                                @foreach ($data as $key => $user)
                                    <tr>
                                        <td>{{ $user->company_name_or_title }}</td>
                                        {{--                                        <td>--}}
                                        {{--                                            @if($user->web_link== null && $user->web_id == null)--}}

                                        {{--                                                <span class="badge badge-info" style="background-color: #ff6f67;border-color: #ff6f67;color: #fff;padding: 6px;">&nbsp;Not Added&nbsp;</span>--}}

                                        {{--                                            @elseif($user->web_id!="" || $user->web_id!= null)--}}

                                        {{--                                                <a href="http://managersqr.managershq.com.au/website/{{$user->web_id}}" style="background-color: #0c7ea0;border-color: #0c7ea0" target="_blank" class="btn btn-success btn-sm"><i class="fas fa-link"></i>&nbsp;Visit Website</a>--}}
                                        {{--                                                <a href="{{route('edit.webcontent2',$user->web_id)}}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>--}}

                                        {{--                                            @elseif($user->web_link!= "" || $user->web_link == null)--}}

                                        {{--                                                <a href="{{$user->web_link}}" target="_blank" style="background-color: #0c7ea0;border-color: #0c7ea0" class="btn btn-success btn-sm"><i class="fas fa-link"></i>&nbsp;Visit Website</a>--}}

                                        {{--                                            @endif--}}
                                        {{--                                        </td>--}}
                                        <td>
                                            @if(isset($user->web_link))  {{$user->web_link}} @endif
                                        </td>
                                        <td style="text-align: right;">

                                            @if(strpos($user->web_link,'survey/question/form/'))
                                                <a href="{{'/get/feedbacks/'.explode("/",$user->web_link)[6] }}"><i class="fa fa-eye"></i></a>
                                            @endif

                                            <a href="{{route('downloadsimpleqr',$user->id)}}" style="background-color: #43ad47;border-color: #43ad47" class="btn btn-success btn-sm"><i class="fas fa-download"></i>&nbsp;Download Qr code</a>
                                            <a href="{{route('update.qr',$user->id)}}" class="btn btn-primary btn-sm">Update </a>
                                            <a href="{{route('delete.qrcodes',$user->id)}}" onclick="return confirm('This will delete all data related to this Qrcode')" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> </a>
                                        <!-- <div class="dropdown">
                                    <a  type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                                    <div class="dropdown-menu dropdown-primary">

                                    <a data-toggle="tooltip" data-placement="top" class="dropdown-item" href="/updateTemplate/{{$user->id}}"><i class="fas fa-qrcode"></i>&nbsp;&nbsp;Update existing Qr Code</a>


                                    <a data-toggle="tooltip" data-placement="top" class="dropdown-item" href="{{$user->qrCodelink}}"><i class="fas fa-download"></i>&nbsp;&nbsp;Download Qr code</a>


                                    <a href="{{route('delete.qrcodes',$user->id)}}" class="dropdown-item" ><i class="fas fa-trash"></i>&nbsp;Delete</a>
                                    </div>
                                    </div> -->

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
    <script type="text/javascript">
        setTimeout(function() {
            $('.alert').fadeOut('slow');
            $('#alert').fadeOut('slow');
        }, 2000); // <-- time in milliseconds
    </script>
@endsection

@extends('layouts.admin_layout')

@section('title')
   Properties

@endsection
@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <span class="pull-right" style="float: right">
                            <a href="/createQrcode" class="btn btn-success btn-sm" ><i class="fa fa-plus"></i> Generate Qrcode</a>
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

                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <p>{{ $message }}</p>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                        <div class="table-responsive material-datatables">
                        <table class="table" id="example">
                            <thead class=" text-primary">

                            <tr>

                                <th style="visibility: hidden;">Id</th>
                                <th>Title</th>
                                <th>Property Type</th>
                                <th>Location</th>


                                <th width="15%">Action</th>
                            </tr>
                            </thead>
                            <tbody style="height: 85px">
                            @foreach ($data as $key => $user)
                                <tr>

                                    <td style="visibility: hidden;">{{ $user->id }}</td>
                                    <td>{{ $user->title }}</td>
                                    <td>
                                        @if( $user->des=='other')
                                           Common Area
                                        @else
                                            {{ucfirst($user->des)}}

                                        @endif
                                    </td>
                                    <td>{{ $user->location }}</td>


                                    <td>


                                        <div class="dropdown">

                                            <!--Trigger-->

                                            <a  type="button" id="dropdownMenu2" data-toggle="dropdown"
                                                aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>


                                            <!--Menu-->
                                            <div class="dropdown-menu dropdown-primary">
                                                <a data-toggle="tooltip" data-placement="top" class="dropdown-item" href="/generateQrCode/{{$user->id}}"><i class="fas fa-qrcode"></i>&nbsp;&nbsp;Generate new  Qr code</a>
                                                                                                <a data-toggle="tooltip" data-placement="top" class="dropdown-item" href="/updateTemplate/{{$user->id}}"><i class="fas fa-qrcode"></i>&nbsp;&nbsp;Update existing Qr Code</a>

                                                 @if(isset($user->qrcodeLink) && !empty($user->qrcodeLink))
                                                <a data-toggle="tooltip" data-placement="top" class="dropdown-item" href="{{$user->qrcodeLink}}"><i class="fas fa-download"></i>&nbsp;&nbsp;Download Qr code</a>

                                                @endif

                                                <a  id="edit{{$user->id}}" class="dropdown-item"  href="{{ route('properties.edit',$user->id) }}"><i class="fas fa-pen"></i>&nbsp;Edit Property details</a>
                                                <a id="del_{{$user->id}}"  class="dropdown-item delete_property" ><i class="fas fa-trash"></i>&nbsp;Delete</a>

                                            </div>
                                        </div>

{{--                                        <a  data-toggle="tooltip" data-placement="top" title="Generate qrCode" class="btn btn-link btn-info btn-just-icon"  href="/generateQrCode/{{$user->id}}"><i class="material-icons">qr_code_2</i></a>--}}
{{--                                        <a id="edit{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Edit Content" class="btn btn-link btn-primary btn-just-icon edit"  href="{{ route('properties.edit',$user->id) }}"><i class="material-icons">edit</i></a>--}}
{{--                                        <button  id="del_{{$user->id}}" data-toggle="tooltip" data-placement="top" title="Delete Property" class="btn btn-link btn-danger btn-just-icon delete_property"><i class="material-icons ">delete</i></button>--}}

                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        </div>


{{--                        {!! $user->render() !!}--}}


                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

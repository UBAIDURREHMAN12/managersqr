@extends('layouts.vendor_layout')

@section('title')
   Report Detail

@endsection
@section('content')

    <style>

        #invoice{
            padding: 30px;
        }

        .invoice {
            position: relative;
            background-color: #FFF;
            min-height: 680px;
            padding: 15px
        }

        .invoice header {
            padding: 10px 0;
            margin-bottom: 20px;
            border-bottom: 1px solid #3989c6
        }

        .invoice .company-details {
            text-align: right
        }

        .invoice .company-details .name {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .contacts {
            margin-bottom: 20px
        }

        .invoice .invoice-to {
            text-align: left
        }

        .invoice .invoice-to .to {
            margin-top: 0;
            margin-bottom: 0
        }

        .invoice .invoice-details {
            text-align: right
        }

        .invoice .invoice-details .invoice-id {
            margin-top: 0;
            color: #3989c6
        }

        .invoice main {
            padding-bottom: 50px
        }

        .invoice main .thanks {
            margin-top: -100px;
            font-size: 2em;
            margin-bottom: 50px
        }

        .invoice main .notices {
            padding-left: 6px;
            border-left: 6px solid #3989c6
        }

        .invoice main .notices .notice {
            font-size: 1.2em
        }

        .invoice table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px
        }

        .invoice table td,.invoice table th {
            padding: 15px;
            background: #eee;
            border-bottom: 1px solid #fff
        }

        .invoice table th {
            white-space: nowrap;
            font-weight: 400;
            font-size: 16px
        }

        .invoice table td h3 {
            margin: 0;
            font-weight: 400;
            color: #3989c6;
            font-size: 1.2em
        }

        .invoice table .qty,.invoice table .total,.invoice table .unit {
            text-align: right;
            font-size: 1.2em
        }

        .invoice table .no {
            color: #fff;
            font-size: 1.6em;
            background: #3989c6
        }

        .invoice table .unit {
            background: #ddd
        }

        .invoice table .total {
            background: #3989c6;
            color: #fff
        }

        .invoice table tbody tr:last-child td {
            border: none
        }

        .invoice table tfoot td {
            background: 0 0;
            border-bottom: none;
            white-space: nowrap;
            text-align: right;
            padding: 10px 20px;
            font-size: 1.2em;
            border-top: 1px solid #aaa
        }

        .invoice table tfoot tr:first-child td {
            border-top: none
        }

        .invoice table tfoot tr:last-child td {
            color: #3989c6;
            font-size: 1.4em;
            border-top: 1px solid #3989c6
        }

        .invoice table tfoot tr td:first-child {
            border: none
        }

        .invoice footer {
            width: 100%;
            text-align: center;
            color: #777;
            border-top: 1px solid #aaa;
            padding: 8px 0
        }

        @media print {
            .invoice {
                font-size: 11px!important;
                overflow: hidden!important
            }

            .invoice footer {
                position: absolute;
                bottom: 10px;
                page-break-after: always
            }

            .invoice>div:last-child {
                page-break-before: always
            }
        }
        .bottom-right {
            position: absolute;
            right: 20px;
            bottom: 5px;
            background: #ff6e66;
            color: white;
            padding: 15px;
            opacity: 0.9;
        }


    </style>
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-12">

                    <div class="card">
                        <div class="card-header card-header-tabs card-header-primary">
                            Report detail
                        </div>
                        <div class="card-body">
                            <div id="invoice">

                                <div class="toolbar hidden-print">
                                    <div class="text-right">
{{--                                        <button id="printInvoice" class="btn btn-info"><i class="fa fa-print"></i> Print</button>--}}

                                        @if($check>0)
                                            <H4 class="badge badge-success"> Quote placed </H4>

                                        @else
                                            <a href="/vendor/createBid/{{$data->report_id}}" class="btn btn-primary"><i class="material-icons">check_circle</i> Place Quote </a>
                                         @endif
                                    </div>
                                    <hr>
                                </div>
                                <div class="invoice overflow-auto">
                                    <div style="min-width: 600px">
                                        <header>
                                            <div class="row">
                                                <div class="col">
                                                    <a class="thumbnail" target="_blank" href="https://lobianijs.com">
                                                        <img  style="width:35%;" src="{{$data->image}}" data-holder-rendered="true" />
                                                    </a>
                                                </div>
                                                <div class="col company-details">

                                                    <div class="date"><strong>Date</strong>:{{ date('d/m/Y ',$data->report_creation_time/1000) }}</div>
                                                    <h2 class="name">
                                                        <a target="_blank" href="#">
                                                            {{$data->title}}
                                                        </a>
                                                    </h2>
                                                    <div><strong>Title Ref</strong>:{{$data->ref_no}}</div>
                                                    <div><strong>Manager</strong>:{{$data->first_name}} {{$data->last_name}}</div>
                                                    <div><strong>Contact</strong>:{{$data->email}}</div>


                                                </div>
                                            </div>
                                        </header>
                                        <main>

                                            <div class="col-sm-12">
                                                @if (count($notes_array)>0)
                                            @foreach($notes_array as $note)


                                                <h2>{{$note['title']}}</h2>

                                                <p>{{$note['des']}}.</p>
                                                        <p><strong>Category : </strong><i class="badge badge-primary">{{$note['category']}}</i>   @if(!empty($note['subcategory']))<strong style="margin-left: 10px">Subcategory : </strong><i class="badge badge-primary">{{$note['subcategory']}}</i> @endif</p>

                                                        @if(!empty($note['number_plate']))
                                                            <p><strong>Registration Data : </strong>{{$note['number_plate']}}</p>
                                                        @endif

                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="row">

                                                                @foreach ($note['images'] as $img)
                                                                <div class="col-lg-4 col-md-6 col-xs-6 thumb">
                                                                    <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                                                                       data-image="https://images.pexels.com/photos/853168/pexels-photo-853168.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                                                                       data-target="#image-gallery">
                                                                        <img class="img-thumbnail"
                                                                             src="{{$img->image}}"
                                                                             alt="Notes image">
{{--                                                                        <div class="bottom-right">{{ date('d/m/Y ',$img->date/1000) }}</div>--}}

                                                                    </a>
                                                                </div>

                                                                    @endforeach


                                                            </div>


{{--                                                            <div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">--}}
{{--                                                                <div class="modal-dialog modal-lg">--}}
{{--                                                                    <div class="modal-content">--}}
{{--                                                                        <div class="modal-header">--}}
{{--                                                                            <h4 class="modal-title" id="image-gallery-title"></h4>--}}
{{--                                                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span>--}}
{{--                                                                            </button>--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="modal-body">--}}
{{--                                                                            <img id="image-gallery-image" class="img-responsive col-md-12" src="">--}}
{{--                                                                        </div>--}}
{{--                                                                        <div class="modal-footer">--}}
{{--                                                                            <button type="button" class="btn btn-secondary float-left" id="show-previous-image"><i class="fa fa-arrow-left"></i>--}}
{{--                                                                            </button>--}}

{{--                                                                            <button type="button" id="show-next-image" class="btn btn-secondary float-right"><i class="fa fa-arrow-right"></i>--}}
{{--                                                                            </button>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                            </div>--}}
                                                        </div>
                                                    </div>

{{--                                                    @foreach($note['images'] as $n)--}}

{{--                                                                <img  width="50%" src="{{$n->image}}" class="img-responsive">--}}




{{--                                                @endforeach--}}



                                                @endforeach
                                                @else
                                                    <p class="alert alert-danger" > Notes not found !</p>
                                                @endif
                                            </div>

                                        </main>

                                    </div>
                                    <!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
                                    <div></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <script>

    </script>

@endsection

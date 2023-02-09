



<div style=" position: absolute;
            z-index: 99999;
            width: 80%;
            text-align: center;
            font-size: 1.5em;
            color: #fff;
            line-height: 1.5;
            background: {{$data['background']}};" class="col-md-12">
    <div class="row" >
        <div class="box text col-md-6">

{{--            <img class="d-block mx-auto " src="{{session()->get('companylogo')}}"  alt="" > --}}
            <img class="d-block mx-auto " src="{{$logoUrl}}"  alt="" >


        </div>
    </div>

    <div class="row"  style="margin-top: 5rem;">
        <div class="text col-md-12">

            <h3 style="text-align:center;font-weight: 600;font-size:39px;font-family: 'Roboto';color:{{$data['textColor']}}; ">{{$data['textLine1']}}</h3>
            <h3 style="text-align:center;font-weight: 600;font-size:39px;bottom: 1.5rem;position: relative;font-family: 'Roboto';color:{{$data['textColor']}}; ">{{$data['textLine2']}}</h3>

        </div>

    </div>

    <div class="row">
        <div class=" text col-md-8 ">
            <img class="d-block mx-auto" height="200" src="{{$qrCode}}"  alt="" >

        </div>

    </div>


    <div class="row mt-5">
        <div class=" text col-md-6 ">
            @if($data['showlink']==1)
                @if(!empty($data['link']))
            <h5 style="font-weight: 800;font-family: 'Roboto';color:{{$data['linkColor']}}">{{$data['title']}}</h5>
            <small style="    position: relative;
    font-weight: 100;

    bottom: 20px;    font-size: 1vw;font-family: 'Roboto';color:{{$data['linkColor']}}">{{$data['link']}}</small>
                    @endif
            @endif
        </div>

    </div>


</div>

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Gallery;
use App\CustomWeb;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function website(Request $request,$id){

    	$data =  CustomWeb::findorfail($id);

    	$gallery  = Gallery::where('web_id',$id)->get();

        if(count($gallery) > 0){
            return view('web',compact('data','gallery'));

        }
        else{
            return view('web2',compact('data'));
        }


    }
}

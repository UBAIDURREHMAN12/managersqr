<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    function updateNotificationStatus(request $request){

        $firestore = app('firebase.firestore');
        $db=$firestore->database();
        $cityRef =  $db->collection('managersqr')->document($request->id);
        $cityRef->update(array(
            array('path' => 'read', 'value' => false),
        ));

        $feedback=db::table('Notifications')->where('feedback_id',$request->feedback_id)->count();
        if($feedback==0){
            $data=array(
                'message'=>$request->message,
                'org_id'=>$request->user_id,
                'feedback_id'=>$request->feedback_id
            );

            $id=db::table('Notifications')->insertGetId($data);
        }

        return response()->json($id);
    }


    function deleteNotification(Request $request){

        db::table('Notifications')->where('id',$request->id)->delete();

    }
}

<?php

namespace App\Http\Controllers;

use App\property;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use MongoDB\Driver\Session;

class adminController extends Controller
{

    // this is constructor function
    // where we defined auth middleware so it's functions will not
    // available with out of authenticating a user
    public function __construct()
    {
        $this->middleware('auth');
    }


    public  function index(){

        try{
            $properties=property::where('user_id',Auth::user()->id)->count();

//            $notifications=DB::table('Notifications')
//                ->select('*','Notifications.id as not_id')
//                ->join('Orders','Notifications.feedback_id','=','Orders.id')
//                ->where([['Notifications.org_id',Auth::user()->id],['Notifications.type','web']])->orderBy('Notifications.id','desc')->groupBy('Notifications.id')->get();
//
            $notifications = [];

            //guest active

            $active=db::table('Orders')
                ->join('properties','Orders.property_id','=','properties.id')
                ->where([['properties.user_id',Auth::user()->id],['Orders.user','guest'],['properties.id',session()->get('property')]])->count();



            //housekeeping active

            $activeH=db::table('Orders')
                ->join('properties','Orders.property_id','=','properties.id')
                ->where([['properties.user_id',Auth::user()->id],['Orders.user','housekeeping'],['properties.id',session()->get('property')]])->count();

            //guest Counter

            $guestOpen=db::table('Orders')
                ->join('properties','Orders.property_id','=','properties.id')
                ->where([['properties.user_id',Auth::user()->id],['Orders.active',0],['Orders.user','guest'],['properties.id',session()->get('property')]])->count();

            $guestClose=db::table('Orders')
                ->join('properties','Orders.property_id','=','properties.id')
                ->where([['properties.user_id',Auth::user()->id],['Orders.active',1],['Orders.user','guest'],['properties.id',session()->get('property')]])->count();


            //housekeeping counter
            $housekeepingOpen=db::table('Orders')
                ->join('properties','Orders.property_id','=','properties.id')
                ->where([['properties.user_id',Auth::user()->id],['Orders.active',0],['Orders.user','housekeeping'],['properties.id',session()->get('property')]])->count();

            $housekeepingClose=db::table('Orders')
                ->join('properties','Orders.property_id','=','properties.id')
                ->where([['properties.user_id',Auth::user()->id],['Orders.active',1],['Orders.user','housekeeping'],['properties.id',session()->get('property')]])->count();

            $userType = db::table('feedback_type')->where('user_id',Auth::user()->id)->get();

            $open=0;

            $openArray=array();
            foreach($userType as $u){

                $housekeepingOpen=db::table('Orders')
                    ->join('properties','Orders.property_id','=','properties.id')
                    ->where([['properties.user_id',Auth::user()->id],['Orders.active',0],['Orders.user',$u->feedback],['properties.id',session()->get('property')]])->count();
                $open=$open+$housekeepingOpen;

                $openCounter=array(
                    'userType'=>$u->feedback,
                    'counter'=>$housekeepingOpen

                );
                array_push($openArray,$openCounter);

            }
            $closedArray=array();

            $closed=0;
            foreach($userType as $u){

                $housekeepingClose=db::table('Orders')
                    ->join('properties','Orders.property_id','=','properties.id')
                    ->where([['properties.user_id',Auth::user()->id],['Orders.active',1],['Orders.user',$u->feedback],['properties.id',session()->get('property')]])->count();
                $closed=$closed+$housekeepingClose;

                $closedCounter=array(
                    'userType'=>$u->feedback,
                    'counter'=>$housekeepingClose

                );
                array_push($closedArray,$closedCounter);

            }


            return view('admin.index',compact('properties','notifications','openArray','closedArray','open','closed'));
        } catch (\Exception $e) {

            return $e->getMessage();
        }

    }


        public function logout(Request $request) {
            auth('web')->logout();
            session()->flush();
            return redirect('/login');
        }


    public function subscription(){
        $subscription=db::table('user_subscriptions')->where('user_id',Auth::user()->id)->first();
        $card=db::table('card_details')->where('user_id',Auth::user()->id)->first();

        return view('subscription', compact('subscription','card'));
    }


    public function manageWelcomPage(){
        $feedbacks = db::table('feedback_type')->where('user_id',Auth::user()->id)->orderBy('id','desc')->get();
        return view('manageWelcomPage',compact('feedbacks'));
    }

    public function getUserTypeData($id){
        $feedbacks = db::table('feedback_type')->where('id', $id)->where('user_id',Auth::user()->id)->first();
        return response()->json(['feedbacks' => $feedbacks]);

    }

    public function UpdateKey($feedbackId, $password=null){

        DB::table('feedback_type')
            ->where('id', $feedbackId)
            ->update(['password' => $password]);

    }


    function addFeedbackType(request $request){


        // remove special characaters from feedback
//    $get_feedback = preg_replace('/[^A-Za-z0-9\-]/', '', $request->feedback);
        $get_feedback = $this->RemoveSpecialChar($request->feedback);

        // remove hyphens from string
//        echo $feedback2 = str_replace(' ', '-', $get_feedback);


        //remoce all blank spaces from string
//        $finalFeedback =  str_replace(' ', '', $feedback2);
        $finalFeedback =  trim($get_feedback);

        $isAlreadyExist = DB::table('feedback_type')->where('feedback', $finalFeedback)->first();

        if($isAlreadyExist){
            return response()->json(['success'=>166,'action'=>'alreadyExist']);
        }



        if(!empty($request->feedback)){
            $feedbackId=db::table('feedback_type')->insertGetId(['feedback'=> $finalFeedback ,'password'=> trim($request->password),'user_id'=>Auth::user()->id]);
            $feedback = db::table('feedback_type')->where('id',$feedbackId)->first();

            return response()->json(['success'=>1,'action'=>'add','feedback'=>$feedback ]);

        }else{
            return response()->json(['success'=>0]);

        }
    }


    public function RemoveSpecialChar($str) {

        // Using str_replace() function
        // to replace the word
        $res = str_replace( array( '\'', '"',
            ',' , ';', '<', '>' , '%', '@', '#', '$', '%', '^', '&', '*', '(', ')', '_', '-', '+', '='), ' ', $str);

        // Returning the result
        return $res;
    }

    public function updateFeedback(request $request){

        // remove special characaters from feedback
//    $get_feedback = preg_replace('/[^A-Za-z0-9\-]/', '', $request->feedback);
        $get_feedback = $this->RemoveSpecialChar($request->feedback);

        // remove hyphens from string
//        echo $feedback2 = str_replace(' ', '-', $get_feedback);


        //remoce all blank spaces from string
//        $finalFeedback =  str_replace(' ', '', $feedback2);
        $finalFeedback =  trim($get_feedback);

        try {

            if($request->id==0 ){

                if(!empty($request->feedback)){
                    $feedbackId=db::table('feedback_type')->insertGetId(['feedback'=> $finalFeedback,'user_id'=>Auth::user()->id]);
                    $feedback = db::table('feedback_type')->where('id',$feedbackId)->first();

                    return response()->json(['success'=>1,'action'=>'add','feedback'=>$feedback ]);

                }else{
                    return response()->json(['success'=>0]);

                }


            }else{

                if(!empty($request->feedback)){
                    db::table('feedback_type')->where('id',$request->id)->update(['feedback'=> $finalFeedback,'password'=> trim($request->password)]);

                    return response()->json(['success'=>1,'action'=>'update']);

                }else{
                    return response()->json(['success'=>0]);

                }



            }

        } catch (\Exception $e) {

            return $e->getMessage();
        }


    }

    function deleteFeedbacktype(request $request){


       $delete = db::table('feedback_type')->where('id',$request->id)->delete();

       if($delete==1){
           return response()->json(['success'=>1]);

       }else{
           return response()->json(['success'=>0]);

       }




    }


    function getFeedbackType(request $request){

        $user = db::table('feedback_type')->where([['feedback',$request->user],['user_id',Auth::user()->id]])->first();


        if(!empty(trim($user->password))){
            return response()->json(['result'=>1]);


        }else{
            return response()->json(['result'=>0]);

        }



    }

    function manageWelcomeNote(){

         $property = db::table('properties')->where('id',session()->get('property'))->first();

        return view('manageWelcomeNote',compact('property'));
    }

    function addNote(request $request){

        $this->validate($request, [
            'note' => 'required',

        ]);

         if(Session()->has('property')){
             db::table('properties')->where('id',Session()->get('property'))->update(['formNote'=>trim($request->note)]);
             return redirect('/manageWelcomeNote')->with(['success'=>'Note added successfully']);

         }else{

             return redirect('/manageWelcomeNote')->withErrors(['error'=>'Please Select Property before adding note']);

         }

    }

}
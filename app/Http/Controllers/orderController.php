<?php

namespace App\Http\Controllers;

use App\Mail\Feedbacks;
use App\Mail\sendReport;
use App\Mail\vendorPassword;
use App\order;
use App\User;
use Illuminate\Http\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;


class orderController extends Controller
{




    // following function is use to return a page  where we can get feedback against a property or apartment etc
    // this function get all of required data from database which we need to compact to html view and render form view
      public  function index($id){
          $qrCodeData=db::table('qrocde_info')->where('id',$id)->first();

          $property=db::table('properties')->where('id',$qrCodeData->property_id)->first();
          $categories=db::table('categories')->where('user_id',$property->user_id)->get();
          $feedbacks = db::table('feedback_type')->where('user_id',$property->user_id)->get();

          return view('form',compact('property','qrCodeData','categories','feedbacks'));

      }


      // followiong function is use to take feedback against apartment etc
    // and save into firebase data base and fire a notification to admin dashboard
      public function submitForm(request $request){

          $this->validate($request, [
              'order' => 'required',
              'note'=>'required',
            //   'pro-image.*' => 'mimes:png,jpg,jpeg'
          ]);

          if(isset($request->key)){
               $password=$request->key;

          }else{
              $password="";
          }

          //key validation

            if(isset($request->key)){
                   $check=db::table('feedback_type')->where([['password',$password],['feedback',$request->user]])->count();

              if($check==0){
                  return redirect()->back()->withErrors(['error'=>'Invalid Key']);
              }
            }

            // following firebase is using to save notifications for example
          // whenever we receives a notification against an apartment ect then
          // we fired notification from database
          $firestore = app('firebase.firestore');
          $db = $firestore->database();

          $property = DB::table('properties')->where('id', $request->property_id)->first();
       $title=$property->title."'s";

          if($property->des=='units' || $property->des=='Apartments'){

                  if($request->room_id>0){
                      $message = $request->user.' feedback received for <b>' . strtoupper($title) . '</b> floor no : <b>' . str_pad($request->floor_id, 2, '0', STR_PAD_LEFT). '</b> room no : <b>'  . str_pad($request->room_id, 2, '0', STR_PAD_LEFT) . '</b>';

                  }else{
                      $message = $request->user.' feedback received for <b>' . strtoupper($title) . '</b> floor no : <b>' . str_pad($request->floor_id, 2, '0', STR_PAD_LEFT);

                  }


          }elseif($property->des=='other'){

                  $message = $request->user.' Feedback received for <b>'.strtoupper($title).' for </b> common area : <b>'.$request->area .'</b>';




          }else{
                  $message = $request->user.' Feedback received for <b>'.strtoupper($title);



          }



          $id=db::table('Orders')->insertGetId($request->except('_token','key','g-recaptcha-response','pro-image'));


             $property=db::table('properties')->where('id',$request->property_id)->first();
             $user=User::where('id',$property->user_id)->first();

               $order=order::where('id',$id)->first();
          Mail::to($user->email)->send(new Feedbacks($order,$user));
          $noti = [
              'message' => $message,
              'user_id' => $property->user_id,
              'read' => true,
              'feedback_id'=>$id

          ];
          //$db->collection('managersqr')->add($noti);




          //add image

          if($request->hasfile('pro-image'))
          {
              foreach($request->file('pro-image') as $file)
              {
                  $name = time().rand().'.'.$file->extension();
                  $file->move(public_path().'/feedbackImages/', $name);


                  $imageData=array(
                      'feedback_id'=>$id,
                      'image'=>'/public/feedbackImages/'.$name
                  );

                  db::table('feedbac_images')->insert($imageData);

              }
          }

//          //////////////////////////////////////////////////////////////////////////

          try {
              $feedback=db::table('Orders')
                  ->select('*','Orders.id as order_id')
                  ->join('categories','Orders.order','=','categories.id')
                  ->where('Orders.id',$id)->first();

//              $email = 'ubaidurrehman1001@gmail.com';

//              $userData = User::find(Auth::user()->id);

              $attachment=0;

              if(isset($input['form'][3]['value'])){
                  $attachment =1;
              }

//              foreach(json_decode($emails) as $email){
                Mail::to($user->email)->send(new sendReport($feedback->name,$feedback->note,'Test',$feedback->order_id,$attachment));
//              }

          } catch (\Exception $e) {

              return $e->getMessage();
          }


//          /////////////////////////////////////////////////////////////////////////////////////////////////////
//          return redirect()->back()->with(['success'=>'Your Feedback Sent Successfully !']);
          return redirect()->back()->with('message', 'Your Feedback Sent Successfully !');
      }


      function sendReport(request $request){

          $input=$request->all();

          $feedback=db::table('Orders')
              ->select('*','Orders.id as order_id')
              ->join('categories','Orders.order','=','categories.id')
              ->where('Orders.id',$input['form'][0]['value'])->first();



          $emails= $input['form'][1]['value'];

          $attachment=0;

          if(isset($input['form'][3]['value'])){
              $attachment =1;
          }

//           foreach(json_decode($emails) as $email){
//               Mail::to($email)->send(new sendReport($feedback->name,$feedback->note,$input['form'][2]['value'],$feedback->order_id,$attachment));
//           }

          for($i=0; $i < count(json_decode($emails)); $i++){
              Mail::to(json_decode($emails)[$i])->send(new sendReport($feedback->name,$feedback->note,$input['form'][2]['value'],$feedback->order_id,$attachment));
          }

          $history=array(
              'receiver_email'=>$emails,
              'admin_note'=>$input['form'][2]['value'],
              'feedback_id'=>$feedback->order_id

          );
          db::table('feedback_send_history')->insert($history);

          Session::flash('message', 'Report sent successfully!');
          Session::flash('alert-class', 'alert-success');


      }

      function getFeedback($id){

          $feedbacks=db::table('feedback_send_history')
              ->where('feedback_send_history.feedback_id',$id)
              ->get();
          $feedback=db::table('Orders')
              ->select('*','Orders.id as order_id')
              ->join('categories','Orders.order','=','categories.id')
              ->where('Orders.id',$id)->first();
          $feedbackImages=db::table('feedbac_images')->where('feedback_id',$id)->get();


          return view('Feedbacks.view',compact('feedbacks','feedback','feedbackImages'));



      }

    function getFeedbackType(request $request){
           $property = db::table('properties')->where('id',$request->property)->first();



        $user = db::table('feedback_type')->where([['feedback',$request->user],['user_id',$property->user_id]])->first();


        // $user = db::table('feedback_type')->where([['feedback',$request->user],['user_id',Auth::user()->id]])->first();


        if(!empty(trim($user->password))){
            return response()->json(['result'=>1]);


        }else{
            return response()->json(['result'=>0]);

        }



    }







}

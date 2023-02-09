<?php

namespace App\Http\Controllers;




use App\Mail\vendorPassword;
use App\User;
use App\TempData;
use App\Vendor;
use App\vendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use mysql_xdevapi\Exception;
use Session;
use Stripe;
use Throwable;

class PaymentController extends Controller
{

    public function stripe()
    {
        return view('auth.stripe');
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {

        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            //create customer
            $customer=Stripe\Customer::create([
                'name'=>session()->get('first_name').' '.session()->get('first_name'),
                'email'=>session()->get('email'),
                'address'=>['line1'=>session()->get('address')],
                'phone' => session()->get('phone'),
                'source'=>$request->stripeToken
            ]);

            //subscribe
            $subsData =  Stripe\Subscription::create([
                'customer' => $customer->id,
//                'cancel_at_period_end' => true,

                'items' => [
                    ['price' => 'price_1HzeBIIXE1VWjsYwNH0if6Fq'],
                ],
            ]);




            if($subsData->status=='active'){


                $subscrID = $subsData->id;
                $custID = $subsData->customer;
                $planID = $subsData->plan->id;
                $planAmount = ($subsData->plan->amount/100);
                $planCurrency = $subsData->plan->currency;
                $planinterval = $subsData->plan->interval;
                $planIntervalCount = $subsData->plan->interval_count;
                $created = date("Y-m-d H:i:s", $subsData->created);
                $current_period_start = date("Y-m-d H:i:s", $subsData->current_period_start);
                $current_period_end = date("Y-m-d H:i:s", $subsData->current_period_end);
                $status = $subsData->status;
                $user = User::create([
                    'first_name' => session()->get('first_name'),
                    'last_name' => session()->get('last_name'),
                    'email' => session()->get('email'),
                    'password' => Hash::make(session()->get('password')),
                    'subcription_id'=>$subscrID,
                    'customer_id'=>$custID,

                ]);

                DB::table('user_subscriptions')->insert([

                    'user_id'=>$user->id,
                    'payment_method'=>'stripe',
                    'stripe_subscription_id'=>$subscrID,
                    'stripe_customer_id'=> $custID,
                    'stripe_plan_id'=>$planID,
                    'plan_amount'=>$planAmount,
                    'plan_amount_currency'=>$planCurrency,
                    'plan_interval'=> $planinterval,
                    'plan_interval_count'=>$planIntervalCount,
                    'payer_email'=>$user->email,
                    'created'=>$created,
                    'plan_period_start'=>$current_period_start,
                    'plan_period_end'=>$current_period_end,
                    'status'=>$status
                ]);
                DB::table('card_details')->insert([

                    'user_id'=>$user->id,
                    'card_no'=>$request->number,
                    'month'=>$request->month,
                    'year'=>$request->year,
                    'cvc'=>$request->cvc

                ]);



                $categories= DB::table('categories')->where('user_id','=',1)->get();

                foreach($categories as $c){
                    $data=array(

                        'user_id'=>$user->id,
                        'name'=>$c->name,

                    );
                    $category_id= DB::table('reports_category')->insertGetId($data);

                }

                $data33 = TempData::where('email', session()->get('email'))->first();

                if($data33){
                    $data33->delete();
                }

                Session::flash('status', 'Registration has been completed successfully , Please login into you account!');
                return redirect('/login');


            }else{
                Session::flash('error', 'Your payment was not successful,please try again!');

                return back();
            }

        } catch(\Stripe\Exception\CardException $e) {

            Session::flash('error', $e->getError()->message);

            return back();


        } catch (\Stripe\Exception\RateLimitException $e) {
            Session::flash('error', $e->getError()->message);

            return back();

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            Session::flash('error', $e->getError()->message);

            return back();
        } catch (\Stripe\Exception\AuthenticationException $e) {
            Session::flash('error', $e->getError()->message);

            return back();

        } catch (\Stripe\Exception\ApiConnectionException $e) {
            Session::flash('error', $e->getError()->message);

            return back();

        } catch (\Stripe\Exception\ApiErrorException $e) {
            Session::flash('error', $e->getError()->message);
            return back();

        } catch (Exception $e) {
            Session::flash('error', 'Something went wrong !');

            return back();

        }
    }


    public function attach_customer($payment,$customer){


        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')
        );
        try {
            $o=$stripe->paymentMethods->attach(
                $payment,
                ['customer' => $customer]
            );


        } catch (Stripe\Exception\ApiErrorException $e) {
        }
    }

    function cancelSubscription(){
        $sub = db::table('user_subscriptions')->where('user_id', Auth::user()->id)->first();


        $today = date("Y/m/d");

        $end = explode(' ',$sub->plan_period_end);

        if($today < $end[0]){
             db::table('user_subscriptions')->where('user_id', Auth::user()->id)->update(['status'=>'pause']);
             Session::flash('success', 'Subscription canceled successfully , Your subscription will end on '. $end[0]);
             return back();

        }else{
            try {
                $stripe = new \Stripe\StripeClient(
                    env('STRIPE_SECRET')            );
//           $stripe= Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
//           $cancel= Stripe\Subscription::cancel(
//                $sub->stripe_subscription_id ,
//                []
//            );
                $cancel= $stripe->subscriptions->cancel(
                    $sub->stripe_subscription_id ,
                    []
                );


                if($cancel->status=='canceled'){
                    Session::flash('success', 'Subscription canceled successfully !');

                    db::table('user_subscriptions')->where('user_id', Auth::user()->id)->update(['status'=>$cancel->status]);

                }
                return back();


            } catch(\Stripe\Exception\CardException $e) {

                Session::flash('error', $e->getError()->message);

                return back();


            } catch (\Stripe\Exception\RateLimitException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\InvalidRequestException $e) {
                Session::flash('error', $e->getError()->message);

                return back();
            } catch (\Stripe\Exception\AuthenticationException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\ApiConnectionException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\ApiErrorException $e) {
                Session::flash('error', $e->getError()->message);
                return back();

            } catch (Exception $e) {
                Session::flash('error', 'Something went wrong !');

                return back();

            }

        }





    }

    function detachCard(){
       $card = DB::table('users')->where('id',Auth::user()->id)->first();

        try {

        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET')    );
        $cus=$stripe->customers->retrieve(
            $card->customer_id,
            []
        );


        if(!empty($cus->default_source)){
            $deattch=$stripe->customers->deleteSource(
                $cus->id,
                $cus->default_source,
                []
            );
        }else{

            Session::flash('error', 'Something went wrong!');

            return back();
        }




         if($deattch->deleted){
             DB::table('card_details')->where('user_id',Auth::user()->id)->delete();
             Session::flash('success', 'Card detached successfully!');

             return back();
         }else{
             Session::flash('error', 'Something went wrong!');

             return back();
         }



        } catch(\Stripe\Exception\CardException $e) {

            Session::flash('error', $e->getError()->message);

            return back();


        } catch (\Stripe\Exception\RateLimitException $e) {
            Session::flash('error', $e->getError()->message);

            return back();

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            Session::flash('error', $e->getError()->message);

            return back();
        } catch (\Stripe\Exception\AuthenticationException $e) {
            Session::flash('error', $e->getError()->message);

            return back();

        } catch (\Stripe\Exception\ApiConnectionException $e) {
            Session::flash('error', $e->getError()->message);

            return back();

        } catch (\Stripe\Exception\ApiErrorException $e) {
            Session::flash('error', $e->getError()->message);
            return back();

        } catch (Exception $e) {
            Session::flash('error', 'Something went wrong !');

            return back();

        }
    }


    function detachPaymentCard(){

        try {

            $card = DB::table('users')->where('id',session()->get('user_id'))->first();

            try {

                $stripe = new \Stripe\StripeClient(
                    env('STRIPE_SECRET')    );
                $cus=$stripe->customers->retrieve(
                    $card->customer_id,
                    []
                );


                if(!empty($cus->default_source)){
                    $deattch=$stripe->customers->deleteSource(
                        $cus->id,
                        $cus->default_source,
                        []
                    );
                }else{

                    Session::flash('error', 'Something went wrong!');

                    return back();
                }




                if($deattch->deleted){
                    DB::table('card_details')->where('user_id',session()->get('user_id'))->delete();
                    Session::flash('success', 'Card detached successfully!');

                    return back();
                }else{
                    Session::flash('error', 'Something went wrong!');

                    return back();
                }



            } catch(\Stripe\Exception\CardException $e) {

                Session::flash('error', $e->getError()->message);

                return back();


            } catch (\Stripe\Exception\RateLimitException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\InvalidRequestException $e) {
                Session::flash('error', $e->getError()->message);

                return back();
            } catch (\Stripe\Exception\AuthenticationException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\ApiConnectionException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\ApiErrorException $e) {
                Session::flash('error', $e->getError()->message);
                return back();

            } catch (Exception $e) {
                Session::flash('error', 'Something went wrong !');

                return back();

            }


        } catch (Throwable $e) {
            report($e);

            return false;
        }

    }


    function attachCard(request $request){
        $user=db::table('users')->where('id',Auth::user()->id)->first();


        try {


            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')    );

            $token= $stripe->tokens->create([
                'card' => [
                    'number' => $request->cardNumber,
                    'exp_month' =>$request->month,
                    'exp_year' => $request->year,
                    'cvc' => $request->cvc,
                ],
            ]);

          $card =   $stripe->customers->createSource(
                $user->customer_id,
                ['source' => $token->id]
            );

          if(isset($card->id)){

              DB::table('card_details')->insert([

                  'user_id'=>$user->id,
                  'card_no'=>$request->cardNumber,
                  'month'=>$request->month,
                  'year'=>$request->year,
                  'cvc'=>$request->cvc

              ]);
              Session::flash('success', 'Card attached successfully!');

              return back();
          }else{
              Session::flash('error', 'Something went wrong!');

          }

        } catch(\Stripe\Exception\CardException $e) {

            Session::flash('error', $e->getError()->message);

            return back();


        } catch (\Stripe\Exception\RateLimitException $e) {
            Session::flash('error', $e->getError()->message);

            return back();

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            Session::flash('error', $e->getError()->message);

            return back();
        } catch (\Stripe\Exception\AuthenticationException $e) {
            Session::flash('error', $e->getError()->message);

            return back();

        } catch (\Stripe\Exception\ApiConnectionException $e) {
            Session::flash('error', $e->getError()->message);

            return back();

        } catch (\Stripe\Exception\ApiErrorException $e) {
            Session::flash('error', $e->getError()->message);
            return back();

        } catch (Exception $e) {
            Session::flash('error', 'Something went wrong !');

            return back();

        }

    }


    function user_subscription(){

        try {
            $sub = DB::table('user_subscriptions')->where('user_id',Auth::user()->id)->first();
            $user = DB::table('users')->where('id',Auth::user()->id)->first();


            try {
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                $subsData =  Stripe\Subscription::create([
                    'customer' => $user->customer_id,

                    'items' => [
                        ['price' => 'price_1HzeBIIXE1VWjsYwNH0if6Fq'],
                    ],
                ]);
                if($subsData->status=='active'){


                    $subscrID = $subsData->id;
                    $custID = $subsData->customer;
                    $planID = $subsData->plan->id;
                    $planAmount = ($subsData->plan->amount/100);
                    $planCurrency = $subsData->plan->currency;
                    $planinterval = $subsData->plan->interval;
                    $planIntervalCount = $subsData->plan->interval_count;
                    $created = date("Y-m-d H:i:s", $subsData->created);
                    $current_period_start = date("Y-m-d H:i:s", $subsData->current_period_start);
                    $current_period_end = date("Y-m-d H:i:s", $subsData->current_period_end);
                    $status = $subsData->status;


                    DB::table('user_subscriptions')->where('user_id',Auth::user()->id)->update([
                        'payment_method'=>'stripe',
                        'stripe_subscription_id'=>$subscrID,
                        'stripe_customer_id'=> $custID,
                        'stripe_plan_id'=>$planID,
                        'plan_amount'=>$planAmount,
                        'plan_amount_currency'=>$planCurrency,
                        'plan_interval'=> $planinterval,
                        'plan_interval_count'=>$planIntervalCount,
                        'payer_email'=>$user->email,
                        'created'=>$created,
                        'plan_period_start'=>$current_period_start,
                        'plan_period_end'=>$current_period_end,
                        'status'=>$status
                    ]);


                    Session::flash('success', 'Your are successfully subscribed !');

                    return back();
                }else{
                    Session::flash('error', 'Your payment was not successful,please try again!');

                    return back();
                }




            } catch(\Stripe\Exception\CardException $e) {

                Session::flash('error', $e->getError()->message);

                return back();


            } catch (\Stripe\Exception\RateLimitException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\InvalidRequestException $e) {
                Session::flash('error', $e->getError()->message);

                return back();
            } catch (\Stripe\Exception\AuthenticationException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\ApiConnectionException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\ApiErrorException $e) {
                Session::flash('error', $e->getError()->message);
                return back();

            } catch (Exception $e) {
                Session::flash('error', 'Something went wrong !');

                return back();

            }
        } catch (Throwable $e) {
            Session::flash('error', 'Your payment was not successful,please try again!');


            return back();
        }



    }
    function user_subscription_login(){

        try {
            $user = User::where('id',session()->get('user_id'))->first();


            try {
                Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

                $subsData =  Stripe\Subscription::create([
                    'customer' => $user->customer_id,

                    'items' => [
                        ['price' => 'price_1HzeBIIXE1VWjsYwNH0if6Fq'],
                    ],
                ]);
                if($subsData->status=='active'){


                    $subscrID = $subsData->id;
                    $custID = $subsData->customer;
                    $planID = $subsData->plan->id;
                    $planAmount = ($subsData->plan->amount/100);
                    $planCurrency = $subsData->plan->currency;
                    $planinterval = $subsData->plan->interval;
                    $planIntervalCount = $subsData->plan->interval_count;
                    $created = date("Y-m-d H:i:s", $subsData->created);
                    $current_period_start = date("Y-m-d H:i:s", $subsData->current_period_start);
                    $current_period_end = date("Y-m-d H:i:s", $subsData->current_period_end);
                    $status = $subsData->status;


                    DB::table('user_subscriptions')->where('user_id',session()->get('user_id'))->update([
                        'payment_method'=>'stripe',
                        'stripe_subscription_id'=>$subscrID,
                        'stripe_customer_id'=> $custID,
                        'stripe_plan_id'=>$planID,
                        'plan_amount'=>$planAmount,
                        'plan_amount_currency'=>$planCurrency,
                        'plan_interval'=> $planinterval,
                        'plan_interval_count'=>$planIntervalCount,
                        'payer_email'=>$user->email,
                        'created'=>$created,
                        'plan_period_start'=>$current_period_start,
                        'plan_period_end'=>$current_period_end,
                        'status'=>$status
                    ]);


//                Session::flash('status', 'Your are successfully subscribed , Please login to your account!');

                    if (Auth::login($user)) {
                        // Authentication passed...
                        return redirect()->intended('dashboard');
                    }else{
                        Session::flash('status', 'Your subscription completed successfully , Please login into you account!');
                        return redirect()->route('login');
                    }

                }else{
                    Session::flash('error', 'Your payment was not successful,please try again!');

                    return back();
                }




            } catch(\Stripe\Exception\CardException $e) {

                Session::flash('error', $e->getError()->message);

                return back();


            } catch (\Stripe\Exception\RateLimitException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\InvalidRequestException $e) {
                Session::flash('error', $e->getError()->message);

                return back();
            } catch (\Stripe\Exception\AuthenticationException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\ApiConnectionException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\ApiErrorException $e) {
                Session::flash('error', $e->getError()->message);
                return back();

            } catch (Exception $e) {
                Session::flash('error', 'Something went wrong !');

                return back();

            }

        } catch (Throwable $e) {


            Session::flash('error', 'Oops Something went wrong !');
            return back();
        }


    }



    function subscribe(){
        $id=session()->get('user_id');
        if(isset($id)){
           $card = db::table('card_details')->where('user_id',$id)->first();
            return view('subscribe',compact('card'));

        }else{
            if(isset(Auth::user()->id)){
                return redirect('/');

            }else{
                return redirect('/login');

            }
        }
    }

    function subscriptions(){
        $id=session()->get('user_id');
        if(isset($id)){
            return view('stripres');

        }else{
            if(isset(Auth::user()->id)){
                return redirect('/');

            }else{
                return redirect('/login');

            }
        }
    }


    function stripePayment(request $request){
        $user=User::where('id',session()->get('user_id'))->first();

       //attach card
        $this->attachSource($user,$request->stripeToken);

        try {

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));


            //subscribe
            $subsData =  Stripe\Subscription::create([
                'customer' => $user->customer_id,
                'items' => [
                    ['price' => 'price_1HzeBIIXE1VWjsYwNH0if6Fq'],
                ],
            ]);




            if($subsData->status=='active'){


                $subscrID = $subsData->id;
                $custID = $subsData->customer;
                $planID = $subsData->plan->id;
                $planAmount = ($subsData->plan->amount/100);
                $planCurrency = $subsData->plan->currency;
                $planinterval = $subsData->plan->interval;
                $planIntervalCount = $subsData->plan->interval_count;
                $created = date("Y-m-d H:i:s", $subsData->created);
                $current_period_start = date("Y-m-d H:i:s", $subsData->current_period_start);
                $current_period_end = date("Y-m-d H:i:s", $subsData->current_period_end);
                $status = $subsData->status;

                //update user subscribe if exist otherwise insert

                $user_sub = DB::table('user_subscriptions')->where('user_id',$user->id)->first();

                if(isset($user_sub->id)){
                    DB::table('user_subscriptions')->where('user_id',$user->id)->update([

                        'payment_method'=>'stripe',
                        'stripe_subscription_id'=>$subscrID,
                        'stripe_customer_id'=> $custID,
                        'stripe_plan_id'=>$planID,
                        'plan_amount'=>$planAmount,
                        'plan_amount_currency'=>$planCurrency,
                        'plan_interval'=> $planinterval,
                        'plan_interval_count'=>$planIntervalCount,
                        'payer_email'=>$user->email,
                        'created'=>$created,
                        'plan_period_start'=>$current_period_start,
                        'plan_period_end'=>$current_period_end,
                        'status'=>$status
                    ]);

                }else{
                    DB::table('user_subscriptions')->insert([

                        'user_id'=>$user->id,
                        'payment_method'=>'stripe',
                        'stripe_subscription_id'=>$subscrID,
                        'stripe_customer_id'=> $custID,
                        'stripe_plan_id'=>$planID,
                        'plan_amount'=>$planAmount,
                        'plan_amount_currency'=>$planCurrency,
                        'plan_interval'=> $planinterval,
                        'plan_interval_count'=>$planIntervalCount,
                        'payer_email'=>$user->email,
                        'created'=>$created,
                        'plan_period_start'=>$current_period_start,
                        'plan_period_end'=>$current_period_end,
                        'status'=>$status
                    ]);

                }

                 //Add card details in db
                DB::table('card_details')->insert([

                    'user_id'=>$user->id,
                    'card_no'=>$request->number,
                    'month'=>$request->month,
                    'year'=>$request->year,
                    'cvc'=>$request->cvc

                ]);

//                Session::flash('status', 'Your subscription complete successfully , Please login into you account!');

                //login user

                if (Auth::login($user)) {
                    // Authentication passed...
                    return redirect()->intended('dashboard');
                }else{
                    Session::flash('status', 'Your subscription completed successfully , Please login into you account!');
                    return redirect()->route('login');
                }
            }else{
                Session::flash('error', 'Your payment was not successful,please try again!');

                return back();
            }

        } catch(\Stripe\Exception\CardException $e) {

            Session::flash('error', $e->getError()->message);

            return back();


        } catch (\Stripe\Exception\RateLimitException $e) {
            Session::flash('error', $e->getError()->message);

            return back();

        } catch (\Stripe\Exception\InvalidRequestException $e) {
            Session::flash('error', $e->getError()->message);

            return back();
        } catch (\Stripe\Exception\AuthenticationException $e) {
            Session::flash('error', $e->getError()->message);

            return back();

        } catch (\Stripe\Exception\ApiConnectionException $e) {
            Session::flash('error', $e->getError()->message);

            return back();

        } catch (\Stripe\Exception\ApiErrorException $e) {
            Session::flash('error', $e->getError()->message);
            return back();

        } catch (Exception $e) {
            Session::flash('error', 'Something went wrong !');

            return back();

        }

    }


    function attachSource($user,$token){

        try{
            $stripe = new \Stripe\StripeClient(
                env('STRIPE_SECRET')
            );

            $card =   $stripe->customers->createSource(
                $user->customer_id,
                ['source' => $token]
            );
        }
                 catch(\Stripe\Exception\CardException $e) {





             } catch (\Stripe\Exception\RateLimitException $e) {



} catch (\Stripe\Exception\InvalidRequestException $e) {

} catch (\Stripe\Exception\AuthenticationException $e) {


} catch (\Stripe\Exception\ApiConnectionException $e) {


} catch (\Stripe\Exception\ApiErrorException $e) {


} catch (Exception $e) {


}

    }


    function canceledPayment(){

       $subscriptions = db::table('user_subscriptions')->where('status','pause')->get();

       foreach($subscriptions as $sub){

                 $end_date = explode(' ',$sub->plan_period_end);
                 $today = date("Y/m/d");
         ;

                 if($today>$end_date[0]){

                     try {
                         $stripe = new \Stripe\StripeClient(
                             env('STRIPE_SECRET')
                         );


                       $cancle=$stripe->subscriptions->cancel(
                             $sub->stripe_subscription_id,
                             []
                         );

                       if(isset($cancle)){
                           db::table('user_subscriptions')->where('id',$sub->id)->update(['status'=>'canceled']);

                       }

                     } catch(\Stripe\Exception\CardException $e) {
                         // Since it's a decline, \Stripe\Exception\CardException will be caught
                         echo 'Status is:' . $e->getHttpStatus() . '\n';
                         echo 'Type is:' . $e->getError()->type . '\n';
                         echo 'Code is:' . $e->getError()->code . '\n';
                         // param is '' in this case
                         echo 'Param is:' . $e->getError()->param . '\n';
                         echo 'Message is:' . $e->getError()->message . '\n';
                     } catch (\Stripe\Exception\RateLimitException $e) {
                         echo 'Message is:' . $e->getError()->message . '\n';

                     } catch (\Stripe\Exception\InvalidRequestException $e) {
                         echo 'Message is:' . $e->getError()->message . '\n';

                     } catch (\Stripe\Exception\AuthenticationException $e) {
                         echo 'Message is:' . $e->getError()->message . '\n';


                     } catch (\Stripe\Exception\ApiConnectionException $e) {
                         echo 'Message is:' . $e->getError()->message . '\n';


                     } catch (\Stripe\Exception\ApiErrorException $e) {
                         echo 'Message is:' . $e->getError()->message . '\n';


                     } catch (Exception $e) {

                         echo 'something went wrong';
                         // Something else happened, completely unrelated to Stripe
                     }

                     echo 'id:'.$sub->id;



                 }else{

                     echo 'no expired subscription found !';
                 }
         }

    }


    function madePayment(request $request){


        try{
            $user=User::where('id',session()->get('user_id'))->first();

            try {


                $stripe = new \Stripe\StripeClient(
                    env('STRIPE_SECRET')    );

                   $date=explode('/',$request->expdate);

                $token= $stripe->tokens->create([
                    'card' => [
                        'number' => str_replace(' ', '', $request->card),
                        'exp_month' =>str_replace(' ', '', $date[0]),
                        'exp_year' => str_replace(' ', '', $date[1]),
                        'cvc' => $request->cvc,
                    ],
                ]);

                $card =   $stripe->customers->createSource(
                    $user->customer_id,
                    ['source' => $token->id]
                );

                if(isset($card->id)){

                    DB::table('card_details')->insert([

                        'user_id'=>$user->id,
                        'card_no'=>str_replace(' ', '', $request->card),
                        'month'=>str_replace(' ', '', $date[0]),
                        'year'=>str_replace(' ', '', $date[1]),
                        'cvc'=>$request->cvc

                    ]);

                    //

                    $subsData =  $stripe->subscriptions->create([
                        'customer' => $user->customer_id,
//                'cancel_at_period_end' => true,

                        'items' => [
                            ['price' => 'price_1HzeBIIXE1VWjsYwNH0if6Fq'],
                        ],
                    ]);
                    if($subsData->status=='active'){


                        $subscrID = $subsData->id;
                        $custID = $subsData->customer;
                        $planID = $subsData->plan->id;
                        $planAmount = ($subsData->plan->amount/100);
                        $planCurrency = $subsData->plan->currency;
                        $planinterval = $subsData->plan->interval;
                        $planIntervalCount = $subsData->plan->interval_count;
                        $created = date("Y-m-d H:i:s", $subsData->created);
                        $current_period_start = date("Y-m-d H:i:s", $subsData->current_period_start);
                        $current_period_end = date("Y-m-d H:i:s", $subsData->current_period_end);
                        $status = $subsData->status;

                        //update user subscribe if exist otherwise insert

                        $user_sub = DB::table('user_subscriptions')->where('user_id',$user->id)->first();

                        if(isset($user_sub->id)){
                            DB::table('user_subscriptions')->where('user_id',$user->id)->update([

                                'payment_method'=>'stripe',
                                'stripe_subscription_id'=>$subscrID,
                                'stripe_customer_id'=> $custID,
                                'stripe_plan_id'=>$planID,
                                'plan_amount'=>$planAmount,
                                'plan_amount_currency'=>$planCurrency,
                                'plan_interval'=> $planinterval,
                                'plan_interval_count'=>$planIntervalCount,
                                'payer_email'=>$user->email,
                                'created'=>$created,
                                'plan_period_start'=>$current_period_start,
                                'plan_period_end'=>$current_period_end,
                                'status'=>$status
                            ]);

                        }else{
                            DB::table('user_subscriptions')->insert([

                                'user_id'=>$user->id,
                                'payment_method'=>'stripe',
                                'stripe_subscription_id'=>$subscrID,
                                'stripe_customer_id'=> $custID,
                                'stripe_plan_id'=>$planID,
                                'plan_amount'=>$planAmount,
                                'plan_amount_currency'=>$planCurrency,
                                'plan_interval'=> $planinterval,
                                'plan_interval_count'=>$planIntervalCount,
                                'payer_email'=>$user->email,
                                'created'=>$created,
                                'plan_period_start'=>$current_period_start,
                                'plan_period_end'=>$current_period_end,
                                'status'=>$status
                            ]);

                        }



//                Session::flash('status', 'Your subscription complete successfully , Please login into you account!');

                        //login user

                        if (Auth::login($user)) {
                            // Authentication passed...
                            return redirect()->intended('dashboard');
                        }else{
                            Session::flash('status', 'Your subscription completed successfully , Please login into you account!');
                            return redirect()->route('login');
                        }
                    }else{
                        Session::flash('error', 'Your payment was not successful,please try again!');

                        return back();
                    }





                    Session::flash('error', 'Something went wrong!');

                    return back();
                }else{
                    Session::flash('error', 'Something went wrong!');

                }

            } catch(\Stripe\Exception\CardException $e) {

                Session::flash('error', $e->getError()->message);

                return back();


            } catch (\Stripe\Exception\RateLimitException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\InvalidRequestException $e) {
                Session::flash('error', $e->getError()->message);

                return back();
            } catch (\Stripe\Exception\AuthenticationException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\ApiConnectionException $e) {
                Session::flash('error', $e->getError()->message);

                return back();

            } catch (\Stripe\Exception\ApiErrorException $e) {
                Session::flash('error', $e->getError()->message);
                return back();

            } catch (Exception $e) {
                Session::flash('error', 'Something went wrong !');

                return back();

            }



        }catch(Throwable $e){
            Session::flash('error', 'Something went wrong , Please try again later!');

            return back();

        }
    }


    function startTrail(request $request){





         if( $request->coupon == 'managersqr'){
             $today = date("Y-m-d H:i:s");
             $endDate=date('Y-m-d H:i:s', strtotime($today. ' + 14 days'));

             $user = User::create([
                 'first_name' => session()->get('first_name'),
                 'last_name' => session()->get('last_name'),
                 'email' => session()->get('email'),
                 'password' => Hash::make(session()->get('password')),
                 'address'=>session()->get('address'),
                 'contact_no'=>session()->get('phone'),
                 'is_Admin'=>1,
                 'subcription_id'=>'',
                 'customer_id'=>'',
                 'latitude'=>session()->get('latitude'),
                 'longitude'=>session()->get('longitude')

             ]);

             $sub = DB::table('user_subscriptions')->insert([

                 'user_id'=>$user->id,
                 'payment_method'=>'stripe',
                 'stripe_subscription_id'=>'',
                 'stripe_customer_id'=> '',
                 'stripe_plan_id'=>'Trail',
                 'plan_amount'=>'',
                 'plan_amount_currency'=>'',
                 'plan_interval'=> '',
                 'plan_interval_count'=>'',
                 'payer_email'=>$user->email,
                 'created'=>$today,
                 'plan_period_start'=>$today,
                 'plan_period_end'=>$endDate,
                 'status'=>'active'
             ]);


                $categories= DB::table('categories')->where('user_id','=',1)->get();

                foreach($categories as $c){
                    $data=array(

                        'user_id'=>$user->id,
                        'name'=>$c->name,

                    );
                    $category_id= DB::table('categories')->insertGetId($data);

                }

             Session::flash('status', 'You trail Period has been started!');

             return response()->json(['status'=>'success','data'=>'Trail started successfully !']);

         }else{
             return response()->json(['status'=>'error','data'=>'invalid coupon !']);

         }
    }

    function endTrail(){

        $subscriptions = db::table('user_subscriptions')->where('stripe_plan_id','Trail')->get();

        foreach($subscriptions as $sub){

            $end_date = explode(' ',$sub->plan_period_end);
            $today = date("Y-m-d");
            ;

            if($today>$end_date[0]){

                db::table('user_subscriptions')->where('id',$sub->id)->update(['status'=>'canceled']);

            }else{

                echo 'no expired subscription found !';
            }
        }

    }




}





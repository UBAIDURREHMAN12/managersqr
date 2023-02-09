@extends('layouts.admin_layout')

@section('title')
   Subscription

@endsection

     @section('content')
         <style>
             .bmd-form-group label{
                 color:black;
             }
         </style>
<?php
if(isset($subscription)){

    $start_date=explode(' ',$subscription->plan_period_start);
$end_date=explode(' ',$subscription->plan_period_end);
$today = date("Y/m/d");
}




?>


         <div class="container">
             @if (Session::has('error'))
                 <div class="alert alert-danger text-center">
                     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                     <p>{{ Session::get('error') }}</p>
                 </div>
             @endif
                 @if (Session::has('success'))
                     <div class="alert alert-success text-center">
                         <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                         <p>{{ Session::get('success') }}</p>
                     </div>
                 @endif


             <div class="row">

                 <div class="col-md-6" style>
                     <p style="text-align: justify;margin-top: 6%;">By activating this subscription you can avail all the facilities offer by Managers QR.
                         This subscription expires on completion of one year starting from subscription date.
                         You can also cancel this subscription at any time.</p>
                 </div>

                 <div class="col-md-6" style="width: 100%;">

                     <aside class="col-sm-12 col-md-12" style="width: 100%;">

                         <article class="card">
                             <div class="card-body p-5">
                                 <h3>Subscription Detail</h3>
                                 <dl class="param">
                                     <dt>Amount: </dt>
                                     <dd> ${{$subscription->plan_amount}}</dd>
                                 </dl>
                                 <dl class="param">
                                     <dt>Subscription Period: </dt>
                                     <dd> {{$subscription->plan_interval}}</dd>
                                 </dl>
                                 <dl class="param">
                                     <dt>Start Date: </dt>
                                     <dd> {{$start_date[0]}}</dd>
                                 </dl>
                                 <dl class="param">
                                     <dt>End Date: </dt>
                                     <dd>{{$end_date[0]}}</dd>
                                 </dl>
                                 <dl class="param">
                                     <dt>Status: </dt>
                                     @if($subscription->status=='active')
                                         <dd><i class="badge badge-success">{{$subscription->status}}</i> </dd>
                                     @else
                                         <dd><i class="badge badge-danger">canceled</i> </dd>

                                     @endif
                                 </dl>
                                 <dl class="param">

                                     @if($subscription->status=='active')
                                         <a href="/cancelSubscription" class="btn btn-warning">Cancel Subscription</a>
                                     @else

                                         @if($today<=$end_date[0])
                                             <dt>Note: </dt>

                                             <p class="alert alert-warning">Note ! You can renew subscription after the end of this current subscription period</p>

                                         @else
                                             <a href="/subscribe" class="btn btn-success">Subscribe</a>
                                         @endif
                                     @endif
                                 </dl>

                             </div>
                         </article>


                     </aside> <!-- col.// -->

                     @if(isset($card))
                         <aside class="col-sm-12 col-md-12" style="width: 100%;">
                             <article class="card">
                                 <h3>Card Details</h3>
                                 <div class="card-body p-5">
                                     @if(isset($card->card_no))
                                         <dl class="param">
                                             <dt>Card No: </dt>
                                             <dd> {{substr($card->card_no, 0, 4) . str_repeat('X', strlen($card->card_no) - 8) . substr($card->card_no, -4)}}</dd>
                                         </dl>
                                         <dl class="param">
                                             <dt>Exp Month: </dt>
                                             <dd> {{$card->month}}</dd>
                                         </dl>
                                         <dl class="param">
                                             <dt>Exp Year: </dt>
                                             <dd> {{$card->year}}</dd>
                                         </dl>
                                         <dl class="param">
                                             <dt>End Date: </dt>
                                             <dd>{{$end_date[0]}}</dd>
                                         </dl>

                                         <a href="/detachCard" class="btn btn-danger">Detach Card</a>
                                     @else
                                         <form role="form"  method="post" action="/attachCard">
                                             @csrf
                                             <div class="form-group">
                                                 <label for="username">Full name (on the card)</label>
                                                 <input type="text" class="form-control" name="username" placeholder="" required="">
                                             </div> <!-- form-group.// -->

                                             <div class="form-group">
                                                 <label for="cardNumber">Card number</label>
                                                 <div class="input-group">
                                                     <input type="number" maxlength="16" class="form-control" name="cardNumber" placeholder="" required>
                                                     <div class="input-group-append">
				<span class="input-group-text text-muted">
					<i class="fab fa-cc-visa"></i>   <i class="fab fa-cc-amex"></i>  
					<i class="fab fa-cc-mastercard"></i>
				</span>
                                                     </div>
                                                 </div>
                                             </div> <!-- form-group.// -->

                                             <div class="row">
                                                 <div class="col-sm-8">
                                                     <div class="form-group">
                                                         <label><span class="hidden-xs">Expiration</span> </label>
                                                         <div class="input-group">
                                                             <input type="number" name="month" maxlength="2" class="form-control" placeholder="MM"  required>
                                                             <input type="number" name="year" maxlength="4" class="form-control" placeholder="YY"  required>
                                                         </div>
                                                     </div>
                                                 </div>
                                                 <div class="col-sm-4">
                                                     <div class="form-group">
                                                         <label data-toggle="tooltip" title="" data-original-title="3 digits code on back side of the card">CVV <i class="fa fa-question-circle"></i></label>
                                                         <input type="number" maxlength="4" name="cvc" class="form-control" required="required">
                                                     </div> <!-- form-group.// -->
                                                 </div>
                                             </div> <!-- row.// -->
                                             <button type="submit" class="subscribe btn btn-primary btn-block" > Attach Card  </button>
                                         </form>


                                     @endif

                                 </div> <!-- card-body.// -->
                             </article> <!-- card.// -->


                         </aside> <!-- col.// -->
                     @endif

                 </div>

             </div>
                 <!-- row.// -->

         </div>

    @endsection

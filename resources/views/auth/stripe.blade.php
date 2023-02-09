@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 style="    color: white;
    font-weight: bolder;" class="text-center">Payment</h1>
                <div class="card">
{{--                    <div class="card-header">Payment</div>--}}

                    <div class="card-body">
                        <div class="panel-body">

                            @if (Session::has('success'))
                                <div class="alert alert-success text-center">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                    <p>{{ Session::get('success') }}</p>
                                </div>
                            @endif
                                @if (Session::has('error'))
                                    <div class="alert alert-danger text-center">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <p>{{ Session::get('error') }}</p>
                                    </div>
                                @endif

                            <form role="form" action="{{ route('stripe.post') }}" method="post" class="require-validation"
                                  data-cc-on-file="false"
                                  data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                  id="payment-form">
                                @csrf

                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group required'>
                                        <label class='control-label'>Name on Card</label> <input
                                            class='form-control' size='4' type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 form-group card required'>
                                        <label class='control-label'>Card Number</label> <input
                                            autocomplete='off' maxlength="16" class='form-control card-number' size='20'
                                            type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-xs-12 col-md-4 form-group cvc required'>
                                        <label class='control-label'>CVC</label> <input autocomplete='off'
                                                                                        class='form-control card-cvc' maxlength="4" placeholder='ex. 311' size='4'
                                                                                        type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Month</label> <input
                                            class='form-control card-expiry-month' placeholder='MM' size='2'
                                            type='text'>
                                    </div>
                                    <div class='col-xs-12 col-md-4 form-group expiration required'>
                                        <label class='control-label'>Expiration Year</label> <input
                                            class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                            type='text'>
                                    </div>

                                    <div class='col-xs-12 col-md-4 form-group expiration'>
                                        <label class='control-label'>Coupon (For Trial)</label> <input
                                            class='form-control coupon' id="coupon"  placeholder='Trial Coupon' size='4'
                                            type='text'>
                                    </div>
                                </div>

                                <div class='form-row row'>
                                    <div class='col-md-12 error form-group hide'>
                                        <div class='alert-danger alert'>Please correct the errors and try
                                            again.</div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-xs-6">
                                        <button type="button" class="btn btn-success btn-lg btn-block" onclick="startTrail()">Start Your trial</button>
                                    </div>
                                    <div class="col-xs-6">
                                        <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now ($9.99)</button>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function() {
            var $form         = $(".require-validation");
            $('form.require-validation').bind('submit', function(e) {
                var $form         = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs       = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid         = true;
                $errorMessage.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('hide')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    // $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.append("<input type='hidden' name='number' value='" + $('.card-number').val() + "'/>");
                    $form.append("<input type='hidden' name='cvc' value='" + $('.card-cvc').val() + "'/>");
                    $form.append("<input type='hidden' name='month' value='" + $('.card-expiry-month').val() + "'/>");
                    $form.append("<input type='hidden' name='year' value='" + $('.card-expiry-year').val() + "'/>");

                    $form.get(0).submit();
                }
            }

        });



        function startTrail() {



            var coupon = $('#coupon').val();

            if(coupon.trim()==""){
                alert('coupon field is required')
                return;
            }

            $.ajax({
                url:'/startTrail',
                type:"post",
                data:{"coupon":coupon,"_token": "{{ csrf_token() }}"},
                success: function(data){

                    if(data.status=='success'){
                        location.href="/login"
                    }else if(data.status=='error'){

                        alert(data.data);

                    }else{

                        alert('Something went wrong !');

                    }

                }
            });


        }
    </script>
@endsection

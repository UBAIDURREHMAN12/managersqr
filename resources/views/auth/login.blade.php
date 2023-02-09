@extends('layouts.app')

@section('content')

    <style>
        .invalid-feedback {
            display: none;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 80%;
            color: #dc3545;
        }
    </style>
    <div class="limiter">
        <div class="container-login100" style="background-image: url('/public/loginPage/images/bg-01.jpg');">
            <div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Login
				</span>
                <form method="POST" action="{{ route('login') }}"  class="login100-form validate-form p-b-33 p-t-5">

                    @csrf



                    <div class="wrap-input100 validate-input" data-validate = "Enter Email">
                        <input class="input100 @error('email') is-invalid @enderror" type="email" value="{{ old('email') }}" name="email" placeholder="Email">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>


                    </div>
                    @error('email')


                    <span class="ml-5"  role="alert" style="color: orangered">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror


                    <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password"  autocomplete="current-password">
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>

                    </div>
                    @error('password')
                    <span class="ml-5"  role="alert" style="color: orangered">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                    
                      @if (Route::has('password.request'))
                        <a style="color: black" class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif

                    <div class="container-login100-form-btn m-t-32">
                        <button type="submit" class="login100-form-btn">
                            Login
                        </button>
                    </div>

                   <p style="    position: relative;
    left: 46%;
    top: 17px;">OR</p> 

                    <div class="container-login100-form-btn m-t-32">
                        <a href="/register" class="login100-form-btn">
                            Register
                        </a>
                    </div>

                </form>
            </div>
        </div>
    </div>

@endsection

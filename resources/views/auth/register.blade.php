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
					Register
				</span>
                <form method="POST" action="{{ route('register') }}"  class="login100-form validate-form p-b-33 p-t-5">

                    @csrf
                    <div class="wrap-input100 validate-input" data-validate = "Enter First Name">
                        <input class="input100 @error('first_name') is-invalid @enderror" type="text" value="{{ old('first_name') }}" name="first_name" placeholder="First Name">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>


                    </div>
                    <div class="wrap-input100 validate-input" data-validate = "Enter Last Name">
                        <input class="input100 @error('last_name') is-invalid @enderror" type="text" value="{{ old('last_name') }}" name="last_name" placeholder="Last Name">
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
                    </div>



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
                        <div class="wrap-input100 validate-input" data-validate="Enter password">
                        <input class="input100 @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" placeholder="Confirm Password"  autocomplete="password_confirmation">
                        <span class="focus-input100" data-placeholder="&#xe80f;"></span>

                    </div>
                    <p style="text-align: justify;padding: 4%;">Your password must be more than 8 characters long,should contain at-least
                        1 Uppercase, 1 Lowercase, 1 Numeric and 1 special character</p>
                    @error('password_confirmation')
                    <span class="ml-5"  role="alert" style="color: orangered">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror

                    <div class="container-login100-form-btn m-t-32">
                        <button type="submit" class="login100-form-btn">
                            Register
                        </button>
                    </div>


                </form>
            </div>
        </div>
    </div>

@endsection

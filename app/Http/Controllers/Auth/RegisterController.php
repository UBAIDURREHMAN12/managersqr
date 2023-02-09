<?php

namespace App\Http\Controllers\Auth;

use App\Mail\AccountConfirmation;
use Mail;

use App\User;
use App\TempData;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/users';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }



    public function showRegistrationForm()
    {
        session()->forget('first_name');
        session()->forget('last_name');
        session()->forget('email');
        session()->forget('password');


        return view('auth.register');
    }




    public function register(Request $request)
    {
        $this->validate($request, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed', 'regex:/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{6,}$/'],


        ]);


        session()->put('first_name',$request->first_name);
        session()->put('last_name',$request->last_name);

        session()->put('email',$request->email);

        session()->put('password',$request->password);

        $six_digit_random_number = random_int(100000, 999999);

        session()->put('confirmationCode',$six_digit_random_number);

        \Mail::to($request->email)->send(new AccountConfirmation($request->first_name, $six_digit_random_number));


        $form_data = array(
            'email'        =>  $request->email,
            'code'         =>  $six_digit_random_number,
        );

        TempData::create($form_data);


        return redirect()->route('code_confirmation');

//                return redirect()->route('stripe');

//        $this->validator($request->all())->validate();
//        event(new Registered($user = $this->create($request->all())));
//        // $this->guard()->login($user);
//        return $this->registered($request, $user)
//            ?: redirect($this->redirectPath());
    }

}

<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Str;
use Auth;
use Mail;
use App\Mail\sendNewMail;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return  User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'api_token' =>str_random(40),
            'is_verified' => 0,
            'status' => 0,
            'password' => bcrypt($data['password']),
        ]);

       $user = User::findOrFail($user->id);
        $this->sendMail($user);
    }

      /*public function sendMail($user)
      {
         Mail::to($user['email'])->send(new sendNewMail($user));
      }*/

    public function activeAccount($email,$token)
    {
      $user_verified = User::where(['email'=>$email,'api_token'=>$token])->first();
      if($user_verified)
      {
        $user_verified->is_verified = 1;
        $user_verified->api_token ='';
        $user_verified->save();
        session()->flash('verified_user','Your Account Has been Verified , You can login' .' '.$user_verified->name);
        return redirect('login');
      }
    }
}

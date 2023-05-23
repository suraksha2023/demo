<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Mail;
use App\Mail\TestEmail;

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
    protected $redirectTo = RouteServiceProvider::HOME;

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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']

        ]);

    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */

    
    protected function create(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => ($dat['password']),
        ]);
    }

    function registerform(){
        return view('auth.register');
    }

    function registeruser(Request $request){
    


      $validater =  Validator::make($request->all(), [
          'name' => ['required', 'string', 'max:255'],
          'email' => ['required', 'string', 'email', 'max:255', 'unique:users']

      ]);

      if($validater->fails()){
        return redirect()->back()->withErrors($validater)->withInput();
      }
      else {

    
       /*$name = $request->name ;
       $email = $request->email ;
       $country = $request->country ;
       $error = '';

        return view('auth/setpassword',compact('name', 'email' , 'country','error'));*/

        $data=[
            'name' => $request->name ,
            'email' => $request->email,
            'country' => $request->country,
            'error' =>''];

        
       Mail::to('suraksha@netiapps.com')->send(new TestEmail($data));

       return redirect()->route('register')->withMessage('Set Password link has been sent to your email ID');

      }
    }

    function setpassword(){

 
      if(User::where('email',$_GET['email'])->exists()){
           return redirect()->route('home');
       }
       
       $error = '';

        return view('auth/setpassword',compact('error'));
    }

    function save_user(Request $request){
      //print_r($request->Input());die();

      if($request->password == $request->confirm_password){

         User::create([
           'name'=> $request->name,
           'email'=> $request->email ,
           'country'=> $request->country,
           'password'=> Hash::make($request->password)
         ]);

         return redirect()->route('home');


      }else {
      //  print_r("here22");die();
        //return redirect()->back()->with('message','confirm password do not match');
        $name = $request->name ;
        $email = $request->email ;
        $country = $request->country ;

        $error = 'confirm password do not match';
        return view('auth/setpassword',compact('name', 'email' , 'country','error'));
      }

    }
}

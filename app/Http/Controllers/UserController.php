<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Payment;
use App\Models\Consultation;

class UserController extends Controller
{
    //
    public function index(Request $request){
        if (!Auth::check()){
            return redirect("/user/login");
        }
        $myconsultation = Consultation::where('patient_id', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        foreach($myconsultation as $my){
            $doctor = User::find($my->doctor_id);
            $my["doctor"] = $doctor;
        }

        $payment = Payment::all();
        return view('index')
            ->with('myconsultation', $myconsultation)
            ->with('payment', $payment);
    }

    public function loginPage(Request $request){

        return view('login')
            ->with('failed', 0);
    }

    public function login(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];

        $remember = $request->remember;

        if(Auth::attempt($credentials, true)){
            if($remember){
                // remember me (cookie)
                Cookie::queue('cookieemail', $request->email, 120);

                // session
                Session::put('loginsession', $credentials);
            }

            return redirect("/");
        }
        return view("/login")->with('failed', 1);
    }

    public function registerPage(Request $request){

        return view('register');
    }

    public function register(Request $request){
        $validation = [
            'name' => 'required | min:3',
            'email' => 'required | email | unique:users,email',
            'height' => 'required | numeric',
            'weight' => 'required | numeric',
            'phoneNumber' => 'required | min:5',
            'date_of_birth' => 'required ',
            'password' => 'required | alpha_num | min:6',
            'confirmPassword' => 'required | same:password'
        ];

        $validator = Validator::make($request->all(), $validation);

        if($validator->stopOnFirstFailure()->fails()){
            return view("register")
                ->withErrors($validator);
        }

        $newUser = new User();
        $newUser->name = $request->name;
        $newUser->email = $request->email;
        $newUser->height = $request->height;
        $newUser->weight = $request->weight;
        $newUser->phone = $request->phoneNumber;
        $newUser->date_of_birth = $request->date_of_birth;
        $newUser->password = bcrypt($request->password);

        $newUser->save();

        return redirect('/user/login');
    }

    public function logout(){
        Auth::logout();
        Session::forget('loginsession');

        return redirect("/");
    }
}

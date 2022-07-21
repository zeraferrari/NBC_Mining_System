<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRules;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::INDEX;

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    // protected function redirectTo(){
    //     if(Auth()->user()->roles[0]->name == 'Pendonor' || Auth()->user()->roles[0]->name == 'Petugas Medis'){
    //         return route('checking_history');
    //     }else{
    //         return route('Manajement.Dashboard.index');
    //     }
    // }

    public function login(LoginRules $request){
        $data_has_been_validated = $request->validated();
       
        $login_check = filter_var($data_has_been_validated['email'], FILTER_VALIDATE_EMAIL)
        ? 'email' : 'NIK';
        $request->merge([$login_check => $request->input('email')]);

        // dd($data_has_been_validated);

        if(Auth::attempt($request->only($login_check, 'password'))){
            if(Auth::User()->roles[0]->name == 'Administrator'){
                return redirect()->route('Manajement.Dashboard.index');
            }else{
                return redirect()->route('home');
            }
        }else{
            return Redirect::back()->withErrors(['message_fails' => 'Email dan Password Salah !']);
        }
    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}

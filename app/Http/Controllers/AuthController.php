<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use App\Models\UserProfile;


class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();

            $data = array(
                'username' => $user->email
            );

            $validator = Validator::make(array('username' => $user->email),
                User::VALIDATION_RULES
            );
            if(empty($user->user['given_name'])) { 
                session()->flash('failed' , 'Please update your gmail account, missing first name/given name.');
                return redirect('/login');
            } else if(empty($user->user['family_name'])){ 
                session()->flash('failed' , 'Please update your gmail account, missing last name/family name.');
                return redirect('/login');
            }
           
            if(!$validator->fails()){
                $registered_user = User::where('email', '=', $user->email)->first();

                
                if($registered_user == null){

                    $registered_user = User::create([
                        'first_name' => $user->user['given_name'],
                        'last_name' => $user->user['family_name'],
                        'email' => $user->email,
                        'avatar' => $user->avatar,
                        'password' => Hash::make('googlelogin'),
                        'access_level' => 2,
                        'job_type' => 'full-time',
                        'job_type_date' => date('Y-m-d'),
                        'schedule_type' => "regular",
                        'isManager' => 0,
                        'manager_id' => 0
                ]);
                    
                }else{

                    User::where('email', $user->email)
                        ->update([
                            'first_name' => $user->user['given_name'],
                            'last_name' => $user->user['family_name'],
                            'avatar' => $user->avatar,
                        ]);

                }

                Auth::attempt(array('email'=> $user->email, 'password' => 'googlelogin'));
                $authenticated_user = Auth::user();

                return redirect()->intended('dashboard');

            }else{

                return redirect('/login');
            }

        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Google login failed. Please try again.']);
        }
    }
} 
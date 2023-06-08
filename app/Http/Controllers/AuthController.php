<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }
    public function registerSave(Request $request)
    {
        Validator::make($request->all(), [
            'name'=>'required',
            'email'=>'required|email',
            'password' => [
                'required',
                'confirmed',
                'min:8',
                // 'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/u'
            ],

        ])->validate();

        User::create([
            'name' => $request->name,
            'email' => $request->email,
           'password' => Hash::make($request->password),
            'level' => 'Admin',


        ]);

        return redirect()->route('login');

    }
    public function login()
    {
        return view('auth.login');
    }
    public function loginAction(Request $request)
    {
        Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required|min:8'
        ])->validate();

        if(!Auth::attempt( $request->only('email','password'),$request->boolean('remember'))){
            throw ValidationException::withMessages([
                'email' => trans('auth.failed')
            ]);
        }
        $request->session()->regenerate();

        return redirect()->route('dashboard');
    }
    public function logout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        return redirect('/');
    }

    public function profile()
    {
        return view('profile');
    }

    public function profileupdate(Request $request)
    {
        dd("USER NAME --->".$request->name);
        // dd("USER EMAIL--->".$request->email);
        // dd("USER PHONE --->".$request->phone);
        // dd("USER ADDRESS--->".$request->Address);
    }
}
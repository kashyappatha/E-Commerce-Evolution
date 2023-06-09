<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class ResetPasswordController extends Controller
{

    public function showResetForm($token = null)
    {
        return view('auth.reset-password')->with(['token' => $token, 'email' => request()->email]);
    }


    public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());

        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );

        return $response == Password::PASSWORD_RESET
            ? $this->sendResetResponse($response)
            : $this->sendResetFailedResponse($request, $response);
    }


    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:8',
        ];
    }


    protected function validationErrorMessages()
    {
        return [];
    }


    protected function credentials(Request $request)
    {
        return $request->only(
            'email', 'password', 'password_confirmation', 'token'
        );
    }


    protected function resetPassword($user, $password)
    {
        $user->password = bcrypt($password);
        $user->save();
    }


    protected function sendResetResponse($response)
    {
        return redirect()->route('login')->with('status', trans($response));
    }


    protected function sendResetFailedResponse(Request $request, $response)
    {
        return back()
            ->withErrors(['email' => trans($response)])
            ->withInput($request->only('email'));
    }

    public function broker()
    {
        return Password::broker();
    }
}
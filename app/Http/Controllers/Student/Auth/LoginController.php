<?php

namespace App\Http\Controllers\Student\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Student\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function create()
    {
        //dd(Hash::make('123456'));
        return view('student.login');
    }

    public function store(LoginRequest $request)
    {
        //dd(Hash::make('123456'));
        //dd($request);
        $request->authenticate();

        $request->session()->regenerate();

        //return redirect()->intended(RouteServiceProvider::HOME);
        return redirect()->route('student.home');
    }

    public function destroy(Request $request)
    {
        Auth::guard('student')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        //return redirect('/login');
        return redirect()->route('student.login');
    }

    /*protected function gaurd(){
        return Auth::guard('admin');
    }*/
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();

        if (! Auth::guard('student')->attempt($this->only('email', 'password'), $this->boolean('remember'))) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

}



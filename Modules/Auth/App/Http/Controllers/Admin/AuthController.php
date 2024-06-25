<?php

namespace Modules\Auth\App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Auth\App\Http\Requests\Admin\LoginRequest;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        if (auth()->user())
        {
            return redirect('admin');
        }

        return view('auth::admin.auth.login');
    }

    public function login(LoginRequest $request): \Illuminate\Http\RedirectResponse
    {
//        dd(1);
        $credentials = [
            'mobile' => $request->input('mobile'),
            'password' => $request->input('password'),
            'status' => 1
        ];

        if (Auth::attempt($credentials, (bool) $request->input('remember'))) {
            $request->session()->regenerate();

            //Update last login datetime
//            $request->user()->last_login = now();
//            $request->user()->save();

            return redirect()->intended('admin');
        }

        return back()->withErrors([
            'mobile' => 'اطلاعات وارد شده اشتباه است!',
        ]);
    }

    public function logout(Request $request): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('admin.login.form');
    }
}

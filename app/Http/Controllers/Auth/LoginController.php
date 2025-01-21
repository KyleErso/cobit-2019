<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        // Arahkan semua pengguna ke halaman home
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logout pengguna
        return redirect('/'); // Redirect ke halaman utama (atau halaman login)
    }
}


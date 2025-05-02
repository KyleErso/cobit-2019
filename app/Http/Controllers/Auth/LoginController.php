<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    // you can leave this or change to your default fallback
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * After login: check role and redirect accordingly
     */
    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            // jika admin, ke admin dashboard
            return redirect()->route('admin.dashboard');
        }

        // selain admin (user biasa / guest), ke home atau join page
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->flush();
        return redirect()->route('login');
    }
}

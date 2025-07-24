<?php

namespace App\Http\Controllers\Auth;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
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
        if ($user->role === 'admin' || $user->role === 'pic') {
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

    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        // Dapatkan informasi user dari Google
        $googleUser = Socialite::driver('google')->stateless()->user();

        // Cek apakah user sudah ada di database
        $user = User::where('email', $googleUser->getEmail())->first();

        // $user = User::firstOrCreate(
        //     ['email' => $googleUser->getEmail()],
        //     [
        //         'name' => $googleUser->getName(),
        //         'password' => bcrypt(str()->random(24)), // Password random karena tidak digunakan
        //         'jabatan' => "Belum ada jabatan"
        //     ]
        // );

        
        if (!$user) {
            return view('auth.register-google', [
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'password' => bcrypt(str()->random(24)), // Password random karena tidak digunakan
            ]);
        }

        Auth::login($user);
        return redirect('/home');
    }
}

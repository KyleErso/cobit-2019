<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Assessment;

class GuestController extends Controller
{
    public function loginGuest(Request $request)
    {
        // Jika sudah login:
        if (Auth::check()) {
            $user = Auth::user();

            // Admin tetap ke dashboard admin
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Jika user adalah guest atau user biasa → langsung ke assessment dengan kode_assessment 'guest'
            $assessment = Assessment::where('kode_assessment', 'guest')->first();

            return redirect()->route('df1.form', [
                'id' => $assessment->assessment_id, // Redirect ke assessment id yang baru atau yang sudah ada
            ]);
        }

        // Belum login → buat akun guest
        $guestUser = User::create([
            'name'     => 'Guest',
            'email'    => 'guest_' . uniqid() . '@example.com',
            'password' => bcrypt(Str::random(10)),
            'jabatan'  => 'Guest',
            'role'     => 'user',
        ]);

        Auth::login($guestUser);
        $assessment_id = 1;
        return redirect()->route('df1.form', [
            'id' => $assessment_id, // Redirect ke assessment id yang baru
        ]);
    }
}

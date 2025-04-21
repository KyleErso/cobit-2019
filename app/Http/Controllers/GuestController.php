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

            // Jika assessment dengan kode_assessment 'guest' tidak ada, buatkan baru
            if (!$assessment) {
                $assessment = Assessment::create([
                    'user_id' => $user->id,
                    'instansi' => 'Guest Assessment',
                    'kode_assessment' => 'guest',
                ]);
            }

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

        // Buat Assessment baru untuk guest dengan kode_assessment 'guest'
        $assessment = Assessment::create([
            'user_id' => $guestUser->id,
            'instansi' => 'Guest Assessment',
            'kode_assessment' => 'guest',
        ]);

        return redirect()->route('df1.form', [
            'id' => $assessment->assessment_id, // Redirect ke assessment id yang baru
        ]);
    }
}

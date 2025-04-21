<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class GuestController extends Controller
{
    public function loginGuest(Request $request)
    {
        // Jika sudah login, langsung arahkan ke halaman home
        if (Auth::check()) {
            return redirect()->route('home');
        }

        // Buat akun guest dengan data acak beserta nilai default untuk nomor_id dan jabatan
        $guestUser = User::create([
            'name'     => 'Guest',
            'email'    => 'guest_' . uniqid() . '@example.com',
            'password' => bcrypt(Str::random(10)), // password random
            'nomor_id' => 0,       // Nilai default untuk nomor_id
            'jabatan'  => 'Guest', // Nilai default untuk jabatan
            // Jika kolom 'role' ada di database, pastikan kolom tersebut juga diisi
            'role'     => 'user'
        ]);

        // Lakukan login otomatis untuk akun guest
        Auth::login($guestUser);

        // Arahkan pengguna ke halaman utama (atau halaman lain yang diinginkan)
        return redirect()->route('home');
    }
}

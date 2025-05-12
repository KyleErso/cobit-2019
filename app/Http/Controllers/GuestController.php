<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

            // Jika user adalah guest atau user biasa → langsung ke assessment dengan ID 1
            $assessment = Assessment::find(1);

            // Simpan assessment_id ke session
            session()->put('assessment_id', $assessment->assessment_id);
            session()->put('instansi', $assessment->instansi);

            return redirect()->route('df1.form', [
                'id' => $assessment->assessment_id,
            ]);
        }

        // Cari akun guest yang sudah ada
        $guestUser = User::where('email', 'guest01@example.com')->first();
        Auth::login($guestUser);
        $assessment = Assessment::find(1);
        
        // Simpan assessment_id ke session
        session()->put('assessment_id', $assessment->assessment_id);
        session()->put('instansi', $assessment->instansi);
        
        return redirect()->route('df1.form', [
            'id' => $assessment->assessment_id,
        ]);
    }
}

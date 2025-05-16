<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use Illuminate\Support\Facades\Auth;

class AssessmentController extends Controller
{
    public function showJoinForm()
    {
        return view('assessment.join');
    }

    public function join(Request $request)
    {
        $request->validate([
            'kode_assessment' => 'required|string',
        ]);

        // Cek jabatan user
        if (Auth::user()->jabatan === 'guest') {
            $request->kode_assessment = 'guest';
        }

        // Cari assessment berdasarkan kode_assessment
        $assessment = Assessment::where('kode_assessment', $request->kode_assessment)->first();

        if (!$assessment) {
            return back()
                ->withInput()
                ->with('error', 'Kode assessment tidak valid. Silakan periksa kembali kode yang Anda masukkan.');
        }

        if (!Auth::check()) {
            return redirect()->route('login')
                             ->with('error', 'Kamu harus login dulu untuk join assessment.');
        }

        // Attach user jika belum
        if ($assessment->user_id === null) {
            $assessment->user_id = Auth::id();
            $assessment->save();
        }

        // Simpan assessment id ke session
        session()->put('assessment_id', $assessment->assessment_id);
        session()->put('instansi', $assessment->instansi);

        // Redirect menggunakan id user
        return redirect()
            ->route('df1.form', ['id' => Auth::id()])
            ->with('success', 'Berhasil join assessment.');
    }
}

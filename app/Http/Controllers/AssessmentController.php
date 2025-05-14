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
            'kode_assessment' => 'required|string|min:6|max:10',
        ], [
            'kode_assessment.required' => 'Kode assessment harus diisi',
            'kode_assessment.min' => 'Kode assessment minimal 6 karakter',
            'kode_assessment.max' => 'Kode assessment maksimal 10 karakter'
        ]);

        // Cek jabatan user
        if (Auth::user()->jabatan === 'guest') {
            return back()->with('error', 'Maaf, akun guest tidak dapat mengakses kode assessment.');
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

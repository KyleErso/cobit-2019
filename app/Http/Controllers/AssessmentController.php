<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assessment;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Storage;

class AssessmentController extends Controller
{
     public function index(Request $request)
    {
        // Pastikan user sudah login
        if (!Auth::check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Anda harus login untuk melihat daftar assessment.');
        }

        $user = Auth::user();

        // Mulai bangun query: hanya ambil assessment yang instansinya LIKE organisasi user
        $query = Assessment::query();

        if (!empty($user->organisasi)) {
            $query->where('instansi', 'like', '%' . $user->organisasi . '%');
        }

        // (Opsional) filter manual oleh user via ?kode_assessment=... atau ?instansi=...
        if ($request->filled('kode_assessment')) {
            $query->where('kode_assessment', 'like', '%' . $request->kode_assessment . '%');
        }
        if ($request->filled('instansi')) {
            $query->where('instansi', 'like', '%' . $request->instansi . '%');
        }

        // Eksekusi query
        $assessments = $query->orderBy('created_at', 'desc')->get();

        // Kirim ke view resources/views/assessment/list.blade.php
        return view('assessment.list', compact('assessments'));
    }

    /**
     * (Metode showJoinForm() dan join() tetap ada, tidak diubah)
     */
    public function showJoinForm(Request $request)
    {
        // … kode lama jika diperlukan …
          return view('cobit2019.cobit_home', compact('assessments'));
    }

      /**
     * User mengirim request untuk join assessment
     * Disimpan ke file storage/app/requests.json
     */
public function requestAssessment(Request $request)
{
    $data = $request->validate([
        'kode_assessment' => 'required|string|exists:assessment,kode_assessment',
    ]);

    if (! Auth::check()) {
        return redirect()
            ->route('cobit.home')    // ganti sesuai nama route home-mu
            ->with('error', 'Anda harus login terlebih dahulu.');
    }

    $user = Auth::user();
    $assessment = Assessment::where('kode_assessment', $data['kode_assessment'])->first();

    $path = 'requests.json';
    $all = Storage::exists($path)
        ? json_decode(Storage::get($path), true)
        : [];

    $exists = collect($all)->first(fn($item) =>
        $item['user_id']===$user->id && $item['assessment_id']===$assessment->id
    );
    if ($exists) {
        return redirect()
            ->route('cobit.home')
            ->with('error', 'Anda sudah mengirim request untuk assessment ini.');
    }

    $all[] = [
        'user_id'       => $user->id,
        'username'      => $user->name,
        'assessment_id' => $assessment->id,
        'kode'          => $assessment->kode_assessment,
        'instansi'      => $assessment->instansi,
        'requested_at'  => now()->toDateTimeString(),
        'status'        => 'pending',
    ];

    Storage::put($path, json_encode($all, JSON_PRETTY_PRINT));

    return redirect()
        ->route('cobit.home')
        ->with('success', 'Request berhasil dikirim. Silakan tunggu approval admin.');
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

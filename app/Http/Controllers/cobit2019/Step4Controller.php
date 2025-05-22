<?php

namespace App\Http\Controllers\cobit2019;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assessment;

class Step4Controller extends Controller
{
    /**
     * Tampilkan halaman Step 4, dengan nilai adjustment & reason yang
     * sebelumnya sudah disimpan di session (jika ada).
     */
    public function index(Request $request)
{
    // 1) Ambil data adjustment & reason dari session (jika pernah disimpan)
    $step4Adjust    = session('step4.adjustment', []);
    $step4ReasonAdj = session('step4.reason_adjust', []);
    $step4ReasonTgt = session('step4.reason_target', []);

    // 2) Ambil data Step 2 dari session
    $step2 = [
        'weights'              => session('step2.weights', []),
        'relative_importances' => session('step2.relative_importances', []),
        'totals'               => session('step2.totals', []),
    ];

    // 3) Ambil data Step 3 dari session
    $step3 = [
        'weights'        => session('step3.weights', []),
        'refined_scopes' => session('step3.refined_scopes', []),
    ];

    // 4) Ambil assessment_id dari session
    $assessment_id = session('assessment_id');
    if (! $assessment_id) {
        return redirect()->back()->with('error', 'Assessment ID tidak ditemukan.');
    }

    // 5) Eager‐load Assessment beserta masing‐masing latest RelativeImportances DF1…DF10
    $assessment = Assessment::with([
        'df1RelativeImportances'   => fn($q) => $q->latest('created_at')->limit(1),
        'df2RelativeImportances'   => fn($q) => $q->latest('created_at')->limit(1),
        'df3RelativeImportances'   => fn($q) => $q->latest('created_at')->limit(1),
        'df4RelativeImportances'   => fn($q) => $q->latest('created_at')->limit(1),
        'df5RelativeImportances'   => fn($q) => $q->latest('created_at')->limit(1),
        'df6RelativeImportances'   => fn($q) => $q->latest('created_at')->limit(1),
        'df7RelativeImportances'   => fn($q) => $q->latest('created_at')->limit(1),
        'df8RelativeImportances'   => fn($q) => $q->latest('created_at')->limit(1),
        'df9RelativeImportances'   => fn($q) => $q->latest('created_at')->limit(1),
        'df10RelativeImportances'  => fn($q) => $q->latest('created_at')->limit(1),
    ])
    ->where('assessment_id', $assessment_id)
    ->first();

    if (! $assessment) {
        return redirect()->back()->with('error', 'Data assessment tidak ditemukan.');
    }

    // 6) Tampilkan view, kirim semua data termasuk eager‐loaded relations
    return view('cobit2019.step4.step4sumaryblade', [
        'step2'          => $step2,
        'step3'          => $step3,
        'assessment'     => $assessment,
        'step4Adjust'    => $step4Adjust,
        'step4ReasonAdj' => $step4ReasonAdj,
        'step4ReasonTgt' => $step4ReasonTgt,
    ]);
}


    /**
     * Simpan data Step 4 (adjustment + alasan) ke session sebagai “Simpan Sementara”.
     */
    public function store(Request $request)
    {
        // 1) Validasi (opsional, sesuai kebutuhan)
        // $request->validate([
        //     'adjustment.*'     => 'integer|min:-100|max:100',
        //     'reason_adjust.*'  => 'nullable|string|max:255',
        //     'reason_target.*'  => 'nullable|string|max:255',
        // ]);

        // 2) Ambil hanya field yang kita butuhkan
        $data = $request->only([
            'adjustment',     // array keyed by code
            'reason_adjust',  // array keyed by code
            'reason_target',  // array keyed by code
        ]);

        // 3) Simpan ke session
        session([
            'step4.adjustment'    => $data['adjustment']    ?? [],
            'step4.reason_adjust' => $data['reason_adjust'] ?? [],
            'step4.reason_target' => $data['reason_target'] ?? [],
        ]);

        // 4) Redirect kembali dengan pesan sukses
        return redirect()->route('step4.index')
                         ->with('success', 'Data Step 4 berhasil disimpan sementara.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DesignFactor1;
use App\Models\DesignFactor1Score;
use App\Models\DesignFactor1RelativeImportance;

class DfController extends Controller
{
    // Method untuk menampilkan form Design Factor
    public function showDesignFactorForm($id)
    {
        return view('df1.design_factor', compact('id'));
    }

    // Method untuk menyimpan data dari form
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'df_id' => 'required|integer',
            'strategy_archetype' => 'required|integer',
            'current_performance' => 'required|integer',
            'future_goals' => 'required|integer',
            'alignment_with_it' => 'required|integer',
        ]);

        // Simpan data ke tabel design_factor_1
        $designFactor = DesignFactor1::create([
            'id' => Auth::id(), // Ambil ID user yang sedang login
            'df_id' => $validated['df_id'],
            'input1df1' => $validated['strategy_archetype'],
            'input2df1' => $validated['current_performance'],
            'input3df1' => $validated['future_goals'],
            'input4df1' => $validated['alignment_with_it'],
        ]);
        //==========================================================================
        // Matriks tetap (DF1map) dengan dimensi (40, 4)
        $DF1map = [
            [1.0, 1.0, 1.5, 1.5],
            [1.5, 1.0, 2.0, 3.5],
            [1.0, 1.0, 1.0, 2.0],
            [1.5, 1.0, 4.0, 1.0],
            [1.5, 1.5, 1.0, 2.0],
            [1.0, 1.0, 1.0, 1.0],
            [3.5, 3.5, 1.5, 1.0],
            [4.0, 2.0, 1.0, 1.0],
            [1.0, 4.0, 1.0, 1.0],
            [3.5, 4.0, 2.5, 1.0],
            [1.5, 1.0, 4.0, 1.0],
            [2.0, 1.0, 1.0, 1.0],
            [1.0, 1.5, 1.0, 3.5],
            [1.0, 1.0, 1.5, 4.0],
            [1.0, 1.0, 3.5, 1.5],
            [1.0, 1.0, 1.0, 4.0],
            [1.0, 1.5, 1.0, 2.5],
            [1.0, 1.0, 1.0, 2.5],
            [1.0, 1.0, 1.0, 1.0],
            [4.0, 2.0, 1.5, 1.5],
            [1.0, 1.0, 1.5, 1.0],
            [1.0, 1.0, 1.5, 1.0],
            [1.0, 1.0, 1.0, 3.0],
            [4.0, 2.0, 1.0, 1.5],
            [2.0, 2.0, 1.0, 1.5],
            [1.5, 2.0, 1.0, 1.5],
            [1.0, 3.5, 1.0, 1.0],
            [1.0, 1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0, 1.0],
            [3.5, 3.0, 1.5, 1.0],
            [1.0, 1.0, 1.0, 1.5],
            [1.0, 1.0, 1.0, 4.0],
            [1.0, 1.0, 1.0, 3.0],
            [1.0, 1.0, 1.0, 4.0],
            [1.0, 1.0, 1.0, 2.5],
            [1.0, 1.0, 1.0, 1.5],
            [1.0, 1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0, 1.0]
        ];

        // Input data untuk D7:D10 dari input pengguna
        $DF1_INPUT = [
            $designFactor->input1df1,
            $designFactor->input2df1,
            $designFactor->input3df1,
            $designFactor->input4df1
        ];


        // Data baseline untuk E7:E10 (tetap, tidak berubah)
        $DF1_BASELINE = [3, 3, 3, 3];

        // Menghitung E12 sebagai rata-rata dari D7:D10
        $E12 = array_sum($DF1_INPUT) / count($DF1_INPUT);

        // Menghitung E14 sebagai rata-rata dari E7:E10 dibagi E12
        $average_E7_E10 = array_sum($DF1_BASELINE) / count($DF1_BASELINE);
        $E14 = ($E12 != 0) ? $average_E7_E10 / $E12 : 0;

        // Menghitung DF1_SCORE
        $DF1_SCORE = [];
        foreach ($DF1map as $row) {
            $DF1_SCORE[] = array_sum(array_map(function ($a, $b) {
                return $a * $b;
            }, $row, $DF1_INPUT));
        }

        $DF1_BASELINE_SCORE = [
            15,
            24,
            15,
            22.5,
            18,
            12,
            28.5,
            24,
            21,
            33,
            22.5,
            15,
            21,
            22.5,
            21,
            21,
            18,
            16.5,
            12,
            27,
            13.5,
            13.5,
            18,
            25.5,
            19.5,
            18,
            19.5,
            12,
            12,
            27,
            13.5,
            21,
            18,
            21,
            16.5,
            13.5,
            12,
            12,
            12,
            12
        ];

        // Menghitung DF1_RELATIVE_IMPORTANCE dengan pembulatan
        $DF1_RELATIVE_IMPORTANCE = [];
        foreach ($DF1_SCORE as $index => $b) {
            $c = $DF1_BASELINE_SCORE[$index];
            if ($c != 0) {
                $result = round($E14 * 100 * $b / $c / 5) * 5 - 100;
            } else {
                $result = 0;
            }
            $DF1_RELATIVE_IMPORTANCE[] = $result;
        }
        //==========================================================================
        // Siapkan data untuk tabel design_factor_1_score
        $dataForScore = ['id' => Auth::id(), 'df1_id' => $designFactor->df_id];
        foreach ($DF1_SCORE as $index => $value) {
            $dataForScore['s_df1_' . ($index + 1)] = $value;
        }
        DesignFactor1Score::create($dataForScore);

        // Siapkan data untuk tabel design_factor_1_relative_importance
        $dataForRelativeImportance = ['id' => Auth::id(), 'df1_id' => $designFactor->df_id];
        foreach ($DF1_RELATIVE_IMPORTANCE as $index => $value) {
            $dataForRelativeImportance['r_df1_' . ($index + 1)] = $value;
        }
        DesignFactor1RelativeImportance::create($dataForRelativeImportance);

        // Redirect ke halaman output dengan pesan sukses
        return redirect()->route('df1.output', ['id' => $designFactor->df_id])
            ->with('success', 'Data berhasil disimpan!');
    }
    //==========================================================================
    // Method untuk menampilkan output Design Factor
    public function showOutput($id)
    {
        // Ambil data dari tabel design_factor_1 dan design_factor_1_score
        $designFactor = DesignFactor1::where('df_id', $id)
            ->where('id', Auth::id())
            ->latest()
            ->first();

        $designFactorScore = DesignFactor1Score::where('df1_id', $id)
            ->where('id', Auth::id())
            ->latest()
            ->first();

        // Ambil data dari DesignFactor1RelativeImportance
        $designFactorRelativeImportance = DesignFactor1RelativeImportance::where('df1_id', $id)
            ->where('id', Auth::id())
            ->latest()
            ->first();

        // Periksa jika data tidak ditemukan
        if (!$designFactor || !$designFactorScore || !$designFactorRelativeImportance) {
            return redirect()->route('home')->with('error', 'Data tidak ditemukan.');
        }

        // Kirim data ke view
        return view('df1.df1_output', [
            'designFactor' => $designFactor,
            'designFactorScore' => $designFactorScore,
            'designFactorRelativeImportance' => $designFactorRelativeImportance
        ]);
    }
}

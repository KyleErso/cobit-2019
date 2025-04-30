<?php

# Struktur lokasi si folder ini
namespace App\Http\Controllers\cobit2019;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\DesignFactor7;
use App\Models\DesignFactor7Score;
use App\Models\DesignFactor7RelativeImportance;

class Df7Controller extends Controller
{
    /** ===================================================================
     * Method untuk menampilkan form Design Factor 7.
     * Menampilkan halaman form input untuk Design Factor 7 berdasarkan ID.
     * ===================================================================*/
    public function showDesignFactor7Form($id)
    {
        return view('cobit2019.df7.design_factor7', compact('id'));
    }

    public function store(Request $request)
    {
        // ===================================================================
        // Validasi input dari form
        // ===================================================================
        $validated = $request->validate([
            'df_id' => 'required|integer',
            'input1df7' => 'required|integer',
            'input2df7' => 'required|integer',
            'input3df7' => 'required|integer',
            'input4df7' => 'required|integer', // Validasi untuk input keempat
        ]);

        $assessment_id = session('assessment_id');
        if (!$assessment_id) {
            return redirect()->back()->with('error', 'Assessment ID tidak ditemukan, silahkan join assessment terlebih dahulu.');
        }
        // ===================================================================
        // Simpan data ke tabel design_factor_7
        // ===================================================================
        $designFactor7 = DesignFactor7::create([
            'id' => Auth::id(), // ID user yang sedang login
            'df_id' => $validated['df_id'], // ID terkait Design Factor
            'assessment_id' => $assessment_id, // Menggunakan assessment_id dari session
            'input1df7' => $validated['input1df7'], // Input 1
            'input2df7' => $validated['input2df7'], // Input 2
            'input3df7' => $validated['input3df7'], // Input 3
            'input4df7' => $validated['input4df7'], // Input 4
        ]);

        // ===================================================================
        // NILAI INPUT DF7
        // ===================================================================
        $DF7_INPUT = [
            [$designFactor7->input1df7],
            [$designFactor7->input2df7],
            [$designFactor7->input3df7],
            [$designFactor7->input4df7], // Termasuk input keempat
        ];


        // ===================================================================
        // DF7_MAP: Array 2D yang berisi koefisien untuk perhitungan Design Factor 7
        // Setiap baris mewakili satu set nilai untuk perhitungan.
        // Format: [Kolom1, Kolom2, Kolom3, Kolom4]
        // ===================================================================
        $DF7_MAP = [
            [1.0, 2.0, 1.5, 4.0],
            [1.0, 1.0, 2.5, 3.0],
            [1.0, 3.0, 1.0, 3.0],
            [1.0, 1.0, 1.0, 2.0],
            [1.0, 1.0, 1.0, 2.0],
            [1.0, 1.5, 1.5, 2.5],
            [1.0, 1.0, 3.0, 3.0],
            [1.0, 1.0, 2.0, 2.0],
            [0.5, 1.0, 3.5, 4.0],
            [1.0, 1.0, 2.5, 3.0],
            [1.0, 1.0, 1.0, 2.0],
            [1.0, 1.0, 1.0, 1.5],
            [1.0, 1.0, 2.0, 2.5],
            [1.0, 2.0, 1.5, 2.0],
            [1.0, 2.5, 1.5, 2.0],
            [1.0, 1.5, 1.5, 2.0],
            [1.0, 2.5, 1.0, 3.0],
            [1.0, 2.0, 1.5, 3.0],
            [1.0, 1.5, 1.5, 2.5],
            [1.0, 1.0, 2.0, 2.5],
            [1.0, 1.0, 3.0, 3.0],
            [1.0, 1.0, 3.0, 3.0],
            [1.0, 2.5, 1.5, 2.0],
            [1.0, 1.0, 1.0, 2.0],
            [1.0, 2.5, 1.0, 2.0],
            [1.0, 1.0, 2.0, 2.0],
            [1.0, 1.0, 1.0, 2.0],
            [1.0, 1.0, 1.0, 2.0],
            [1.0, 1.5, 1.0, 2.0],
            [1.0, 1.0, 2.0, 2.0],
            [1.0, 3.5, 1.0, 3.0],
            [1.0, 3.0, 1.5, 3.0],
            [1.0, 3.0, 1.5, 3.5],
            [1.0, 3.0, 1.5, 3.5],
            [1.5, 2.5, 1.5, 3.5],
            [1.0, 1.0, 1.0, 2.5],
            [1.0, 1.0, 1.0, 2.0],
            [1.0, 1.0, 1.0, 2.0],
            [1.0, 1.0, 1.0, 1.5],
            [1.0, 1.0, 1.0, 2.0]
        ];

        // ===================================================================
        // DF7_BASELINE: Array 2D yang berisi nilai baseline untuk perhitungan
        // Format: [Baris1], [Baris2], [Baris3], [Baris4]
        // ===================================================================
        $DF7_BASELINE = [
            [3],
            [3],
            [3],
            [3]
        ];

        // ===================================================================
        // DF7_SC_BASELINE: Array 2D yang berisi nilai baseline untuk skor
        // Setiap baris mewakili satu nilai baseline.
        // Format: [Baris1], [Baris2], ..., [Baris40]
        // ===================================================================
        $DF7_SC_BASELINE = [
            [25.5],
            [22.5],
            [24.0],
            [15.0],
            [15.0],
            [19.5],
            [24.0],
            [18.0],
            [27.0],
            [22.5],
            [15.0],
            [13.5],
            [19.5],
            [19.5],
            [21.0],
            [18.0],
            [22.5],
            [22.5],
            [19.5],
            [19.5],
            [24.0],
            [24.0],
            [21.0],
            [15.0],
            [19.5],
            [18.0],
            [15.0],
            [15.0],
            [16.5],
            [18.0],
            [25.5],
            [25.5],
            [27.0],
            [27.0],
            [27.0],
            [16.5],
            [15.0],
            [15.0],
            [13.5],
            [15.0]
        ];

        // ===================================================================
        // Fungsi untuk pembulatan
        // ===================================================================
        function mround($value, $precision)
        {
            return round($value / $precision) * $precision;
        }

        // ===================================================================
        // Menghitung rata-rata INPUT
        // ===================================================================
        $DF7_INPUT_flat = array_merge(...$DF7_INPUT); // Flatten array input
        $DF7_INP_AVRG = array_sum($DF7_INPUT_flat) / count($DF7_INPUT_flat); // Hitung rata-rata

        // ===================================================================
        // Menghitung rata-rata dari $DF7_BASELINE
        // ===================================================================
        $DF7_BASELINE_flat = array_merge(...$DF7_BASELINE); // Flatten array baseline
        $DF7_BASELINE_AVERAGE = array_sum($DF7_BASELINE_flat) / count($DF7_BASELINE_flat); // Hitung rata-rata

        // ===================================================================
        // Menghitung rasio baseline terhadap input
        // ===================================================================
        $DF7_IN_BS_AVRG = $DF7_BASELINE_AVERAGE / $DF7_INP_AVRG;

        // ===================================================================
        // Menghitung nilai DF7_SCORE
        // ===================================================================
        $DF7_SCORE = [];
        foreach ($DF7_MAP as $i => $row) {
            $DF7_SCORE[$i] = 0; // Inisialisasi skor untuk baris ke-$i
            foreach ($DF7_INPUT as $j => $input) {
                $DF7_SCORE[$i] += $row[$j] * $input[0]; // Kalikan elemen dan tambahkan ke total
            }
        }

        // ===================================================================
        // Menghitung DF7_RELATIVE_IMP
        // ===================================================================
        $DF7_RELATIVE_IMP = [];
        foreach ($DF7_SCORE as $i => $score) {
            if (isset($DF7_SC_BASELINE[$i][0]) && $DF7_SC_BASELINE[$i][0] != 0) {
                // Hitung nilai relatif
                $calculation = ($DF7_IN_BS_AVRG * 100 * $score / $DF7_SC_BASELINE[$i][0]);
                $DF7_RELATIVE_IMP[$i] = mround($calculation, 5) - 100; // Bulatkan dan kurangi 100
            } else {
                // Jika baseline nol, set nilai relatif ke 0
                $DF7_RELATIVE_IMP[$i] = 0;
            }
        }

        // ===================================================================
        // Siapkan data untuk tabel design_factor_7_score
        // ===================================================================
        $dataForScore = [
            'id' => Auth::id(), 
            'df7_id' => $designFactor7->df_id,
            'assessment_id' => $assessment_id, // Menggunakan assessment_id dari session
        ];
        foreach ($DF7_SCORE as $index => $value) {
            $dataForScore['s_df7_' . ($index + 1)] = $value;
        }
        DesignFactor7Score::create($dataForScore);

        // ===================================================================
        // Siapkan data untuk tabel design_factor_7_relative_importance
        // ===================================================================
        $dataForRelativeImportance = [
            'id' => Auth::id(), 
            'df7_id' => $designFactor7->df_id,
            'assessment_id' => $assessment_id, ];
        foreach ($DF7_RELATIVE_IMP as $index => $value) {
            $dataForRelativeImportance['r_df7_' . ($index + 1)] = $value;
        }
        DesignFactor7RelativeImportance::create($dataForRelativeImportance);
        // ===================================================================
        // Redirect atau respon setelah penyimpanan data berhasil
        // ===================================================================
        return redirect()->route('df7.output', ['id' => $validated['df_id']])
            ->with('success', 'Data berhasil disimpan!');
    }
    public function showOutput($id)
    {
        // ===================================================================
        // Ambil data dari tabel design_factor_7 berdasarkan ID dan ID user yang sedang login
        // ===================================================================
        $designFactor7 = DesignFactor7::where('df_id', $id)
            ->where('id', Auth::id())  // Pastikan hanya data untuk user yang sedang login yang diambil
            ->latest()
            ->first();

        // ===================================================================
        // Ambil data dari tabel design_factor_7_relative_importance berdasarkan ID dan ID user yang sedang login
        // ===================================================================
        $designFactorRelativeImportance = DesignFactor7RelativeImportance::where('df7_id', $id)
            ->where('id', Auth::id())
            ->latest()
            ->first();

        // ===================================================================
        // Menampilkan tampilan output dengan data yang diambil
        // ===================================================================
        return view('cobit2019.df7.df7_output', compact('designFactor7', 'designFactorRelativeImportance'));
    }
}
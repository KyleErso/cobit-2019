<?php

# Struktur lokasi si folder ini
namespace App\Http\Controllers\cobit2019;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\DesignFactor8;
use App\Models\DesignFactor8Score;
use App\Models\DesignFactor8RelativeImportance;

class Df8Controller extends Controller
{
    /** ===================================================================
     * Method untuk menampilkan form Design Factor 8.
     * Menampilkan halaman form input untuk Design Factor 8 berdasarkan ID.
     * ===================================================================*/
    public function showDesignFactor8Form($id)
    {
        return view('cobit2019.df8.design_factor8', compact('id'));
    }

    /** ===================================================================
     * Method untuk menyimpan data dari form Design Factor 8.
     * ===================================================================*/
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'df_id' => 'required|integer',
            'input1df8' => 'required|integer',
            'input2df8' => 'required|integer',
            'input3df8' => 'required|integer', // Hanya 3 input fields
        ]);

        $assessment_id = session('assessment_id');
        if (!$assessment_id) {
            return redirect()->back()->with('error', 'Assessment ID tidak ditemukan, silahkan join assessment terlebih dahulu.');
        }

        // Simpan data ke tabel design_factor_8
        $designFactor8 = DesignFactor8::create([
            'id' => Auth::id(), // ID user yang sedang login
            'df_id' => $validated['df_id'], // ID terkait Design Factor
            'assessment_id' => $assessment_id,  // Menggunakan assessment_id dari session
            'input1df8' => $validated['input1df8'], // Input 1
            'input2df8' => $validated['input2df8'], // Input 2
            'input3df8' => $validated['input3df8'], // Input 3
        ]);

        // ===================================================================
        // NILAI INPUT DF8
        // ===================================================================

        $DF8_INPUT = [
            [$designFactor8->input1df8],
            [$designFactor8->input2df8],
            [$designFactor8->input3df8],  // Including the third input
        ];

        // Mengubah INPUT JADI %
        foreach ($DF8_INPUT as $i => $value) {
            $DF8_INPUT[$i][0] /= 100;  // Convert input value to percentage
        }
        // ===================================================================
        // DF8_MAP: Array 2D yang berisi koefisien untuk perhitungan Design Factor 8
        // Setiap baris mewakili satu set nilai untuk perhitungan.
        // Format: [Kolom1, Kolom2, Kolom3]
        // ===================================================================
        $DF8_MAP = [
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 2.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [4.0, 4.0, 1.0],
            [4.0, 4.0, 1.0],
            [1.0, 1.0, 1.0],
            [2.0, 2.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [3.0, 3.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0],
            [1.0, 1.0, 1.0]
        ];

        // ===================================================================
        // DF8_BASELINE: Array 2D yang berisi nilai baseline untuk perhitungan
        // Format: [Baris1], [Baris2], [Baris3]
        // ===================================================================
        $DF8_BASELINE = [
            [33], // 33%
            [33], // 33%
            [34]  // 34%
        ];

        // ===================================================================
        // DF8_SC_BASELINE: Array 2D yang berisi nilai baseline untuk skor
        // Setiap baris mewakili satu nilai baseline.
        // Format: [Baris1], [Baris2], ..., [Baris40]
        // ===================================================================
        $DF8_SC_BASELINE = [
            [1.00],
            [1.00],
            [1.33],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [2.98],
            [2.98],
            [1.00],
            [1.66],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [1.00],
            [2.32],
            [1.00],
            [1.00],
            [1.00]
        ];


        // ===================================================================
        // DF8: Menghitung nilai DF8_SCORE dan DF8_RELATIVE_IMP
        // ===================================================================


        $DF8_SCORE = [];
        foreach ($DF8_MAP as $i => $row) {
            $DF8_SCORE[$i] = 0; // Inisialisasi skor untuk baris ke-$i
            foreach ($DF8_INPUT as $j => $input) {
                $DF8_SCORE[$i] += $row[$j] * $input[0]; // Kalikan elemen dan tambahkan ke total
            }
        }

        // Fungsi MROUND untuk membulatkan ke kelipatan tertentu
        function mround($value, $multiple)
        {
            if ($multiple == 0)
                return 0;
            return round($value / $multiple) * $multiple;
        }

        // ===================================================================
        // Menghitung DF8_RELATIVE_IMP
        // ===================================================================

        $DF8_RELATIVE_IMP = [];
        foreach ($DF8_SCORE as $i => $score) {
            // Cek apakah baseline tidak nol untuk menghindari pembagian oleh nol
            if ($DF8_SC_BASELINE[$i][0] != 0) {
                // Hitung nilai relatif
                $relativeValue = (100 * $score / $DF8_SC_BASELINE[$i][0]);
                // Bulatkan ke kelipatan 5 dan kurangi 100
                $DF8_RELATIVE_IMP[$i] = mround($relativeValue, 5) - 100;
            } else {
                // Jika baseline nol, set nilai relatif ke 0 (IFERROR)
                $DF8_RELATIVE_IMP[$i] = 0;
            }
        }

        // ===================================================================
        // Siapkan data untuk tabel design_factor_8_score
        // ===================================================================
        $dataForScore = [
            'id' => Auth::id(), 
            'df8_id' => $designFactor8->df_id,
            'assessment_id' => $assessment_id,
        ];
        foreach ($DF8_SCORE as $index => $value) {
            $dataForScore['s_df8_' . ($index + 1)] = $value;
        }
        DesignFactor8Score::create($dataForScore);

        // ===================================================================
        // Siapkan data untuk tabel design_factor_8_relative_importance
        // ===================================================================
        $dataForRelativeImportance = [
            'id' => Auth::id(),
            'df8_id' => $designFactor8->df_id,
            'assessment_id' => $assessment_id,  
        ];
        foreach ($DF8_RELATIVE_IMP as $index => $value) {
            $dataForRelativeImportance['r_df8_' . ($index + 1)] = $value;
        }
        DesignFactor8RelativeImportance::create($dataForRelativeImportance);

        // Redirect atau respon setelah penyimpanan data berhasil
        return redirect()->route('df8.output', ['id' => $validated['df_id']])
            ->with('success', 'Data berhasil disimpan!');
    }

    /** ===================================================================
     * Method untuk menampilkan output Design Factor 8.
     * ===================================================================*/
    public function showOutput($id)
    {
        // Ambil data dari tabel design_factor_8 berdasarkan ID dan ID user yang sedang login
        $designFactor8 = DesignFactor8::where('df_id', $id)
            ->where('id', Auth::id())  // Pastikan hanya data untuk user yang sedang login yang diambil
            ->latest()
            ->first();

        // Ambil data dari tabel design_factor_8_relative_importance berdasarkan ID dan ID user yang sedang login
        $designFactorRelativeImportance = DesignFactor8RelativeImportance::where('df8_id', $id)
            ->where('id', Auth::id())
            ->latest()
            ->first();

        // Menampilkan tampilan output dengan data yang diambil
        return view('cobit2019.df8.df8_output', compact('designFactor8', 'designFactorRelativeImportance'));
    }
}
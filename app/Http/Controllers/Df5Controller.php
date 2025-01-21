<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DesignFactor5;
use App\Models\DesignFactor5Score;
use App\Models\DesignFactor5RelativeImportance;

class Df5Controller extends Controller
{
    /** ===================================================================
     * Method untuk menampilkan form Design Factor 5.
     * Menampilkan halaman form input untuk Design Factor 5 berdasarkan ID.
     * ===================================================================*/
    public function showDesignFactor5Form($id)
    {
        // Menampilkan form input untuk Design Factor 4 dengan ID yang diberikan
        return view('df5.design_factor5', compact('id'));
    }

    public function store(Request $request)
    {
        // ===================================================================
        // Validasi input dari form
        // ===================================================================
        $validated = $request->validate([
            'df_id' => 'required|integer',
            'input1df5' => 'required|integer',
            'input2df5' => 'required|integer',
        ]);

        // ===================================================================
        // Simpan data ke tabel design_factor_5
        // ===================================================================
        $designFactor5 = DesignFactor5::create([
            'id' => Auth::id(),  // Get the logged-in user's ID
            'df_id' => $validated['df_id'],
            'input1df5' => $validated['input1df5'],
            'input2df5' => $validated['input2df5'],
        ]);

        // ===================================================================
        // Perhitungan DF
        // ===================================================================


        // ===================================================================
        // NILAI INPUT DF
        // ===================================================================

        $DF5_INPUT = [
            [$designFactor5->input1df5],
            [$designFactor5->input2df5],
        ];
        // mengubah INPUT JADI %
        foreach ($DF5_INPUT as $i => $value) {
            $DF5_INPUT[$i][0] /= 100;
        }


        // ===================================================================
        // DF 5 MAP
        // ===================================================================

        $DF5_MAP = [
            [3.0, 1.0],
            [1.0, 1.0],
            [4.0, 1.0],
            [1.0, 1.0],
            [2.0, 1.0],
            [3.0, 1.0],
            [1.0, 1.0],
            [3.0, 1.0],
            [1.0, 1.0],
            [1.0, 1.0],
            [1.0, 1.0],
            [2.0, 1.0],
            [1.0, 1.0],
            [2.0, 1.0],
            [3.0, 1.0],
            [2.0, 1.0],
            [4.0, 1.0],
            [4.0, 1.0],
            [3.0, 1.0],
            [1.0, 1.0],
            [1.0, 1.0],
            [1.0, 1.0],
            [2.0, 1.0],
            [1.0, 1.0],
            [3.0, 1.0],
            [1.0, 1.0],
            [1.0, 1.0],
            [1.0, 1.0],
            [3.0, 1.0],
            [1.0, 1.0],
            [1.0, 1.0],
            [3.0, 1.0],
            [2.0, 1.0],
            [4.0, 1.0],
            [3.0, 1.0],
            [3.0, 1.0],
            [3.0, 1.0],
            [2.0, 1.0],
            [3.0, 1.0],
            [3.0, 1.0]
        ];

        // ===================================================================
        // DF 5 BASELINE
        // ===================================================================
        $DF5_BASELINE = [
            [33],
            [67]
        ];

        // ===================================================================
        // DF 5 SCORE BASELINE
        // ===================================================================

        $DF5_SC_BASELINE = [
            [1.66],
            [1.00],
            [1.99],
            [1.00],
            [1.33],
            [1.66],
            [1.00],
            [1.66],
            [1.00],
            [1.00],
            [1.00],
            [1.33],
            [1.00],
            [1.33],
            [1.66],
            [1.33],
            [1.99],
            [1.99],
            [1.66],
            [1.00],
            [1.00],
            [1.00],
            [1.33],
            [1.00],
            [1.66],
            [1.00],
            [1.00],
            [1.00],
            [1.66],
            [1.00],
            [1.00],
            [1.66],
            [1.33],
            [1.99],
            [1.66],
            [1.66],
            [1.66],
            [1.33],
            [1.66],
            [1.66]
        ];


        // Fungsi MROUND untuk membulatkan ke kelipatan tertentu
        function mround($value, $multiple)
        {
            if ($multiple == 0)
                return 0;
            return round($value / $multiple) * $multiple;
        }
        // ===================================================================
        // Menghitung nilai DF5_SCORE
        // ===================================================================

        $DF5_SCORE = [];
        // Proses perkalian matriks
        foreach ($DF5_MAP as $i => $row) {
            $DF5_SCORE[$i] = 0; // Inisialisasi skor untuk baris ke-$i
            foreach ($DF5_INPUT as $j => $input) {
                $DF5_SCORE[$i] += $row[$j] * $input[0]; // Kalikan elemen dan tambahkan ke total
            }
        }

        // ===================================================================
        // Menghitung nilai $DF5_RELATIVE_IMP
        // ===================================================================

        $DF5_RELATIVE_IMP = []; // Array hasil

        foreach ($DF5_SCORE as $i => $score) {
            // Cek apakah baseline tidak nol untuk menghindari pembagian oleh nol
            if ($DF5_SC_BASELINE[$i][0] != 0) {
                $relativeValue = (100 * $score / $DF5_SC_BASELINE[$i][0]);
                $DF5_RELATIVE_IMP[$i] = mround($relativeValue, 5) - 100;
            } else {
                // Jika baseline nol, set nilai relatif ke 0
                $DF5_RELATIVE_IMP[$i] = 0;
            }
        }
        

        // ===================================================================
        // Siapkan data untuk tabel design_factor_5_score
        // ===================================================================
        $dataForScore = ['id' => Auth::id(), 'df5_id' => $designFactor5->df_id];
        foreach ($DF5_SCORE as $index => $value) {
            $dataForScore['s_df5_' . ($index + 1)] = $value;
        }
        DesignFactor5Score::create($dataForScore);

        // ===================================================================
        // Siapkan data untuk tabel design_factor_5_relative_importance
        // ===================================================================
        $dataForRelativeImportance = ['id' => Auth::id(), 'df5_id' => $designFactor5->df_id];
        foreach ($DF5_RELATIVE_IMP as $index => $value) {
            $dataForRelativeImportance['r_df5_' . ($index + 1)] = $value;
        }

        // ===================================================================
        // Simpan data ke tabel design_factor_5_relative_importance
        // ===================================================================
        DesignFactor5RelativeImportance::create($dataForRelativeImportance);


    // ===================================================================
        // Redirect ke halaman output setelah data berhasil disimpan
        // ===================================================================
        return redirect()->route('df5.output', ['id' => $designFactor5->df_id])
            ->with('success', 'Data berhasil disimpan!');
    }

    /**  ===================================================================
     * Method untuk menampilkan output setelah data disimpan.
     * Mengambil data dari database dan menampilkannya di halaman output.
     * ===================================================================*/
    public function showOutput($id)
    {
        // ===================================================================
        // Ambil data dari tabel design_factor_5 berdasarkan ID dan ID user yang sedang login
        // ===================================================================
        $designFactor5 = DesignFactor5::where('df_id', $id)
            ->where('id', Auth::id())
            ->latest()
            ->first();
        // ===================================================================
        // Ambil data dari tabel design_factor_5_Relative_Importance berdasarkan ID dan ID user yang sedang login
        // ===================================================================
        $designFactorRelativeImportance = DesignFactor5RelativeImportance::where('df5_id', $id)
            ->where('id', Auth::id())
            ->latest()
            ->first();

        // ===================================================================
        // Menampilkan tampilan output dengan data yang diambil
        // ===================================================================
        return view('df5.df5_output', compact('designFactor5', 'designFactorRelativeImportance'));
    }

}

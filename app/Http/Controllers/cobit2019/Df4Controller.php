<?php

# Struktur lokasi si folder ini
namespace App\Http\Controllers\cobit2019;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\DesignFactor4;
use App\Models\DesignFactor4Score;
use App\Models\DesignFactor4RelativeImportance;

class Df4Controller extends Controller
{
    /** ===================================================================
     * Method untuk menampilkan form Design Factor 4.
     * Menampilkan halaman form input untuk Design Factor 4 berdasarkan ID.
     * ===================================================================*/
    public function showDesignFactor4Form($id)
    {
        // Menampilkan form input untuk Design Factor 4 dengan ID yang diberikan
        return view('cobit2019.df4.design_factor4', compact('id'));
    }

    /** ===================================================================
     * Method untuk menyimpan data dari form.
     * Menerima input dari form dan menyimpannya ke dalam database.
     * ===================================================================*/
    public function store(Request $request)
    {
        // ===================================================================
        // Validasi input dari form
        // ===================================================================
        $validated = $request->validate([
            'df_id' => 'required|integer',
            'input1df4' => 'required|integer',
            'input2df4' => 'required|integer',
            'input3df4' => 'required|integer',
            'input4df4' => 'required|integer',
            'input5df4' => 'required|integer',
            'input6df4' => 'required|integer',
            'input7df4' => 'required|integer',
            'input8df4' => 'required|integer',
            'input9df4' => 'required|integer',
            'input10df4' => 'required|integer',
            'input11df4' => 'required|integer',
            'input12df4' => 'required|integer',
            'input13df4' => 'required|integer',
            'input14df4' => 'required|integer',
            'input15df4' => 'required|integer',
            'input16df4' => 'required|integer',
            'input17df4' => 'required|integer',
            'input18df4' => 'required|integer',
            'input19df4' => 'required|integer',
            'input20df4' => 'required|integer',
        ]);

        // ===================================================================
        // Simpan data ke tabel design_factor_4
        // ===================================================================
        $designFactor4 = DesignFactor4::create([
            'id' => Auth::id(), // Ambil ID user yang sedang login
            'df_id' => $validated['df_id'],
            'input1df4' => $validated['input1df4'],
            'input2df4' => $validated['input2df4'],
            'input3df4' => $validated['input3df4'],
            'input4df4' => $validated['input4df4'],
            'input5df4' => $validated['input5df4'],
            'input6df4' => $validated['input6df4'],
            'input7df4' => $validated['input7df4'],
            'input8df4' => $validated['input8df4'],
            'input9df4' => $validated['input9df4'],
            'input10df4' => $validated['input10df4'],
            'input11df4' => $validated['input11df4'],
            'input12df4' => $validated['input12df4'],
            'input13df4' => $validated['input13df4'],
            'input14df4' => $validated['input14df4'],
            'input15df4' => $validated['input15df4'],
            'input16df4' => $validated['input16df4'],
            'input17df4' => $validated['input17df4'],
            'input18df4' => $validated['input18df4'],
            'input19df4' => $validated['input19df4'],
            'input20df4' => $validated['input20df4'],
        ]);

        // ===================================================================
        // Perhitungan DF
        // ===================================================================

        $DF4_INPUT = [
            [$designFactor4->input1df4],
            [$designFactor4->input2df4],
            [$designFactor4->input3df4],
            [$designFactor4->input4df4],
            [$designFactor4->input5df4],
            [$designFactor4->input6df4],
            [$designFactor4->input7df4],
            [$designFactor4->input8df4],
            [$designFactor4->input9df4],
            [$designFactor4->input10df4],
            [$designFactor4->input11df4],
            [$designFactor4->input12df4],
            [$designFactor4->input13df4],
            [$designFactor4->input14df4],
            [$designFactor4->input15df4],
            [$designFactor4->input16df4],
            [$designFactor4->input17df4],
            [$designFactor4->input18df4],
            [$designFactor4->input19df4],
            [$designFactor4->input20df4],
        ];

        // ===================================================================
        // DF 4 MAP
        // ===================================================================
        $DF4_MAP = [
            [3.0, 3.0, 1.0, 1.0, 2.0, 2.0, 2.0, 1.0, 1.0, 1.0, 3.0, 3.5, 1.0, 1.0, 1.0, 1.0, 2.0, 3.0, 1.5, 1.0],
            [2.5, 3.0, 1.0, 1.0, 1.5, 2.5, 2.0, 1.5, 0.5, 2.5, 1.5, 1.0, 3.0, 2.0, 1.0, 1.0, 2.0, 2.0, 1.0, 2.5],
            [1.0, 1.0, 2.0, 1.0, 2.0, 2.0, 1.0, 1.0, 0.0, 0.5, 1.0, 0.0, 1.0, 1.5, 1.0, 2.0, 1.0, 1.0, 2.5, 1.0],
            [1.0, 1.0, 1.0, 1.0, 1.0, 2.0, 3.0, 3.5, 3.5, 1.0, 1.5, 0.0, 4.0, 2.0, 1.0, 1.5, 2.0, 2.5, 0.0, 1.0],
            [1.0, 1.0, 1.0, 1.0, 1.5, 2.0, 1.0, 1.0, 0.0, 1.0, 3.0, 1.5, 1.5, 0.5, 0.0, 0.5, 1.0, 1.0, 1.0, 0.0],
            [2.0, 1.0, 2.0, 1.0, 2.0, 2.0, 1.0, 1.0, 0.0, 0.5, 1.5, 4.0, 1.0, 2.0, 1.0, 1.0, 1.5, 2.0, 0.5, 1.0],
            [1.5, 1.5, 1.5, 1.5, 1.0, 1.5, 1.0, 1.0, 0.0, 1.0, 2.5, 0.5, 0.5, 1.5, 1.5, 0.5, 2.0, 2.0, 0.0, 2.5],
            [1.0, 1.5, 1.0, 2.0, 0.5, 1.5, 2.0, 1.5, 1.0, 3.5, 0.5, 0.5, 1.0, 4.0, 1.0, 3.5, 2.0, 3.0, 0.0, 2.0],
            [1.0, 1.0, 1.0, 1.0, 0.5, 0.5, 0.5, 0.5, 0.0, 0.0, 0.5, 1.0, 0.5, 2.0, 1.0, 0.0, 0.5, 0.5, 0.0, 4.0],
            [3.0, 3.0, 1.0, 1.5, 2.0, 2.0, 1.5, 3.5, 0.5, 2.0, 2.0, 1.5, 2.0, 1.0, 0.5, 0.0, 2.5, 2.5, 0.0, 2.0],
            [3.5, 2.0, 1.0, 1.5, 1.5, 2.0, 4.0, 3.0, 1.0, 2.0, 1.0, 1.5, 4.0, 0.0, 0.0, 0.0, 1.0, 2.0, 0.0, 0.0],
            [1.5, 1.0, 1.0, 1.0, 1.0, 1.5, 2.0, 2.0, 4.0, 1.0, 0.0, 0.0, 1.0, 0.0, 3.0, 0.0, 0.5, 0.5, 1.5, 1.0],
            [2.5, 2.0, 1.0, 2.5, 1.5, 1.0, 2.5, 2.0, 1.5, 1.0, 3.0, 1.0, 0.5, 1.0, 4.0, 1.0, 3.0, 3.5, 0.0, 0.5],
            [2.0, 1.5, 2.0, 4.0, 1.0, 2.5, 1.5, 2.0, 0.5, 1.0, 0.0, 0.0, 1.0, 0.0, 0.0, 0.0, 1.0, 1.5, 0.0, 0.0],
            [1.0, 1.0, 2.0, 4.0, 1.5, 1.5, 1.5, 0.0, 1.5, 1.0, 0.0, 0.0, 1.0, 0.0, 0.0, 0.0, 0.5, 2.0, 1.0, 0.0],
            [1.0, 1.0, 3.0, 1.5, 1.0, 3.0, 0.0, 0.0, 0.0, 2.0, 0.0, 0.0, 0.0, 0.5, 0.5, 3.0, 2.0, 2.0, 0.0, 1.0],
            [1.0, 0.5, 2.5, 1.5, 2.0, 2.0, 1.0, 1.0, 0.5, 1.0, 1.0, 1.0, 1.0, 1.0, 1.0, 2.0, 1.0, 1.5, 2.5, 1.0],
            [0.0, 0.0, 3.5, 1.0, 2.0, 1.0, 0.0, 1.0, 0.0, 0.5, 0.0, 0.0, 0.0, 0.0, 0.0, 1.5, 2.0, 1.0, 2.0, 1.0],
            [1.0, 1.5, 3.0, 1.0, 2.5, 1.5, 1.0, 1.5, 0.0, 1.5, 0.0, 0.0, 0.5, 2.5, 0.5, 4.0, 2.5, 2.0, 3.0, 0.5],
            [0.0, 1.0, 1.5, 0.0, 0.0, 0.0, 0.0, 3.0, 1.0, 3.5, 0.0, 0.0, 1.5, 0.5, 1.0, 0.0, 1.5, 2.0, 0.0, 1.0],
            [0.0, 3.0, 0.0, 0.0, 0.5, 2.0, 0.0, 2.0, 0.0, 3.5, 0.0, 1.0, 1.0, 2.0, 2.0, 1.5, 2.5, 3.0, 0.5, 1.0],
            [1.0, 2.0, 2.0, 0.0, 0.0, 2.0, 0.0, 1.0, 0.0, 3.0, 0.0, 0.5, 1.0, 1.0, 1.0, 0.5, 2.0, 2.0, 1.0, 0.5],
            [0.5, 0.0, 2.0, 3.0, 0.0, 2.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.5, 0.0, 0.0, 1.0, 1.0, 1.0, 0.0, 0.5],
            [1.0, 3.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.5, 0.0, 3.0, 1.0, 0.0, 0.0, 0.5, 2.0, 0.0, 0.5, 1.5, 0.0, 1.0],
            [0.0, 0.0, 2.5, 3.0, 0.5, 1.5, 0.0, 1.0, 0.0, 1.5, 0.0, 1.0, 0.5, 1.0, 0.5, 2.0, 2.0, 2.0, 1.0, 1.0],
            [0.0, 1.0, 2.0, 2.0, 0.5, 1.5, 0.0, 0.5, 0.0, 2.0, 0.0, 1.0, 0.0, 1.0, 0.5, 2.0, 2.0, 2.0, 0.0, 1.0],
            [0.0, 0.0, 0.0, 1.5, 0.5, 0.5, 0.0, 1.0, 2.0, 0.5, 0.0, 0.5, 0.0, 1.0, 3.0, 2.0, 1.0, 1.5, 0.0, 0.5],
            [0.5, 0.5, 1.0, 0.0, 0.0, 0.0, 2.0, 2.0, 0.0, 0.0, 0.0, 0.0, 2.0, 1.0, 0.0, 0.0, 1.0, 1.5, 0.0, 0.0],
            [0.0, 0.0, 2.5, 2.0, 0.5, 0.0, 0.0, 0.5, 0.0, 0.0, 0.0, 0.0, 1.0, 1.5, 0.0, 1.5, 1.0, 2.0, 0.0, 0.0],
            [1.0, 2.0, 2.5, 0.0, 0.0, 0.0, 2.0, 3.0, 1.0, 4.0, 0.0, 0.0, 1.5, 2.0, 0.5, 0.0, 1.0, 1.5, 0.0, 0.5],
            [0.0, 0.0, 2.5, 2.0, 1.0, 2.0, 0.0, 0.5, 0.0, 0.0, 0.0, 0.0, 1.0, 0.0, 0.0, 1.5, 1.0, 2.0, 0.0, 0.0],
            [1.0, 1.0, 4.0, 3.0, 1.0, 2.5, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 1.0, 0.0, 0.0, 1.0, 1.0, 1.0, 0.0, 0.0],
            [0.0, 1.0, 3.0, 3.0, 0.0, 3.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 1.0, 1.5, 1.0, 1.0, 1.0, 0.5, 0.0],
            [0.0, 0.0, 3.0, 1.0, 2.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 1.5, 1.0, 2.0, 0.0, 0.0],
            [0.0, 0.0, 4.0, 2.0, 2.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 1.5, 1.0, 2.0, 2.0, 0.0],
            [0.0, 1.0, 0.5, 0.0, 3.0, 0.5, 0.0, 0.0, 0.0, 1.0, 0.0, 0.0, 0.0, 0.0, 1.5, 2.5, 1.5, 1.0, 2.0, 0.0],
            [1.0, 1.5, 2.0, 2.0, 2.5, 3.0, 1.0, 2.0, 1.5, 1.0, 1.0, 1.0, 2.0, 1.0, 1.0, 1.0, 1.5, 1.0, 2.5, 1.0],
            [0.0, 0.0, 2.0, 2.0, 2.5, 2.0, 2.0, 0.0, 0.5, 2.0, 1.0, 1.0, 1.5, 1.0, 0.0, 2.0, 1.0, 1.0, 2.5, 0.0],
            [0.0, 0.0, 2.0, 2.0, 4.0, 0.5, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 0.0, 2.0, 0.0, 0.0, 4.0, 0.0],
            [1.0, 1.0, 3.0, 1.5, 3.0, 4.0, 2.0, 1.0, 1.0, 0.5, 1.0, 1.0, 1.5, 0.0, 1.0, 1.0, 1.0, 1.0, 2.5, 1.0]
        ];


        // ===================================================================
        // DF 4 BASELINE
        // ===================================================================
        $DF4_BASELINE = [
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2],
            [2]
        ];
        // ===================================================================
        // DF 4 SCORE BASELINE
        // ===================================================================
        $DF4_SC_BASELINE = [
            [70],
            [70],
            [47],
            [67],
            [41],
            [56],
            [50],
            [66],
            [32],
            [68],
            [62],
            [47],
            [70],
            [43],
            [39],
            [43],
            [52],
            [33],
            [60],
            [35],
            [51],
            [41],
            [23],
            [28],
            [42],
            [38],
            [31],
            [23],
            [25],
            [45],
            [27],
            [33],
            [32],
            [21],
            [29],
            [29],
            [61],
            [48],
            [29],
            [58]
        ];
        // ===================================================================
        // Fungsi untuk pembulatan
        // ===================================================================

        function mround($value, $precision)
        {
            return round($value / $precision) * $precision;
        }
        // ===================================================================

        // ===================================================================
        // Menghitung rata-rata INPUT
        // ===================================================================
        $DF4_INPUT_flat = array_merge(...$DF4_INPUT);
        $DF4_INP_AVRG = array_sum($DF4_INPUT_flat) / count($DF4_INPUT_flat);

        // ===================================================================
        // Menghitung rata-rata dari $DF4_BASELINE
        // ===================================================================
        $DF4_BASELINE_flat = array_merge(...$DF4_BASELINE);
        $DF4_BASELINE_AVERAGE = array_sum($DF4_BASELINE_flat) / count($DF4_BASELINE_flat);

        $DF4_IN_BS_AVRG = $DF4_BASELINE_AVERAGE / $DF4_INP_AVRG;

        // ===================================================================
        // Menghitung nilai DF4_SCORE
        // ===================================================================
        $DF4_SCORE = [];
        foreach ($DF4_MAP as $i => $row) {
            $DF4_SCORE[$i] = 0;
            foreach ($DF4_INPUT as $j => $input) {
                $DF4_SCORE[$i] += $row[$j] * $input[0];
            }
        }

        // ===================================================================
        // Menghitung DF4_RELATIVE_IMP
        // ===================================================================
        $DF4_RELATIVE_IMP = [];
        foreach ($DF4_SCORE as $i => $score) {
            if (isset($DF4_SC_BASELINE[$i][0]) && $DF4_SC_BASELINE[$i][0] != 0) {
                $calculation = ($DF4_IN_BS_AVRG * 100 * $score / $DF4_SC_BASELINE[$i][0]);
                $DF4_RELATIVE_IMP[$i] = mround($calculation, 5) - 100;
            } else {
                $DF4_RELATIVE_IMP[$i] = 0;
            }
        }

        // ===================================================================
        // Siapkan data untuk tabel design_factor_4_score
        // ===================================================================
        $dataForScore = ['id' => Auth::id(), 'df4_id' => $designFactor4->df_id];
        foreach ($DF4_SCORE as $index => $value) {
            $dataForScore['s_df4_' . ($index + 1)] = $value;
        }
        DesignFactor4Score::create($dataForScore);

        // ===================================================================
        // Siapkan data untuk tabel design_factor_4_relative_importance
        // ===================================================================
        $dataForRelativeImportance = ['id' => Auth::id(), 'df4_id' => $designFactor4->df_id];
        foreach ($DF4_RELATIVE_IMP as $index => $value) {
            $dataForRelativeImportance['r_df4_' . ($index + 1)] = $value;
        }

        // ===================================================================
        // Simpan data ke tabel design_factor_4_relative_importance
        // ===================================================================
        DesignFactor4RelativeImportance::create($dataForRelativeImportance);


        // ===================================================================
        // Redirect ke halaman output setelah data berhasil disimpan
        // ===================================================================
        return redirect()->route('df4.output', ['id' => $designFactor4->df_id])
            ->with('success', 'Data berhasil disimpan!');
    }

    /**  ===================================================================
     * Method untuk menampilkan output setelah data disimpan.
     * Mengambil data dari database dan menampilkannya di halaman output.
     * ===================================================================*/
    public function showOutput($id)
    {
        // ===================================================================
        // Ambil data dari tabel design_factor_4 berdasarkan ID dan ID user yang sedang login
        // ===================================================================
        $designFactor4 = DesignFactor4::where('df_id', $id)
            ->where('id', Auth::id())
            ->latest()
            ->first();
        // ===================================================================
        // Ambil data dari tabel design_factor_4_Relative_Importance berdasarkan ID dan ID user yang sedang login
        // ===================================================================
        $designFactorRelativeImportance = DesignFactor4RelativeImportance::where('df4_id', $id)
            ->where('id', Auth::id())
            ->latest()
            ->first();

        // ===================================================================
        // Menampilkan tampilan output dengan data yang diambil
        // ===================================================================
        return view('cobit2019.df4.df4_output', compact('designFactor4', 'designFactorRelativeImportance'));
    }
}

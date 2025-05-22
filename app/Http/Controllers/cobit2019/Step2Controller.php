<?php
namespace App\Http\Controllers\cobit2019;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Assessment;

class Step2Controller extends Controller
{
    public function index(Request $request)
    {

        // Ambil assessment_id dari session
        $assessmentId = session('assessment_id');
        if (!$assessmentId) {
            return redirect()->back()->with('error', 'Assessment ID tidak ditemukan.');
        }
        
        // Jika user adalah guest, langsung gunakan assessment ID 1
        if ($request->user()->role === 'guest') {
            $assessmentId = 1;
        }
        
        // Ambil data Assessment beserta relative importance untuk DF1 sampai DF4
        $assessment = Assessment::with([
            'df1RelativeImportances' => function($query) {
                $query->latest();
            },
            'df2RelativeImportances' => function($query) {
                $query->latest();
            },
            'df3RelativeImportances' => function($query) {
                $query->latest();
            },
            'df4RelativeImportances' => function($query) {
                $query->latest();
            },
        ])->where('assessment_id', $assessmentId)->first();
        
        if (!$assessment) {
            return redirect()->back()->with('error', 'Data Assessment tidak ditemukan.');
        }
        
        // Gunakan hanya ID user yang sedang login.
        $userIds = collect([auth()->id()]);
        
        // Oper data ke view summary
        return view('cobit2019.step2.step2sumaryblade', compact('assessment', 'userIds'));
    }

  public function storeStep2(Request $request)
{
    // Validasi bahwa ketiga field hadir dan berbentuk JSON
    $request->validate([
        'weights'              => 'required|json',
        'relative_importances' => 'required|json',
        'totals'               => 'required|json',
    ]);

    // Decode data dari hidden inputs
    $weights             = json_decode($request->input('weights'), true);
    $relativeImportances = json_decode($request->input('relative_importances'), true);
    $totals              = json_decode($request->input('totals'), true);

    // Simpan semua data ke session
    session()->put('step2.weights', $weights);
    session()->put('step2.relative_importances', $relativeImportances);
    session()->put('step2.totals', $totals);

    // Redirect kembali ke form Step 2 dengan pesan sukses
    return redirect()
        ->route('step2.index')
        ->with('success', 'Data Step 2 berhasil disimpan di session.');
    }

}
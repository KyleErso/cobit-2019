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
        
        // Ambil data Assessment beserta relative importance untuk DF1 sampai DF4
        $assessment = Assessment::with([
            'df1RelativeImportances',
            'df2RelativeImportances',
            'df3RelativeImportances',
            'df4RelativeImportances',
        ])->where('assessment_id', $assessmentId)->first();
        
        if (!$assessment) {
            return redirect()->back()->with('error', 'Data Assessment tidak ditemukan.');
        }
        
        // Gunakan hanya ID user yang sedang login.
        $userIds = collect([auth()->id()]);
        
        // Oper data ke view summary
        return view('cobit2019.step2.step2sumaryblade', compact('assessment', 'userIds'));
    }
}
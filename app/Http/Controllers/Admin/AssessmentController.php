<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Assessment;

class AssessmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan Admin Dashboard:
     * – Daftar semua kode assessment
     * – Form untuk membuat kode baru (instansi + kode)
     */
    public function index()
    {
        // pastikan hanya admin yang bisa akses
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $assessments = Assessment::orderBy('created_at', 'desc')->get();
        return view('admin.dashboard', compact('assessments'));
    }

    /**
     * Simpan kode assessment baru
     */
    public function store(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $data = $request->validate([
            'kode_assessment' => 'required|string|unique:assessment,kode_assessment',
            'instansi'        => 'required|string|max:255',
        ]);

        Assessment::create([
            'kode_assessment' => $data['kode_assessment'],
            'instansi'        => $data['instansi'],
            'user_id'         => Auth::id(),
        ]);

        return redirect()->route('admin.dashboard')
                         ->with('success', 'Kode assessment berhasil dibuat');
    }

 

    public function show($assessment_id)
    {
        // only admin
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }
    
        // eager-load every DF‐relation, every Score‐relation, every RelativeImportance‐relation
        $assessment = Assessment::with([
            'df1','df2','df3','df4','df5',
            'df6','df7','df8','df9','df10',
            'df1Scores','df2Scores','df3Scores','df4Scores','df5Scores',
            'df6Scores','df7Scores','df8Scores','df9Scores','df10Scores',
            'df1RelativeImportances','df2RelativeImportances','df3RelativeImportances',
            'df4RelativeImportances','df5RelativeImportances','df6RelativeImportances',
            'df7RelativeImportances','df8RelativeImportances','df9RelativeImportances',
            'df10RelativeImportances',
        ])->findOrFail($assessment_id);
    
        return view('admin.assessments.show', compact('assessment'));
    }
    
}

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
            'df1' => function($query) { $query->latest(); },
            'df2' => function($query) { $query->latest(); },
            'df3' => function($query) { $query->latest(); },
            'df4' => function($query) { $query->latest(); },
            'df5' => function($query) { $query->latest(); },
            'df6' => function($query) { $query->latest(); },
            'df7' => function($query) { $query->latest(); },
            'df8' => function($query) { $query->latest(); },
            'df9' => function($query) { $query->latest(); },
            'df10' => function($query) { $query->latest(); },
            'df1Scores' => function($query) { $query->latest(); },
            'df2Scores' => function($query) { $query->latest(); },
            'df3Scores' => function($query) { $query->latest(); },
            'df4Scores' => function($query) { $query->latest(); },
            'df5Scores' => function($query) { $query->latest(); },
            'df6Scores' => function($query) { $query->latest(); },
            'df7Scores' => function($query) { $query->latest(); },
            'df8Scores' => function($query) { $query->latest(); },
            'df9Scores' => function($query) { $query->latest(); },
            'df10Scores' => function($query) { $query->latest(); },
            'df1RelativeImportances' => function($query) { $query->latest(); },
            'df2RelativeImportances' => function($query) { $query->latest(); },
            'df3RelativeImportances' => function($query) { $query->latest(); },
            'df4RelativeImportances' => function($query) { $query->latest(); },
            'df5RelativeImportances' => function($query) { $query->latest(); },
            'df6RelativeImportances' => function($query) { $query->latest(); },
            'df7RelativeImportances' => function($query) { $query->latest(); },
            'df8RelativeImportances' => function($query) { $query->latest(); },
            'df9RelativeImportances' => function($query) { $query->latest(); },
            'df10RelativeImportances' => function($query) { $query->latest(); },
        ])
        ->findOrFail($assessment_id);
    
        return view('admin.assessments.show', compact('assessment'));
    }

    public function filter(Request $request)
    {
        // Pastikan hanya admin yang bisa akses
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $query = Assessment::query();

        // Filter berdasarkan instansi
        if ($request->has('instansi') && !empty($request->instansi)) {
            $query->where('instansi', 'like', '%' . $request->instansi . '%');
        }

        // Filter berdasarkan kode assessment
        if ($request->has('kode_assessment') && !empty($request->kode_assessment)) {
            $query->where('kode_assessment', 'like', '%' . $request->kode_assessment . '%');
        }

        // Filter berdasarkan user_id (jika masih diperlukan)
        if ($request->has('user_id') && !empty($request->user_id)) {
            $query->where('user_id', $request->user_id);
        }

        // Ambil data dengan urutan terbaru
        $assessments = $query->orderBy('created_at', 'desc')->get();

        return view('admin.assessments.index', compact('assessments'));
    }
    
}

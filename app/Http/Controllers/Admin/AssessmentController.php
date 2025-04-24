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

    /**
     * (Opsional) Hapus sebuah kode assessment
     */
    public function destroy($assessment_id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        Assessment::findOrFail($assessment_id)->delete();
        return redirect()->route('admin.dashboard')
                         ->with('success', 'Kode assessment dihapus');
    }
}

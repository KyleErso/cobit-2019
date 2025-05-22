<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Assessment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class AssessmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan Admin Dashboard + Filter
     * – Daftar semua kode assessment (bisa difilter lewat query string)
     * – Form untuk membuat kode baru (instansi + kode)
     */
    public function index(Request $request)
    {
        // Pastikan hanya admin yang bisa akses
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        // Bangun query dasar
        $query = Assessment::query();

        // Filter exact by ID
        if ($request->filled('id')) {
            $query->where('assessment_id', $request->id);
        }

        // Filter partial by kode_assessment
        if ($request->filled('kode_assessment')) {
            $query->where('kode_assessment', 'like', '%'.$request->kode_assessment.'%');
        }

        // Filter partial by instansi
        if ($request->filled('instansi')) {
            $query->where('instansi', 'like', '%'.$request->instansi.'%');
        }

        // Ambil dan urutkan
        $assessments = $query->orderBy('created_at', 'desc')->get();

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

        return redirect()
            ->route('admin.assessments.index')
            ->with('success', 'Kode assessment berhasil dibuat');
    }


    /**
     * Tampilkan daftar pending requests (status = 'pending') dari JSON
     */
    public function pendingRequests()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $path = 'requests.json';
        $all = Storage::exists($path)
             ? json_decode(Storage::get($path), true)
             : [];

        $pending = array_filter($all, fn($r) => ($r['status'] ?? '') === 'pending');
        // preserve index
        $requests = [];
        foreach ($pending as $idx => $entry) {
            $requests[$idx] = $entry;
        }

        return view('admin.assessments.requests', compact('requests'));
    }

    /**
     * Approve request ke-{idx} dalam JSON
     */
    public function approveRequest($idx)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $path = 'requests.json';
        if (! Storage::exists($path)) {
            return back()->with('error','File request tidak ditemukan.');
        }

        $all = json_decode(Storage::get($path), true);

        if (! array_key_exists($idx, $all)) {
            return back()->with('error','Request tidak ditemukan.');
        }

        $all[$idx]['status'] = 'approved';
        $all[$idx]['approved_at'] = now()->toDateTimeString();

        Storage::put($path, json_encode($all, JSON_PRETTY_PRINT));

        return back()->with('success','Request berhasil di-approve.');
    }


    /**
     * Tampilkan detail satu assessment beserta relasinya
     */
    public function show($assessment_id)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        try {
            // Eager load semua relasi df/score/relativeImportance terbaru
            $relations = [];
            for ($i = 1; $i <= 10; $i++) {
                $relations[] = "df{$i}";
                $relations[] = "df{$i}Scores";
                $relations[] = "df{$i}RelativeImportances";
            }

            $assessment = Assessment::with(array_combine(
                $relations,
                array_fill(0, count($relations), function ($q) {
                    $q->latest();
                })
            ))->findOrFail($assessment_id);

            $users = User::pluck('name', 'id')->toArray();
            return view('admin.assessments.show', compact('assessment', 'users'));
        } catch (ModelNotFoundException $e) {
            return redirect()
                ->route('admin.assessments.index')
                ->with('error', 'Assessment dengan ID tersebut tidak ditemukan.');
        }
    }
}

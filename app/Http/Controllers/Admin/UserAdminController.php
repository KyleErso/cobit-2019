<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Assessment;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class UserAdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Tampilkan daftar user untuk admin
     */
    public function index(Request $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $activatedUsers = User::where('isActivated', true)->get();
        $deactivatedUsers = User::where('isActivated', false)->get();

        return view('admin.users.users', compact('activatedUsers', 'deactivatedUsers'));
    }


    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email', 'role', 'jabatan', 'organisasi'));

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function deactivate(User $user)
    {
        $user->isActivated = false;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dinonaktifkan.');
    }

    public function activate(User $user)
    {
        $user->isActivated = true;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diaktifkan kembali.');
    }
}
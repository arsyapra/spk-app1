<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kriteria;
use App\Models\Sub_kriteria;
use Illuminate\Support\Facades\Hash;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::where('role', 'siswa');

        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nisn', 'like', '%' . $request->search . '%')
                  ->orWhere('name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%');
            });
        }

        $siswa = $query->orderBy('id', 'desc')->paginate(5);
        return view('siswa.index', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('siswa.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nisn'     => 'required|string|unique:users,nisn',
            'name'     => 'required|string|max:50',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'nisn'     => $request->nisn,
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => 'siswa',
        ]);

        return redirect()->route('siswa.index')
                         ->with('success', 'Data siswa berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $siswa = User::where('role', 'siswa')->findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nisn'     => 'required|string|unique:users,nisn,' . $id,
            'name'     => 'required|string|max:50',
            'email'    => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $siswa = User::where('role', 'siswa')->findOrFail($id);

        $data = [
            'nisn'  => $request->nisn,
            'name'  => $request->name,
            'email' => $request->email,
        ];
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $siswa->update($data);

        return redirect()->route('siswa.index')
                         ->with('success', 'Data siswa berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $siswa = User::where('role', 'siswa')->findOrFail($id);
        $siswa->delete();

        return redirect()->route('siswa.index')
                         ->with('success', 'Data siswa berhasil dihapus.');
    }

    /**
     * Tampilkan daftar kriteria (read-only).
     */
    public function lihatKriteria()
    {
        $kriteria = Kriteria::all();
        return view('siswa.kriteria', compact('kriteria'));
    }

    /**
     * Tampilkan daftar sub-kriteria (read-only).
     */
    public function lihatSubkriteria()
    {
        $subkriteria = Sub_kriteria::with('kriteria')->get();
        return view('siswa.subkriteria', compact('subkriteria'));
    }
}

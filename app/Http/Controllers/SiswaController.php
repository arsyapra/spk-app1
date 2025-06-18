<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Siswa;
use App\Models\Kriteria;
use App\Models\Alternatif;
use App\Models\Sub_kriteria;
use App\Models\Nilai_akhir;

use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query= Siswa::query();

        if ($request->filled('search')) {
            $query->where('nama_siswa', 'like' , '%' . $request->search . '%')->orWhere('nilai_akademik', 'like' , '%' . $request->search . '%');
        }

        $siswa = $query->orderBy('id','desc')->paginate(5);
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
            'nama_siswa' => 'required|max:6',
            'minat' => 'required',
        ]);
        DB::table('siswas')->insert([
            'nama_siswa'=>$request->nama_siswa,
            'minat'=>$request->minat,

        ]);
        
     return redirect()->route('siswa.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $request->validate([
    'nama_siswa'  => 'required|max:20',
    'minat'  => 'required',
    ]);

    $siswa = Siswa::findOrFail($id);
    $siswa->update([
    'nama_siswa'  => $request->nama_siswa,
    'minat'  => $request->minat,

    ]);

    return redirect()->route('siswa.index')->with('success', 'Data berhasil diperbarui.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            {
    $siswa = Siswa::findOrFail($id);
    $siswa->delete();

    return redirect()->route('siswa.index')->with('success', 'Data berhasil dihapus.');
    }
    }

        // Optional: Anda bisa kirim data ringkasan ke tampilan


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

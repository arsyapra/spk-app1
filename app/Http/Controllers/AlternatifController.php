<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AlternatifController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query= Alternatif::query();

        if ($request->filled('search')) {
            $query->where('kode_alternatif', 'like' , '%' . $request->search . '%')->orWhere('nama_alternatif', 'like' , '%' . $request->search . '%');
        }

        $alternatif = $query->orderBy('id','desc')->paginate(5);
        return view('alternatif.index', compact('alternatif'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('alternatif.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'kode_alternatif'  => 'required|max:6|unique:alternatifs,kode_alternatif',
            'nama_alternatif' => 'required',
            'kelompok_minat' => 'required',
        ]);
        DB::table('alternatifs')->insert([
            'kode_alternatif'=>$request->kode_alternatif,
            'nama_alternatif'=>$request->nama_alternatif,
            'kelompok_minat'=>$request->kelompok_minat,

        ]);
        
     return redirect()->route('alternatif.index');
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
        $alternatif = Alternatif::findOrFail($id);
        return view('alternatif.edit', compact('alternatif'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
    $request->validate([
    'kode_alternatif'  => 'required|max:6|unique:alternatifs,kode_alternatif',
    'nama_alternatif'  => 'required|max:45',
    'kelompok_minat'  => 'required',
    ]);

    $alternatif = Alternatif::findOrFail($id);
    $alternatif->update([
    'kode_alternatif'  => $request->kode_alternatif,
    'nama_alternatif'  => $request->nama_alternatif,
    'kelompok_minat'  => $request->kelompok_minat,

    ]);

    return redirect()->route('alternatif.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $alternatif = Alternatif::findOrFail($id);
    $alternatif->delete();

    return redirect()->route('alternatif.index')->with('success', 'Data berhasil dihapus.');
    }
}

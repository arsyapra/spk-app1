<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KriteriaController extends Controller
{
    public function index(Request $request) {
        // $kriteria = Kriteria::paginate(5);
        // return view('kriteria.index',compact('kriteria'));
         $query = Kriteria::query();

    if ($request->filled('search')) {
        $query->where('nama_kriteria', 'like', '%' . $request->search . '%')
              ->orWhere('jenis_kriteria', 'like', '%' . $request->search . '%');
    }

    $kriteria = $query->paginate(5)->withQueryString(); // withQueryString biar keyword tetap saat pagination

    return view('kriteria.index', compact('kriteria'));
        
        
    }
    public function create() {
        return view('kriteria.tambah');
        
    }
    public function store(Request $request)
    {
        $request->validate([
    'kode_kriteria'  => 'required|max:6|unique:kriterias,kode_kriteria',
    'nama_kriteria'  => 'required|max:45',
    'bobot_kriteria' => 'required|numeric',
    'jenis_kriteria' => 'required'
], [
    'nama_kriteria.required' => 'Nama wajib diisi',
    'nama_kriteria.max'      => 'Kode harus berjumlah 6 karakter',
]);
      DB::table('kriterias')->insert([
    'kode_kriteria'  => $request->kode_kriteria,
    'nama_kriteria'  => $request->nama_kriteria,
    'bobot_kriteria' => $request->bobot_kriteria,
    'jenis_kriteria' => $request->jenis_kriteria,
]);

     return redirect()->route('kriteria.index');
    }
    public function edit($id)
{
    $kriteria = Kriteria::findOrFail($id);
    return view('kriteria.edit', compact('kriteria'));
}

public function update(Request $request, $id)
{
    $request->validate([
    'kode_kriteria'  => 'required|max:6|unique:kriterias,kode_kriteria',
    'nama_kriteria'  => 'required|max:45',
    'bobot_kriteria' => 'required|numeric',
    'jenis_kriteria' => 'required'
    ]);

    $kriteria = Kriteria::findOrFail($id);
    $kriteria->update([
    'kode_kriteria'  => $request->kode_kriteria,
    'nama_kriteria'  => $request->nama_kriteria,
    'bobot_kriteria' => $request->bobot_kriteria,
    'jenis_kriteria' => $request->jenis_kriteria,
    ]);

    return redirect()->route('kriteria.index')->with('success', 'Data berhasil diperbarui.');
}
public function destroy($id)
{
    $kriteria = Kriteria::findOrFail($id);
    $kriteria->delete();

    return redirect()->route('kriteria.index')->with('success', 'Data berhasil dihapus.');
}

}

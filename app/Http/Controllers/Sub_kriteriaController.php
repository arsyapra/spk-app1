<?php

namespace App\Http\Controllers;
use App\Models\Sub_kriteria;
use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Sub_kriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
          $query = Sub_kriteria::with('kriteria');

    if ($request->has('search') && $request->search != '') {
        $query->where('nama_sub_kriteria', 'like', '%' . $request->search . '%');
    }

    // Ambil data paginated untuk pagination links
    $paginated = $query->orderBy('kriteria_id')->paginate(10)->withQueryString();

    // Ambil semua data lalu dikelompokkan
    $all = $query->get()->groupBy(function ($item) {
        return $item->kriteria->nama_kriteria;
    });

    return view('sub_kriteria.index', [
        'grouped_sub_kriteria' => $all,
        'paginated_sub_kriteria' => $paginated,
    ]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kriteria = Kriteria::all();
        return view('sub_kriteria.tambah', compact('kriteria'));
    }

    
   public function store(Request $request)
{
    $request->validate([
        'kriteria_id' => 'required',
        'kode_sub_kriteria' => 'required|max:6|unique:sub_kriterias,kode_sub_kriteria',
        'nama_sub_kriteria' => 'required',
        'bobot_sub_kriteria' => 'required|numeric'
    ]);

    DB::table('sub_kriterias')->insert([
        'kriteria_id' => $request->kriteria_id,
        'kode_sub_kriteria' => $request->kode_sub_kriteria,
        'nama_sub_kriteria' => $request->nama_sub_kriteria,
        'bobot_sub_kriteria' => $request->bobot_sub_kriteria
    ]);

    return redirect()->route('sub_kriteria.index')->with('success', 'Sub kriteria berhasil disimpan.');
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sub_kriteria $sub_kriteria)
    {
        $kriteria = Kriteria::all();
        return view('sub_kriteria.edit', [
            'sub_kriteria' => $sub_kriteria,
            'kriteria' => $kriteria,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sub_kriteria $sub_kriteria)
    {
        $request->validate([
            'kode_sub_kriteria' => 'required|unique:sub_kriterias,kode_sub_kriteria',
            'kriteria_id' => 'required|exists:kriterias,id',
            'nama_sub_kriteria' => 'required',
            'bobot_sub_kriteria' => 'required|numeric',
        ]);

        $sub_kriteria->update($request->all());
        return redirect()->route('sub_kriteria.index')->with('success', 'Sub kriteria berhasil diupdate.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sub_kriteria $sub_kriteria)
    {
        $sub_kriteria->delete();
        return redirect()->route('sub_kriteria.index')->with('success', 'Sub kriteria berhasil dihapus.');
    }
}

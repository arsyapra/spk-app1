@extends('layout.layout')
@section('title', 'penilaian')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y" style="margin-left:10px;">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables </span>Penilaian</h4>
        <a href="{{ route('penilaian.tambah') }}" class="btn btn-sm btn-primary mb-3">Tambah Data Penilaian</a>
        <a href="{{ route('utility.hasil') }}" class="btn btn-sm btn-danger mb-3">Hitung Utilty</a>
        <a href="{{ route('nilaiakhir.hasil') }}" class="btn btn-dark btn-sm mb-3">Hitung Nilai Akhir</a>
        <a href="{{ route('penilaian.export') }}" class="btn btn-success btn-sm mb-3">Export Excel</a>


     
        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
    <thead>
        <tr>
            <th>Alternatif</th>
            @foreach ($kriteria as $k)
                <th>{{ $k->nama_kriteria }}</th>
            @endforeach
            <th>Actions</th>
        </tr>
    </thead>
                       <tbody>
        @foreach ($alternatif as $alt)
            <tr>
                <td>{{ $alt->nama_alternatif }}</td>
                @foreach ($kriteria as $k)
                @php
                    $nilai = $alt->penilaian->where('kriteria_id', $k->id)->first();
                @endphp

                <td>
                    {{ optional($nilai?->sub_kriteria)->nama_sub_kriteria ?? '-' }}
                </td>
              @endforeach
            <td>
                <a href="{{ route('penilaian.edit', $alt->id) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('penilaian.destroy', $alt->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus penilaian ini?')">Hapus</button>
                </form>
            </td>
            </tr>
        @endforeach
    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

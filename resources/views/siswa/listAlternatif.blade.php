@extends('layout.layout')
@section('title', 'Perangkingan Jurusan')

@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y" style="margin-left:10px;">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4><span class="text-muted">Tables /</span> Perangkingan Jurusan</h4>
    </div>

    {{-- Search Form --}}
    <form action="{{ route('siswas.listAlternatif') }}" method="GET" class="mb-4">
      <div class="input-group">
        <input type="text" name="search" value="{{ $keyword ?? '' }}"
               class="form-control" placeholder="Cari jurusan...">
        <button class="btn btn-primary" type="submit">Cari</button>
        <a href="{{ route('siswas.listAlternatif') }}" class="btn btn-outline-secondary">Reset</a>
      </div>
    </form>

    {{-- Tabel Perangkingan --}}
    <div class="card">
      <div class="table-responsive text-nowrap">
        <table class="table table-striped mb-0">
          <thead class="table-light">
            <tr><th>NO</th><th>Alternatif</th><th>Nilai Akhir</th></tr>
          </thead>
          <tbody>
            @forelse($nilaiAkhirAlternatif as $idx => $item)
            <tr>
              <td>{{ $idx+1 }}</td>
              <td>{{ $item->alternatif->nama_alternatif }}</td>
              <td>{{ $item->nilai_akhir }}</td>
            </tr>
            @empty
            <tr><td colspan="3" class="text-center">Alternatif tidak ditemukan.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
@endsection

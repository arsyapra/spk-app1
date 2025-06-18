@extends('layout.layout')
@section('title', 'Kriteria & Subkriteria')

@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y" style="margin-left:10px;">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-3">
      <h4><span class="text-muted">Tables /</span> Kriteria & Subkriteria</h4>
    </div>

    {{-- Search Form --}}
    <form action="{{ route('siswas.showKriteria') }}" method="GET" class="mb-4">
      <div class="input-group">
        <input type="text" name="search" value="{{ $keyword ?? '' }}"
               class="form-control" placeholder="Cari kriteria atau subkriteria...">
        <button class="btn btn-primary" type="submit">Cari</button>
        <a href="{{ route('siswas.showKriteria') }}" class="btn btn-outline-secondary">Reset</a>
      </div>
    </form>

    {{-- Loop Kriteria --}}
    @forelse($kriterias as $kriteria)
      <div class="card mb-4">
        <div class="card-header d-flex justify-content-between">
          <h5>{{ $kriteria->nama_kriteria }}</h5>
          <span class="badge bg-primary">Bobot: {{ $kriteria->bobot_kriteria }}</span>
        </div>
        <div class="table-responsive text-nowrap">
          <table class="table table-hover mb-0">
            <thead class="table-light">
              <tr><th class="text-center">Kode Sub</th><th>Nama Sub</th><th class="text-center">Bobot Sub</th></tr>
            </thead>
            <tbody>
              @foreach($kriteria->sub_kriteria as $sub)
              <tr>
                <td class="text-center">{{ $sub->kode_sub_kriteria }}</td>
                <td>{{ $sub->nama_sub_kriteria }}</td>
                <td class="text-center">{{ $sub->bobot_sub_kriteria }}</td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    @empty
      <div class="alert alert-info">Kriteria tidak ditemukan.</div>
    @endforelse

  </div>
</div>
@endsection

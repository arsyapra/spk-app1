@extends('layout.layout')
@section('title','Edit Alternatif')
@section('content')
<div class="container-fluid px-4">
           <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Edit </span> Penilaian</h4>
            <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                {{-- Form Edit --}}
            </div>
            <div class="card-body">
                <h5 class="fw py-1 mb-1">Edit Penilaian {{ $alternatif->nama_alternatif }}</h5>

    <form action="{{ route('penilaian.update', $alternatif->id) }}" method="POST">
        @csrf
        @method('PUT')

        @foreach ($kriteria as $k)
            <div class="mb-3">
                <label class="form-label">{{ $k->nama_kriteria }}</label>
                <select name="penilaian[{{ $k->id }}]" class="form-control">
                    @foreach ($k->sub_kriteria as $sub)
                        <option value="{{ $sub->id }}"
                            {{ (isset($penilaian[$k->id]) && $penilaian[$k->id]->sub_kriteria_id == $sub->id) ? 'selected' : '' }}>
                            {{ $sub->nama_sub_kriteria }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('penilaian.index') }}" class="btn btn-secondary">Batal</a>
    </form>
            </div>
            </div>
                       @endsection

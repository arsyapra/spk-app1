@extends('layout.layout')
@section('title','Tambah SubKriteria')
@section('content')
<div class="container-fluid px-4">
           <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah Data  </span> SubKriteria</h4>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Form Tambah Data Sub Kriteria
            </div>
            <div class="card-body">
  <form action="{{ route('sub_kriteria.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label for="kode_sub_kriteria">Kode Sub Kriteria</label>
        <input type="text" class="form-control @error('kode_sub_kriteria') is-invalid @enderror" id="kode_sub_kriteria" name="kode_sub_kriteria" value="{{ old('kode_sub_kriteria') }}">
        @error('kode_sub_kriteria')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="kriteria_id">Kriteria</label>
        <select name="kriteria_id" class="form-control" required>
            <option value="">-- Pilih Kriteria --</option>
            @foreach ($kriteria as $k)
                <option value="{{ $k->id }}">{{ $k->nama_kriteria }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="nama_sub_kriteria">Nama Sub Kriteria</label>
        <input type="text" class="form-control @error('nama_sub_kriteria') is-invalid @enderror" id="nama_sub_kriteria" name="nama_sub_kriteria" value="{{ old('nama_sub_kriteria') }}">
        @error('nama_sub_kriteria')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="form-group">
        <label for="bobot_sub_kriteria">Bobot Sub Kriteria</label>
        <input type="text" class="form-control @error('bobot_sub_kriteria') is-invalid @enderror" id="bobot_sub_kriteria" name="bobot_sub_kriteria" value="{{ old('bobot_sub_kriteria') }}">
        @error('bobot_sub_kriteria')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary mt-4">Submit</button>
        <a href="{{ route('sub_kriteria.index') }}" class="btn mt-4 btn-dark">Kembali</a>
</form>

            </div>
        </div>
    </div>
                @endsection
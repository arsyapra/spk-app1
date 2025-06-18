@extends('layout.layout')
@section('title','Edit Kriteria')
@section('content')
<div class="container-fluid px-4">
           <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah Data  </span>Kriteria</h4>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Form Edit Data
            </div>
            <div class="card-body">
  <form action="{{ route('kriteria.update', $kriteria->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                     <div class="form-group">
                        <label for="nama">Kode Kriteria</label>
                        <input type="text" class="form-control @error('kode_kriteria') is-invalid @enderror" id="kode_kriteria" name="kode_kriteria" value="{{ old('kode_kriteria',$kriteria->kode_kriteria) }}">
                        @error('kode_kriteria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Kriteria</label>
                        <input type="text" class="form-control @error('nama_kriteria') is-invalid @enderror" id="nama_kriteria" name="nama_kriteria" value="{{ old('nama_kriteria',$kriteria->nama_kriteria) }}">
                        @error('nama_kriteria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="jenis">Bobot Kriteria</label>
                        <input type="text" class="form-control @error('bobot_kriteria') is-invalid @enderror" id="bobot_kriteria" name="bobot_kriteria" value="{{ old('bobot_kriteria',$kriteria->bobot_kriteria) }}">
                        @error('bobot_kriteria')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                            <div class="mb-3">
                        <label for="jenis_kriteria">Jenis Kriteria</label>
                 
                 <select id="defaultSelect" name="jenis_kriteria" class="form-select">
    <option value="">Pilih Jenis Kriteria</option>
    <option value="Benefit" {{ old('jenis_kriteria', $kriteria->jenis_kriteria) == 'Benefit' ? 'selected' : '' }}>Benefit</option>
    <option value="Cost" {{ old('jenis_kriteria', $kriteria->jenis_kriteria) == 'Cost' ? 'selected' : '' }}>Cost</option>
    </select>


                      </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        <a href="{{ route('kriteria.index') }}" class="btn mt-4 btn-dark">Kembali</a>
                </form>
            </div>
        </div>
    </div>
                @endsection
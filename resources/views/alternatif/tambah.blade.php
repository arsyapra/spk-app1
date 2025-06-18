@extends('layout.layout')
@section('title','Tambah Alternatif')
@section('content')
<div class="container-fluid px-4">
           <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah Data  </span>Alternatif</h4>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Form Tambah Data
            </div>
            <div class="card-body">
  <form action="{{ route('alternatif.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                     <div class="form-group">
                        <label for="nama">Kode Alternatif</label>
                        <input type="text" class="form-control @error('kode_alternatif') is-invalid @enderror" id="kode_alternatif" name="kode_alternatif" value="{{ old('kode_alternatif') }}">
                        @error('kode_alternatif')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Nama Alternatif</label>
                        <input type="text" class="form-control @error('nama_alternatif') is-invalid @enderror" id="nama_alternatif" name="nama_alternatif" value="{{ old('nama_alternatif') }}">
                        @error('nama_alternatif')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                        <div class="form-group">
                        <label for="nama">Kelompok Minat</label>
                        <input type="text" class="form-control @error('kelompok_minat') is-invalid @enderror" id="kelompok_minat" name="kelompok_minat" value="{{ old('kelompok_minat') }}">
                        @error('kelompok_minat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>




                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        <a href="{{ route('alternatif.index') }}" class="btn mt-4 btn-dark">Kembali</a>
                </form>
            </div>
        </div>
    </div>
                @endsection
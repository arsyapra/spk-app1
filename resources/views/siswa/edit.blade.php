@extends('layout.layout')
@section('title','Edit Siswa')
@section('content')
<div class="container-fluid px-4">
           <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah Data  </span> Siswa</h4>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Form Edit Data Siswa
            </div>
            <div class="card-body">
  <form action="{{ route('siswa.update',$siswa->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
@method('PUT')

    <div class="form-group">
        <label for="nama_siswa">Nama Sub Kriteria</label>
        <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" value="{{ old('nama_siswa',$siswa->nama_siswa) }}">
        @error('nama_siswa')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

        <div class="form-group">
        <label for="minat">Minat</label>
        <input type="text" class="form-control @error('minat') is-invalid @enderror" id="minat" name="minat" value="{{ old('minat',$siswa->minat) }}">
        @error('minat')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary mt-4">Submit</button>
    <a href="{{ route('siswa.index') }}" class="btn mt-4 btn-dark">Kembali</a>
</form>


            </div>
        </div>
    </div>
                @endsection
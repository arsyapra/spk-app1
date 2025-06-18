@extends('layout.layout')
@section('title','Tambah siswa')
@section('content')
<div class="container-fluid px-4">
           <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah Data  </span>siswa</h4>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Form Tambah Data
            </div>
            <div class="card-body">
  <form action="{{ route('siswa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                     <div class="form-group">
                        <label for="nama">Nama Siswa</label>
                        <input type="text" class="form-control @error('nama_siswa') is-invalid @enderror" id="nama_siswa" name="nama_siswa" value="{{ old('nama_siswa') }}">
                        @error('nama_siswa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="nama">Minat</label>
                        <input type="text" class="form-control @error('minat') is-invalid @enderror" id="minat" name="minat" value="{{ old('minat') }}">
                        @error('minat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        <a href="{{ route('siswa.index') }}" class="btn mt-4 btn-dark">Kembali</a>
                </form>
            </div>
        </div>
    </div>
                @endsection
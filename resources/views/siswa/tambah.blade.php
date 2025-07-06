@extends('layout.layout')
@section('title','Tambah Siswa')
@section('content')
<div class="container-fluid px-4">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Tambah Data </span>Siswa
        </h4>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Form Tambah Data
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.store') }}" method="POST">
                    @csrf

                    <div class="form-group mb-3">
                        <label for="nisn">NISN</label>
                        <input
                            type="text"
                            class="form-control @error('nisn') is-invalid @enderror"
                            id="nisn"
                            name="nisn"
                            value="{{ old('nisn') }}"
                        >
                        @error('nisn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="name">Nama</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name') }}"
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input
                            type="password"
                            class="form-control @error('password') is-invalid @enderror"
                            id="password"
                            name="password"
                        >
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group mb-4">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password_confirmation"
                            name="password_confirmation"
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a href="{{ route('siswa.index') }}" class="btn btn-dark ms-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layout.layout')
@section('title','Edit Siswa')
@section('content')
<div class="container-fluid px-4">
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">
            <span class="text-muted fw-light">Edit Data </span>Siswa
        </h4>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Form Edit Data Siswa
            </div>
            <div class="card-body">
                <form action="{{ route('siswa.update', $siswa->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- NISN --}}
                    <div class="form-group mb-3">
                        <label for="nisn">NISN</label>
                        <input
                            type="text"
                            class="form-control @error('nisn') is-invalid @enderror"
                            id="nisn"
                            name="nisn"
                            value="{{ old('nisn', $siswa->nisn) }}"
                        >
                        @error('nisn')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nama --}}
                    <div class="form-group mb-3">
                        <label for="name">Nama</label>
                        <input
                            type="text"
                            class="form-control @error('name') is-invalid @enderror"
                            id="name"
                            name="name"
                            value="{{ old('name', $siswa->name) }}"
                        >
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group mb-3">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email', $siswa->email) }}"
                        >
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password (opsional) --}}
                    <div class="form-group mb-3">
                        <label for="password">Password <small class="text-muted">(kosongkan jika tidak diubah)</small></label>
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

                    {{-- Konfirmasi Password --}}
                    <div class="form-group mb-4">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input
                            type="password"
                            class="form-control"
                            id="password_confirmation"
                            name="password_confirmation"
                        >
                    </div>

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('siswa.index') }}" class="btn btn-dark ms-2">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layout.layout')
@section('title', 'Data siswa')
@section('content')

<div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y" style="margin-left:10px;">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables </span>siswa</h4>

        <a href="{{ route('siswa.tambah') }}" class="btn btn-sm btn-primary mb-3">Tambah Data</a>

        <form action="{{ route('siswa.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari siswa..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
                <a href="{{ route('siswa.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Siswa</th>
                            <th>Kelompok minat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($siswa as $sw)
                            <tr>
                                <td>{{ $sw->nama_siswa }}</td>
                                <td>{{ $sw->minat }}</td>
                                <td>
                                        <a href="{{ route('siswa.edit', $sw->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('siswa.destroy', $sw->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Hapus data ini?')" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">Tidak ada data Siswa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $siswa->links() }}
        </div>
    </div>
</div>

@endsection

@extends('layout.layout')
@section('title', 'Data Alternatif')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y" style="margin-left:10px;">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables </span>Alternatif</h4>

        <a href="{{ route('alternatif.tambah') }}" class="btn btn-sm btn-primary mb-3">Tambah Data</a>

        <form action="{{ route('alternatif.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Cari alternatif..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
                <a href="{{ route('alternatif.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <div class="card">
            <div class="table-responsive text-nowrap">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Kode Alternatif</th>
                            <th>Nama Alternatif</th>
                            <th>Kelompok minat</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($alternatif as $alt)
                            <tr>
                                <td>{{ $alt->kode_alternatif }}</td>
                                <td>{{ $alt->nama_alternatif }}</td>
                                <td>{{ $alt->kelompok_minat }}</td>
                                <td>
                                        <a href="{{ route('alternatif.edit', $alt->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('alternatif.destroy', $alt->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Hapus data ini?')" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="text-center">Tidak ada data alternatif.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-3">
            {{ $alternatif->links() }}
        </div>
    </div>
</div>

@endsection

@extends('layout.layout')
@section('title','Subkriteria')
@section('content')

<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y" style="margin-left:10px;">

        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables </span>Sub Kriteria</h4>

        <a href="{{ route('sub_kriteria.tambah') }}" class="btn btn-sm btn-primary mb-3">Tambah Data</a>

        <!-- Form Search -->
        <form action="{{ route('sub_kriteria.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <span class="input-group-text">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" name="search" class="form-control" placeholder="Cari sub kriteria..." value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Cari</button>
                <a href="{{ route('sub_kriteria.index') }}" class="btn btn-secondary">Reset</a>
            </div>
        </form>

        <!-- Looping Per Kriteria -->
        @forelse ($grouped_sub_kriteria as $kriteria => $items)
            <div class="card mb-4">
                <h5 class="card-header">{{ $kriteria }}</h5>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Kode Sub</th>
                                <th>Nama Sub</th>
                                <th>Bobot</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $sub)
                                <tr>
                                    <td>{{ $sub->kode_sub_kriteria }}</td>
                                    <td>{{ $sub->nama_sub_kriteria }}</td>
                                    <td>{{ $sub->bobot_sub_kriteria }}</td>
                                    <td>
                                        <a href="{{ route('sub_kriteria.edit', $sub->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('sub_kriteria.destroy', $sub->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Hapus data ini?')" class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">Tidak ada sub kriteria.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        @empty
            <div class="alert alert-warning">Tidak ada data kriteria atau sub kriteria ditemukan.</div>
        @endforelse

        <!-- Pagination -->
        <div class="mt-4">
            {{ $paginated_sub_kriteria->links() }}
        </div>

    </div>
</div>

@endsection

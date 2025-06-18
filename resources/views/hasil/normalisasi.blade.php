@extends('layout.layout')
@section('title','Normalisasi Bobot')
@section('content')

<div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y" style="margin-left:10px;">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Hasil </span>Normalisasi Bobot</h4>
                 <a href="{{ route('kriteria.index') }}" class="btn mb-3  btn-primary">Kembali</a>
        <div class="card">
            <h5 class="card-header">Tabel Normalisasi</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nama Kriteria</th>
                            <th>Bobot</th>
                            <th>Bobot Ternormalisasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($kriteria_normalisasi as $item)
                            <tr>
                           <td>{{ optional($item->kriteria)->nama_kriteria ?? 'N/A' }}</td>
<td>{{ optional($item->kriteria)->bobot_kriteria ?? 'N/A' }}</td>
                                <td>{{ number_format($item->normalisasi, 4) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

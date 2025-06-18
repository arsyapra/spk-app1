@extends('layout.layout')
@section('title', 'Nilai Utility')

@section('content')
<div class="content-wrapper">
    <div class="container-xxl flex-grow-1 container-p-y" style="margin-left:10px;">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Hasil </span>Utility</h4>
         <a href="{{ route('penilaian.index') }}" class="btn mb-3  btn-primary">Kembali</a>
        <div class="card">
            <h5 class="card-header">Tabel Utility</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <tr>
                        <th>Alternatif</th>
                        @foreach ($kriteria as $k)
                            <th>{{ $k->nama_kriteria }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alternatif as $alt)
                        <tr>
                            <td>{{ $alt->nama_alternatif }}</td>
                            @foreach ($kriteria as $k)
                                @php
                                    $utility = $alt->utilities->where('kriteria_id', $k->id)->first();
                                @endphp
                                <td>{{ $utility->nilai_utility ?? '-' }}</td>
                            @endforeach
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

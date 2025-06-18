@extends('layout.layout')
@section('title', 'Nilai Akhir')

@section('content')
<div class="content-wrapper">
      <div class="container-xxl flex-grow-1 container-p-y" style="margin-left:10px;">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Hasil </span>Nilai Akhir Jurusan</h4>
         <a href="{{ route('penilaian.index') }}" class="btn mb-3  btn-primary">Kembali</a>

        <div class="card">
            <h5 class="card-header">Tabel Nilai Akhir</h5>
            <div class="table-responsive text-nowrap">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Alternatif</th>
                            <th>Nilai Akhir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($hasil_akhir as $index => $d)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $d->alternatif }}</td>
                                <td>{{ $d->nilai_akhir }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@extends('layout.layout')
@section('title', 'Rekomendasi Jurusan')
@section('content')
<div class="container-fluid px-4">
    <h4 class="fw-bold py-3 mb-2">Rekomendasi Jurusan untuk {{ $siswa->nama_siswa }}</h4>
            <a href="{{ route('siswas.exportPdf', $siswa->id) }}"
            class="btn btn-sm btn-danger">
            Cetak PDF
        </a>
    <div class="card mb-4 mt-2">
        <div class="card-body">
            <table class="table">
                <thead>
                    <tr>
                        <th>Ranking</th>
                        <th>Jurusan</th>
                        <th>Skor SMART</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($hasil as $index => $jurusan)
                     @if($index < 4)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $jurusan['jurusan'] }}</td>
                            <td>{{ $jurusan['total'] }}</td>
                        </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            {{-- Jika ingin tampilkan detail utility per kriteria, uncomment di bawah --}}
            
            @foreach ($hasil as $index => $jurusan)
                <h5 class="mt-4">Detail {{ $jurusan['jurusan'] }} (Skor: {{ $jurusan['total'] }})</h5>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Kriteria</th>
                            <th>Nilai Siswa</th>
                            <th>Nilai Ideal</th>
                            <th>Selisih</th>
                            <th>Utility</th>
                            <th>Bobot</th>
                            <th>Skor</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jurusan['detail'] as $d)
                            <tr>
                                <td>{{ $d['kriteria'] }}</td>
                                <td>{{ $d['nilai_siswa'] }}</td>
                                <td>{{ $d['nilai_ideal'] }}</td>
                                <td>{{ $d['selisih'] }}</td>
                                <td>{{ $d['utility'] }}</td>
                                <td>{{ $d['bobot_normalisasi'] }}</td>
                                <td>{{ $d['skor'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endforeach
            
        </div>
    </div>
</div>
@endsection

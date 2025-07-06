@extends('layout.layout')
@section('title','Tables Data siswa')

@section('content')
<div class="content-wrapper">
  <div class="container-xxl flex-grow-1 container-p-y" style="margin-left:10px;">

    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Tables /</span> Data Siswa
    </h4>

    <div class="card">
      <div class="table-responsive text-nowrap">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Siswa</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody>
            @forelse($siswa as $i => $sw)
            <tr>
              <td>{{ $i + 1 }}</td>
              <td>{{ $sw->name }}</td>
              <td class="text-center">
                <a href="{{ route('siswas.lihatHasil', ['siswa_id' => $sw->id]) }}"
                   class="btn btn-sm btn-primary">
                  Hasil
                </a>
              </td>
            </tr>
            @empty
            <tr>
              <td colspan="3" class="text-center">
                Belum ada data siswa.
              </td>
            </tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>

  </div>
</div>
@endsection

@extends('layout.layout')
@section('title','Tambah Alternatif')
@section('content')
<div class="container-fluid px-4">
           <div class="container-xxl flex-grow-1 container-p-y">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tambah Data  </span>Penilaian</h4>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table me-1"></i>
                Form Tambah Data Penilaian
            </div>
            <div class="card-body">
            <form action="{{ route('penilaian.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                     <div class="form-group">
                         <label>Alternatif</label>
                            <select name="alternatif_id" class="form-control">
                                @foreach ($alternatif as $alt)
                                    <option value="{{ $alt->id }}">{{ $alt->nama_alternatif }}</option>
                                @endforeach
                            </select>
                    </div>
                    <div class="form-group">
                        @foreach ($kriteria as $k)
                        <label>{{ $k->nama_kriteria }}</label>
                        <select name="penilaian[{{ $k->id }}]" class="form-control">
                            @foreach ($k->sub_kriteria as $sub)
                                <option value="{{ $sub->id }}">{{ $sub->nama_sub_kriteria }}</option>
                            @endforeach
                        </select>
                    @endforeach
                    </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4">Submit</button>
                        <a href="{{ route('penilaian.index') }}" class="btn mt-4 btn-dark">Kembali</a>
                </form>
            </div>
        </div>
    </div>
                @endsection
@extends('layout.layout')
@section('title','Kriteria')
@section('content')

   <div class="content-wrapper">
            <!-- Content -->

<div class="container-xxl flex-grow-1 container-p-y" style="margin-left:10px;">
              <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Tables  </span>Kriteria</h4>

 <a href="{{ route('kriteria.tambah') }}" class="btn btn-sm btn-primary">Tambah Data</a>
 <a href="{{ route('normalisasi.hasil') }}" class="btn btn-sm btn-dark">Hitung normalisasi</a>
 <hr>
 <!-- search -->
 <form action="{{ route('kriteria.index') }}" method="GET" class="mb-3">
    <div class="input-group">
      <span class="input-group-text">
          <i class="bi bi-search"></i>
      </span>
        <input type="text" name="search" class="form-control" placeholder="Cari kriteria..." value="{{ request('search') }}">
    </div>
</form>


              <!-- Basic Bootstrap Table -->
              <div class="card">
                <h5 class="card-header">Data Kriteria</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    
                    <thead>
                      <tr>
                        <th>Kode Kriteria</th>
                        <th>Nama Kriteria</th>
                        <th>Bobot</th>
                        <th>Jenis Kriteria</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                        @foreach ($kriteria as $k)
                        
                      <tr>
                            {{-- <td>{{ $loop->iteration }}</td> --}}
                            <td>{{ $k->kode_kriteria}}</td>
                            <td>{{ $k->nama_kriteria}}</td>
                            <td>{{ $k->bobot_kriteria}}</td>
                            <td>{{ $k->jenis_kriteria }}</td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{ route('kriteria.edit', $k->id) }}"
                                ><i class="bx bx-edit-alt me-1"></i> Edit</a
                              >
                     <a href="#" class="dropdown-item"
   onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus data ini?')) document.getElementById('delete-kriteria-{{ $k->id }}').submit();">
   <i class="bx bx-trash me-1"></i> Delete
</a>

<form id="delete-kriteria-{{ $k->id }}" action="{{ route('kriteria.destroy', $k->id) }}" method="POST" style="display: none;">
    @csrf
    @method('DELETE')
</form>


                            </div>
                          </div>
                        </td>
                           @endforeach
                        
                      </tr>
                            </div>
                          </div>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                  <div class="mt-3">
    {{ $kriteria->links() }}
    </div>

                </div>
              </div>

@endsection
@extends('layout.layout')
@section('title','Dashboard')

@section('content')

<style>
    .dashboard-cards-scroll {
        display: flex;
        flex-wrap: nowrap;
        gap: 1.5rem;
        overflow-x: auto;
        padding-bottom: 0.5rem;
        margin-right: -1rem;
        margin-left: -1rem;
        scrollbar-width: thin;
        scrollbar-color: #aaa #eee;
    }
    .dashboard-cards-scroll .card {
        min-width: 210px;
        max-width: 260px;
        flex: 0 0 auto;
        border-radius: 1.2rem;
        transition: transform .23s, box-shadow .23s;
    }
    .dashboard-cards-scroll .card:hover {
        transform: translateY(-7px) scale(1.04);
        box-shadow: 0 8px 28px 0 rgba(0,0,0,0.13);
        z-index: 2;
    }
    @media (max-width: 768px) {
        .dashboard-cards-scroll {
            gap: 1rem;
            margin-right: -0.5rem;
            margin-left: -0.5rem;
        }
        .dashboard-cards-scroll .card { min-width: 165px; max-width: 220px; }
    }
</style>

<div class="container-xxl flex-grow-1 container-p-y" style="margin-left:18px;">

    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold py-2 mb-1"><span class="text-muted fw-light">Dashboard /</span> Ringkasan Data</h4>
        </div>
    </div>
    
    <div class="dashboard-cards-scroll px-2 mb-4">
        <!-- Kriteria -->
        <div class="card border-0 shadow"
            style="background: linear-gradient(135deg, #2563eb 0%, #60a5fa 100%); color: #fff;">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-sliders2" style="font-size:2.5rem"></i>
                </div>
                <h6 class="text-uppercase mb-1" style="letter-spacing:1px;opacity:0.86;">Kriteria</h6>
                <h2 class="fw-bold mb-0">{{ $jumlah_Kriteria }}</h2>
            </div>
        </div>
        <!-- Sub Kriteria -->
        <div class="card border-0 shadow"
            style="background: linear-gradient(135deg, #059669 0%, #34d399 100%); color: #fff;">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-list-check" style="font-size:2.5rem"></i>
                </div>
                <h6 class="text-uppercase mb-1" style="letter-spacing:1px;opacity:0.86;">Sub Kriteria</h6>
                <h2 class="fw-bold mb-0">{{ $jumlah_Sub_kriteria }}</h2>
            </div>
        </div>
        <!-- Alternatif -->
        <div class="card border-0 shadow"
            style="background: linear-gradient(135deg, #f59e42 0%, #fde68a 100%); color: #5b421a;">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-diagram-3" style="font-size:2.5rem"></i>
                </div>
                <h6 class="text-uppercase mb-1" style="letter-spacing:1px;opacity:0.86;">Alternatif</h6>
                <h2 class="fw-bold mb-0">{{ $jumlahAlternatif }}</h2>
            </div>
        </div>
        <!-- Siswa -->
        <div class="card border-0 shadow"
            style="background: linear-gradient(135deg, #ef4444 0%, #fca5a5 100%); color: #fff;">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-people-fill" style="font-size:2.5rem"></i>
                </div>
                <h6 class="text-uppercase mb-1" style="letter-spacing:1px;opacity:0.86;">Siswa</h6>
                <h2 class="fw-bold mb-0">{{ $jumlahSiswa }}</h2>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-12">
            <div class="card shadow border-0">
                <div class="card-header bg-white border-0">
                    <h6 class="mb-0 fw-bold">Grafik Ranking Nilai Akhir Jurusan</h6>
                </div>
                <div class="card-body">
                    <canvas id="rankingChart" height="90"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('rankingChart').getContext('2d');
        var rankingChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Nilai Akhir',
                    data: {!! json_encode($skors) !!},
                    backgroundColor: [
                        'rgba(37,99,235,0.8)','rgba(5,150,105,0.8)','rgba(233,196,106,0.8)','rgba(239,68,68,0.8)',
                        // Tambah warna jika label lebih banyak
                    ],
                    borderRadius: 8,
                    maxBarThickness: 45
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: { beginAtZero: true }
                }
            }
        });
    });
    </script>
@endsection

<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\AlternatifController;
use App\Http\Controllers\JurusanController;
use App\Models\Kriteria;
use App\Http\Controllers\KriteriaController;
use App\Http\Controllers\SMARTController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\PenilaianSiswaController;
use App\Http\Controllers\Sub_kriteriaController;
use App\Http\Controllers\Siswa1Controller;
use App\Models\NormalisasiBobot;
use App\Models\PenilaianSiswa;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth','siswa')->group(function(){
    Route::get('/siswas',[Siswa1Controller::class,'index'])->name('siswas.index');
    Route::get('/listAlternatif/siswas',[Siswa1Controller::class,'listAlternatif'])->name('siswas.listAlternatif');
    Route::get('/listKriteria/siswas',[Siswa1Controller::class,'showKriteria'])->name('siswas.showKriteria');
    Route::get('/listSiswa',[Siswa1Controller::class,'lihatSiswa'])->name('siswas.lihatSiswa');
    Route::get('/listHasil/{siswa_id}',[Siswa1Controller::class,'lihatHasil'])->name('siswas.lihatHasil');
    Route::get('/listHasil/{siswa_id}/hasil/pdf',[Siswa1Controller::class,'exportPdf'])->name('siswas.exportPdf');



});
Route::middleware('auth','admin')->group(function(){
Route::get('/admin',[AdminController::class,'index'])->name('admin.index');
//route kriteria
Route::get('/kriteria',[KriteriaController::class,'index'])->name('kriteria.index');
Route::get('/tambahkriteria',[KriteriaController::class,'create'])->name('kriteria.tambah');
Route::post('/tambahkriteria/store',[KriteriaController::class,'store'])->name('kriteria.store');
Route::get('/kriteria/{id}/edit', [KriteriaController::class, 'edit'])->name('kriteria.edit');
Route::put('/kriteria/{id}', [KriteriaController::class, 'update'])->name('kriteria.update');
Route::delete('/kriteria/{id}', [KriteriaController::class, 'destroy'])->name('kriteria.destroy');
//route subkriteria
Route::get('/sub_kriteria',[Sub_kriteriaController::class,'index'])->name('sub_kriteria.index');
Route::get('/tambah/sub_kriteria',[Sub_kriteriaController::class,'create'])->name('sub_kriteria.tambah');
Route::post('/tambah/sub_kriteria/store',[Sub_kriteriaController::class,'store'])->name('sub_kriteria.store');
Route::get('/sub_kriteria/{sub_kriteria}/edit', [Sub_kriteriaController::class, 'edit'])->name('sub_kriteria.edit');
Route::put('/sub_kriteria/{sub_kriteria}', [Sub_kriteriaController::class, 'update'])->name('sub_kriteria.update');
Route::delete('/sub_kriteria/{sub_kriteria}', [Sub_kriteriaController::class, 'destroy'])->name('sub_kriteria.destroy');
//route alternatif
Route::get('/alternatif',[AlternatifController::class,'index'])->name('alternatif.index');
Route::get('/tambah/alternatif',[AlternatifController::class,'create'])->name('alternatif.tambah');
Route::post('/tambah/alternatif/store',[AlternatifController::class,'store'])->name('alternatif.store');
Route::get('/alternatif/{id}/edit', [AlternatifController::class, 'edit'])->name('alternatif.edit');
Route::put('/alternatif/{id}', [AlternatifController::class, 'update'])->name('alternatif.update');
Route::delete('/alternatif/{id}', [AlternatifController::class, 'destroy'])->name('alternatif.destroy');

//route normalisasi 
Route::get('/normalisasi/hasil',[SMARTController::class,'NormalisasiBobot'])->name('normalisasi.hasil');

//route penilaian
Route::get('/penilaian',[PenilaianController::class,'index'])->name('penilaian.index');
Route::get('/tambah/penilaian',[PenilaianController::class,'create'])->name('penilaian.tambah');
Route::post('/tambah/penilaian/store',[PenilaianController::class,'store'])->name('penilaian.store');
Route::get('/penilaian/{alternatif}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');
Route::put('/penilaian/{alternatif}', [PenilaianController::class, 'update'])->name('penilaian.update');
Route::delete('/penilaian/{alternatif}', [PenilaianController::class, 'destroy'])->name('penilaian.destroy');
Route::get('/penilaian/export', [PenilaianController::class, 'export'])->name('penilaian.export');

//route utility
Route::get('/utility/hasil',[SMARTController::class,'hitungUtility'])->name('utility.hasil');

// route nilai akhir
Route::get('/nilaiakhir/hasil', [SMARTController::class, 'hitungNilaiAkhir'])->name('nilaiakhir.hasil');


//route alternatif
Route::get('/siswa',[SiswaController::class,'index'])->name('siswa.index');
Route::get('/tambah/siswa',[SiswaController::class,'create'])->name('siswa.tambah');
Route::post('/tambah/siswa/store',[SiswaController::class,'store'])->name('siswa.store');
Route::get('/siswa/{id}/edit', [SiswaController::class, 'edit'])->name('siswa.edit');
Route::put('/siswa/{id}', [SiswaController::class, 'update'])->name('siswa.update');
Route::delete('/siswa/{id}', [SiswaController::class, 'destroy'])->name('siswa.destroy');


//penilaian siswa
Route::get('/penilaiansiswa',[PenilaianSiswaController::class,'index'])->name('penilaiansiswa.index');
// Route::get('/tambah/penilaian',[PenilaianSiswa::class,'create'])->name('penilaian.tambah');
// Route::post('/tambah/penilaian/store',[PenilaianSiswa::class,'store'])->name('penilaian.store');
Route::get('/penilaiansiswa/{siswa}/edit', [PenilaianSiswaController::class, 'edit'])->name('penilaiansiswa.edit');
Route::put('/penilaiansiswa/{siswa}', [PenilaianSiswaController::class, 'update'])->name('penilaiansiswa.update');
Route::delete('/penilaiansiswa/{siswa}', [PenilaianSiswaController::class, 'destroy'])->name('penilaiansiswa.destroy');
// Route::get('/penilaian/export', [PenilaianSiswa::class, 'export'])->name('penilaian.export');

Route::get('/utility/{siswa_id}', [SMARTController::class, 'hitungNilaiUtility'])->name('hitung.utilty');
Route::get('/rekomendasi/{siswa_id}', [SMARTController::class, 'rekomendasiSMART'])->name('rekomendasi.jurusan');
Route::get('/listHasil/{siswa_id}/hasil/pdf',[Siswa1Controller::class,'exportPdf'])->name('siswas.exportPdf');


});
require __DIR__.'/auth.php';

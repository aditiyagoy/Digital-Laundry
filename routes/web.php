<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\TransaksiKaryawanController;
use App\Http\Controllers\TransaksiKontraktorController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('home');
// });
// Homepage
Route::get('/', [HomeController::class, 'index']);
Route::get('/searchKaryawan', [HomeController::class, 'selectSearch']);
Route::get('/getKaryawan/{nik_karyawan}', [HomeController::class, 'getKaryawan']);
Route::get('/karyawanPinjam', [HomeController::class, 'karyawanPinjam']);
Route::get('/karyawanSearch', [HomeController::class, 'karyawanSearch']);
Route::get('/barangSearch', [HomeController::class, 'barangSearch']);
Route::get('/storePinjamKaryawan', [HomeController::class, 'storePinjam']);
Route::get('/karyawanKembali', [HomeController::class, 'karyawanKembali']);
Route::get('/karyawanKembaliSearch', [HomeController::class, 'karyawanKembaliSearch']);
Route::get('/updateKaryawanKembali', [HomeController::class, 'updateKaryawanKembali']);
Route::get('/kontraktorPinjam', [HomeController::class, 'kontraktorPinjam']);
Route::get('/storePinjamKontraktor', [HomeController::class, 'storePinjamKontraktor']);
Route::get('/kontraktorKembali', [HomeController::class, 'kontraktorKembali']);
Route::get('/kontraktorKembaliSearch', [HomeController::class, 'kontraktorKembaliSearch']);
Route::get('/updateKontraktorKembali', [HomeController::class, 'updateKontraktorKembali']);

Route::get('/admin', function () {
    return view('admin/index');
});
Route::get('/karyawan', function () {
    return view('admin/karyawan');
});
Route::get('/login', []);
// AREA LOKASI KERJA
Route::get('/area', [LokasiController::class, 'lokasi']);
Route::get('/readArea', [LokasiController::class, 'read']);
Route::get('/searchArea', [LokasiController::class, 'search']);
Route::get('/createArea', [LokasiController::class, 'create']);
Route::get('/storeArea', [LokasiController::class, 'store']);
Route::get('/showArea/{id}', [LokasiController::class, 'show']);
Route::get('/updateArea/{id}', [LokasiController::class, 'update']);
Route::get('/deleteArea/{id}', [LokasiController::class, 'destroy']);
// Karyawan
Route::get('/karyawan', [KaryawanController::class, 'index']);
Route::get('/createKaryawan', [KaryawanController::class, 'create']);
Route::get('/storeKaryawan', [KaryawanController::class, 'store']);
Route::get('/readKaryawan', [KaryawanController::class, 'read']);
Route::get('/showKaryawan/{nik_karyawan}', [KaryawanController::class, 'show']);
Route::get('/updateKaryawan/{nik_karyawan}', [KaryawanController::class, 'update']);
Route::get('/deleteKaryawan/{id}', [KaryawanController::class, 'destroy']);
// Barang
Route::get('/barang', [BarangController::class, 'index']);
Route::get('/readBarang', [BarangController::class, 'read']);
Route::get('/createBarang', [BarangController::class, 'create']);
Route::get('/storeBarang', [BarangController::class, 'store']);
Route::get('/showBarang/{id}', [BarangController::class, 'show']);
Route::get('/updateBarang/{id}', [BarangController::class, 'update']);
Route::get('/deleteBarang/{id}', [BarangController::class, 'destroy']);
// Transaksi Karyawan
Route::get('/transaksiKaryawan', [TransaksiKaryawanController::class, 'index']);
Route::get('/readTransaksiKaryawan', [TransaksiKaryawanController::class, 'read']);
Route::get('/createTransaksiKaryawan', [TransaksiKaryawanController::class, 'create']);
Route::get('/storeTransaksiKaryawan', [TransaksiKaryawanController::class, 'store']);
Route::get('/showTransaksiKaryawan/{id}', [TransaksiKaryawanController::class, 'show']);
Route::get('/updateTransaksiKaryawan/{id}', [TransaksiKaryawanController::class, 'update']);
Route::get('/deleteTransaksiKaryawan/{id}', [TransaksiKaryawanController::class, 'destroy']);
Route::get('/downloadTransaksiKaryawan/{created_at}', [TransaksiKaryawanController::class, 'export']);
Route::get('/showReportTransaksiKaryawan', [TransaksiKaryawanController::class, 'showReport']);
// Transaksi Kontraktor
Route::get('/transaksiKontraktor', [TransaksiKontraktorController::class, 'index']);
Route::get('/readTransaksiKontraktor', [TransaksiKontraktorController::class, 'read']);
Route::get('/createTransaksiKontraktor', [TransaksiKontraktorController::class, 'create']);
Route::get('/storeTransaksiKontraktor', [TransaksiKontraktorController::class, 'store']);
Route::get('/showTransaksiKontraktor/{id}', [TransaksiKontraktorController::class, 'show']);
Route::get('/updateTransaksiKontraktor/{id}', [TransaksiKontraktorController::class, 'update']);
Route::get('/deleteTransaksiKontraktor/{id}', [TransaksiKontraktorController::class, 'destroy']);
Route::get('/downloadTransaksiKontraktor/{created_at}', [TransaksiKontraktorController::class, 'export']);
Route::get('/showReportTransaksiKontraktor', [TransaksiKontraktorController::class, 'showReport']);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

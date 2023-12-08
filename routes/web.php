<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LaporanController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RakController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\TransaksiDetailController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(ObatController::class)
    ->prefix('/manajemen_obat') //menu menejemen
    ->group(function(){
        Route::get('/', 'index')->name('obat.index'); //untuk create,delete edit menu di dalam menu//
    });
Route::get('obat/{id}/edit', [ObatController::class, 'edit'])->name('obat.edit');
Route::put('obat/{id}', [ObatController::class, 'update'])->name('obat.update');
Route::get('obat/create', [ObatController::class, 'create'])->name('obat.create');
Route::post('obat', [ObatController::class, 'store'])->name('obat.store');
Route::delete('obat/{id}', [ObatController::class, 'destroy'])->name('obat.destroy');

Route::controller(UserController::class)
    ->prefix('/manajemen_user') //menu menejemen
    ->group(function(){
        Route::get('/', 'index')->name('manajemen_user.index'); //untuk create,delete edit menu di dalam menu//
    });
    Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('user/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user', [UserController::class, 'store'])->name('user.store');
    Route::delete('/user/{id}',[UserController::class, 'destroy'])->name('user.destroy');

Route::get('/manajemen_rak', [RakController::class, 'index'])->name('rak.index');
Route::get('rak/{id}/edit', [RakController::class, 'edit'])->name('rak.edit');
Route::put('rak/{id}', [RakController::class, 'update'])->name('rak.update');
Route::get('rak/create', [RakController::class, 'create'])->name('rak.create');
Route::post('rak', [RakController::class, 'store'])->name('rak.store');
Route::delete('/rak/{id}',[RakController::class, 'destroy'])->name('rak.destroy');

Route::get('/penjualan/data', [TransaksiController::class, 'data'])->name('penjualan.data');
Route::get('/penjualan', [TransaksiController::class, 'index'])->name('penjualan.index');
Route::get('/penjualan/{id}', [TransaksiController::class, 'show'])->name('penjualan.show');
Route::delete('/penjualan/{id}', [TransaksiController::class, 'destroy'])->name('penjualan.destroy');

Route::get('/transaksi/baru', [TransaksiController::class, 'create'])->name('transaksi.baru');
Route::post('/transaksi/simpan', [TransaksiController::class, 'store'])->name('transaksi.simpan');
Route::get('/transaksi/selesai', [TransaksiController::class, 'selesai'])->name('transaksi.selesai');
Route::get('/transaksi/nota-kecil', [TransaksiController::class, 'notaKecil'])->name('transaksi.nota_kecil');
Route::get('/transaksi/nota-besar', [TransaksiController::class, 'notaBesar'])->name('transaksi.nota_besar');

Route::get('/transaksi/{id}/data', [TransaksiDetailController::class, 'data'])->name('transaksi.data');
Route::get('/transaksi/loadform/{total}/{diterima}', [TransaksiDetailController::class, 'loadForm'])->name('transaksi.load_form');
Route::resource('/transaksi', TransaksiDetailController::class)
    ->except('create','edit','show');
Route::delete('/rak/{id}',[RakController::class, 'destroy'])->name('rak.destroy');

    Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('/laporan/data/{awal}/{akhir}', [LaporanController::class, 'data'])->name('laporan.data');
    Route::get('/laporan/pdf/{awal}/{akhir}', [LaporanController::class, 'exportPDF'])->name('laporan.export_pdf');


require __DIR__.'/auth.php';

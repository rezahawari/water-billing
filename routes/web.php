<?php

use App\Http\Controllers\AlamatController;
use App\Http\Controllers\CatatController;
use App\Http\Controllers\CobaController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagihanController;
use App\Http\Controllers\TarifController;
use App\Http\Controllers\TunggakanController;
use App\Http\Controllers\UserController;
use App\Models\Customer;
use Illuminate\Support\Facades\Route;


//LOGIN
Route::post('/masuk', [LoginController::class, 'login']);
Route::get('/coba', [CobaController::class, 'coba']);
Route::get('/get-filled-months', [CatatController::class, 'getFilledMonths']);
Route::middleware('auth')->group(function(){
    Route::get('/', function () {
        return view('pages.dashboard');
    })->name('dashboard');

    Route::post('/keluar', [LoginController::class, 'logout'])->name('keluar');
    // CATAT METER
    Route::get('/catat-meter', [CatatController::class, 'home'])->name('catat');
    Route::get('/cek-pelanggan/{id}', [CatatController::class, 'caripelanggan']);
    Route::get('/cek-catat/{id}', [CatatController::class, 'ceklastcatat']);
    Route::get('/search-pelanggan', [CatatController::class, 'searchpelanggan']);
    Route::post('/catat/store', [CatatController::class, 'store'])->name('catat.store');
    Route::put('/catat/update/{id}', [CatatController::class, 'update'])->name('catat.update');
    Route::get('/catat/detail/{id}', [CatatController::class, 'getDetail'])->name('catat.detail');
    Route::delete('/catat/{id}/destroy', [CatatController::class, 'destroy'])->name('catat.destroy');
    // Route::get('/get-filled-months', [CatatController::class, 'getFilledMonths']);

    // TAGIHAN
    Route::get('/tagihan', [TagihanController::class, 'home'])->name('tagihan');
    Route::get('/tagihan/{tagihan}/show', [TagihanController::class, 'show'])->name('tagihan.show');

    // LAPORAN
    Route::get('/penggunaan', [LaporanController::class, 'penggunaan'])->name('penggunaan');
    Route::post('/penggunaan/cetak', [LaporanController::class, 'cetakpenggunaan'])->name('penggunaan.cetak');
    Route::get('/tunggakan', [TunggakanController::class, 'home'])->name('tunggakan');

    //PELANGGAN
    Route::get('/pelanggan', [CustomerController::class, 'all'])->name('customer.all');
    Route::get('/get-tarif/{alamat}', [CustomerController::class, 'getTarif']);
    Route::post('/pelanggan/store', [CustomerController::class, 'store'])->name('customer.allstore');
    Route::put('/pelannggan/update', [CustomerController::class, 'update'])->name('customer.allupdate');
    Route::delete('/pelannggan/{id}/destroy', [CustomerController::class, 'destroy'])->name('customer.alldestroy');
    Route::get('/pelanggan/{customer}/show', [CustomerController::class, 'show'])->name('customer.allshow');

    //SETTINGS
    Route::get('/users', [UserController::class, 'home'])->name('users');
    Route::post('/users/store', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/update', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{id}/destroy', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/alamat',[AlamatController::class, 'home'])->name('alamat');
    Route::post('/alamat/store', [AlamatController::class, 'store'])->name('alamat.store');
    Route::put('/alamat/update', [AlamatController::class, 'update'])->name('alamat.update');
    Route::delete('/alamat/{id}/destroy', [AlamatController::class, 'destroy'])->name('alamat.destroy');

    Route::get('/tarif',[TarifController::class, 'home'])->name('tarif');
    Route::post('/tarif/store', [TarifController::class, 'store'])->name('tarif.store');
    Route::put('/tarif/update', [TarifController::class, 'update'])->name('tarif.update');
    Route::delete('/tarif/{id}/destroy', [TarifController::class, 'destroy'])->name('tarif.destroy');

});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

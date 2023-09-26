<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PresensiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/



Route::middleware(['guest:karyawan'])->group(function(){
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class, 'proseslogin']);
});

Route::middleware(['auth:karyawan'])->group(function(){
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::get('/proseslogout', [AuthController::class, 'proseslogout']);
    
    Route::get('presensi/create', [PresensiController::class, 'create']);
    Route::post('presensi/store',[PresensiController::class, 'store']);
    
    Route::get('/editprofile',[PresensiController::class, 'editprofile']);
    Route::post('presensi/{nik}/updateprofile',[PresensiController::class, 'updateprofile']);
    
    Route::get('/presensi/histori', [PresensiController::class, 'histori']);
    Route::post('gethistori', [PresensiController::class, 'gethistori']);
});

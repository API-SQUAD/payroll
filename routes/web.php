<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\ResignController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
});


Route::middleware(['auth'])->group(function () {
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/', 'index')->name('dashboard');
    });

    Route::controller(UserController::class)->prefix('/users')->name('users.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data', 'data')->name('data');
        Route::post('/store', 'store')->name('store');
        Route::put('/{user}', 'update')->name('update');
        Route::delete('/{user}', 'destroy')->name('destroy');
    });

    Route::controller(GajiController::class)->prefix('/gaji')->name('gaji.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/data-table/{id}', 'dataTable')->name('data-table');
        Route::get('/modal-data/{id}', 'modalData')->name('modal-data');
        Route::get('/detail/{id}', 'detail')->name('detail');
        Route::post('/create-gaji', 'createGaji')->name('create-gaji');
        Route::post('/add-potongan', 'addPotongan')->name('add-potongan');
        Route::post('/add-koreksi', 'addKoreksi')->name('add-koreksi');
        Route::post('/delete-potongan', 'deletePotongan')->name('delete-potongan');
        Route::post('/delete-koreksi', 'deleteKoreksi')->name('delete-koreksi');
        Route::post('/store-detail', 'storeDetail')->name('store-detail');
        Route::get('/print-excel/{id}', 'printExcel')->name('print-excel');
        Route::get('/print-pdf/{id}', 'printPdf')->name('print-pdf');
    });

    Route::controller(ResignController::class)->prefix('/resign')->name('resign.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/data-table', 'dataTable')->name('data-table');
        Route::get('/get-aktif-karyawan-list', 'getAktifKaryawanList')->name('get-aktif-karyawan-list');
        Route::post('/store', 'store')->name('store');
    });
});

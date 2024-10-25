<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IjinController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pengajuan', function (){
    return view('pengajuan');
});

Route::get('/pengajuan-status', function () {
    return view('pengajuan-status');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

Route::get('/ijin/create', [IjinController::class, 'create'])->name('ijin.create');
Route::post('/ijin/store',  [IjinController::class, 'store'])->name('ijin.store');
Route::get('/ijin', 'IjinController@index')->name('ijin.index');

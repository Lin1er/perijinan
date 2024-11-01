<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IjinController;
use Illuminate\Routing\Route as RoutingRoute;

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

    Route::get('/ijin', 'IjinController@index')->name('ijin.index');
    Route::get('/ijin/create', [IjinController::class, 'create'])->name('ijin.create');
    Route::post('/ijin/store',  [IjinController::class, 'store'])->name('ijin.store');
    Route::get('/ijin/{ijin}', [IjinController::class, 'show'])->name('ijin.show');
    Route::patch('/ijin/{ijin}/verify', [IjinController::class, 'verify'])->name('ijin.verify');
    Route::patch('/ijin/{ijin}/pickup', [IjinController::class, 'pickup'])->name('ijin.pickup');
    Route::patch('/ijin/{ijin}/return', [IjinController::class, 'return'])->name('ijin.return');
    Route::delete('/ijin/{ijin}', [IjinController::class, 'destroy'])->name('ijin.destroy');
});

Route::middleware(['auth', 'can:akses admin'])->group(function(){
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/student', [AdminController::class, 'studentIndex'])->name('admin.student.index');
    Route::get('/admin/create', [AdminController::class, 'studentCreate'])->name('admin.student.create');
    Route::post('/admin/store', [AdminController::class, 'studentStore'])->name('admin.student.store');
    Route::get('/admin/{student}', [AdminController::class, 'studentShow'])->name('admin.student.show');
    Route::patch('/admin/{student}', [AdminController::class, 'studentEdit'])->name('admin.student.edit');
    Route::delete('/admin/{student}', [AdminController::class, 'studentDestroy'])->name('admin.student.destroy');
});


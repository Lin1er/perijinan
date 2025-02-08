<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IjinController;
use App\Http\Controllers\WhacenterController;
use App\Models\Ijin;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;
use App\Jobs\GenerateSuratIjin as JobsGenerateSuratIjin;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pengajuan', function () {
    return view('pengajuan');
});

Route::get('/pengajuan-status', function () {
    return view('pengajuan-status');
});

Route::middleware(['auth', config('jetstream.auth_session'), 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('ijin')->group(function () {
        Route::get('/', [IjinController::class, 'index'])->name('ijin.index');
        Route::get('/create', [IjinController::class, 'create'])->name('ijin.create');
        Route::post('/store', [IjinController::class, 'store'])->name('ijin.store');
        Route::get('/{ijin}', [IjinController::class, 'show'])->name('ijin.show');
        Route::patch('/{ijin}/verify', [IjinController::class, 'verify'])->name('ijin.verify');
        Route::patch('/{ijin}/pickup', [IjinController::class, 'pickup'])->name('ijin.pickup');
        Route::patch('/{ijin}/return', [IjinController::class, 'return'])->name('ijin.return');
        Route::delete('/{ijin}', [IjinController::class, 'destroy'])->name('ijin.destroy');
    });
});

Route::middleware(['auth', 'can:akses admin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');

        Route::prefix('student')->group(function () {
            Route::get('/', [AdminController::class, 'studentIndex'])->name('admin.student.index');
            Route::get('/create', [AdminController::class, 'studentCreate'])->name('admin.student.create');
            Route::post('/store', [AdminController::class, 'studentStore'])->name('admin.student.store');
            Route::get('/{student}', [AdminController::class, 'studentEdit'])->name('admin.student.edit');
            Route::patch('/{student}', [AdminController::class, 'studentUpdate'])->name('admin.student.update');
            Route::delete('/{student}', [AdminController::class, 'studentDestroy'])->name('admin.student.destroy');
        });

        Route::prefix('whacenter')->group(function () {
            Route::get('/', [WhacenterController::class, 'index'])->name('admin.whacenter.index');
            Route::get('/create', [WhacenterController::class, 'create'])->name('admin.whacenter.create');
            Route::post('/store', [WhacenterController::class, 'store'])->name('admin.whacenter.store');
            Route::get('/{whacenter}/edit', [WhacenterController::class, 'edit'])->name('admin.whacenter.edit');
            Route::patch('/{whacenter}', [WhacenterController::class, 'update'])->name('admin.whacenter.update');
            Route::delete('/{whacenter}', [WhacenterController::class, 'destroy'])->name('admin.whacenter.destroy');
        });

        Route::prefix('role')->group(function () {
            Route::get('/', [AdminController::class, 'roleIndex'])->name('admin.role.index');
            Route::get('/create', [AdminController::class, 'roleCreate'])->name('admin.role.create');
            Route::get('/{role}', [AdminController::class, 'roleShow'])->name('admin.role.show');
            Route::post('/store', [AdminController::class, 'roleStore'])->name('admin.role.store');
            Route::get('/{role}/edit', [AdminController::class, 'roleEdit'])->name('admin.role.edit');
            Route::patch('/{role}', [AdminController::class, 'roleUpdate'])->name('admin.role.update');
            Route::delete('/{role}', [AdminController::class, 'roleDestroy'])->name('admin.role.destroy');
        });

        Route::prefix('permission')->group(function () {
            Route::get('/create', [AdminController::class, 'permissionCreate'])->name('admin.permission.create');
            Route::post('/store', [AdminController::class, 'permissionStore'])->name('admin.permission.store');
            Route::get('/{permission}/edit', [AdminController::class, 'permissionEdit'])->name('admin.permission.edit');
            Route::patch('/{permission}', [AdminController::class, 'permissionUpdate'])->name('admin.permission.update');
            Route::delete('/{permission}', [AdminController::class, 'permissionDestroy'])->name('admin.permission.destroy');
        });

        Route::prefix('kelas')->group(function () {
            Route::get('/', [AdminController::class, 'kelasIndex'])->name('admin.kelas.index');
            Route::get('/create', [AdminController::class, 'kelasCreate'])->name('admin.kelas.create');
            Route::post('/store', [AdminController::class, 'kelasStore'])->name('admin.kelas.store');
            Route::get('/{studentClass}/edit', [AdminController::class, 'kelasEdit'])->name('admin.kelas.edit');
            Route::patch('/{studentClass}', [AdminController::class, 'kelasUpdate'])->name('admin.kelas.update');
            Route::delete('/{studentClass}', [AdminController::class, 'kelasDestroy'])->name('admin.kelas.destroy');
        });

        Route::prefix('user')->group(function () {
            Route::get('/', [AdminController::class, 'userIndex'])->name('admin.user.index');
            Route::get('/{user}', [AdminController::class, 'userShow'])->name('admin.user.show');
            Route::get('/{user}/edit', [AdminController::class, 'userEdit'])->name('admin.user.edit');
            Route::patch('/{user}', [AdminController::class, 'userUpdate'])->name('admin.user.update');
            Route::delete('/{user}', [AdminController::class, 'userDestroy'])->name('admin.user.destroy');
        });
    });
});


Route::get('/job/generate-surat-ijin/{id}', function ($id) {
    JobsGenerateSuratIjin::dispatch(Ijin::find($id));
    return "Job Generate Surat Ijin dengan ID {$id} berhasil dijalankan";
});

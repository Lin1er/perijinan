<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IjinController;
use App\Models\Ijin;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Route;

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
    'auth',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/ijin', [IjinController::class, 'index'])->name('ijin.index');
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
    Route::get('/admin/{student}', [AdminController::class, 'studentEdit'])->name('admin.student.edit');
    Route::patch('/admin/{student}', [AdminController::class, 'studentUpdate'])->name('admin.student.update');
    Route::delete('/admin/{student}', [AdminController::class, 'studentDestroy'])->name('admin.student.destroy');

    
    Route::get('/admin/user', [AdminController::class, 'userIndex'])->name('admin.user.index');
    Route::get('/admin/user/{user}', [AdminController::class, 'userShow'])->name('admin.user.show');
    Route::get('/admin/user/{user}/edit', [AdminController::class, 'userEdit'])->name('admin.user.edit');
    Route::patch('/admin/user/{user}', [AdminController::class, 'userUpdate'])->name('admin.user.update');
    Route::delete('/admin/user/{user}', [AdminController::class, 'userDestroy'])->name('admin.user.destroy');
});

Route::get('/admin/kelas', [AdminController::class, 'kelasIndex'])->name('admin.kelas.index');

Route::get('/pdfdev', function(){
    $id = 5;
    $ijin = Ijin::find($id);
    if (!$ijin) {
        return "Data with ID {$id} not found.";
    }
    return view('pdfs.ijin_pdf', compact('ijin'));
});

Route::get('/print/pdf', function(){
    $id = 5;
    $ijin = Ijin::find($id);
    $pdf = Pdf::loadView('pdfs.ijin_pdf',compact('ijin'));
    return $pdf->download();
});
<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\IjinController;
use App\Http\Controllers\WhacenterController;
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

    Route::get('/whacenter', [WhacenterController::class, 'index'])->name('admin.whacenter.index');
    Route::get('/whacenter/create', [WhacenterController::class, 'create'])->name('admin.whacenter.create');
    Route::post('/whacenter/store', [WhacenterController::class, 'store'])->name('admin.whacenter.store');
    Route::get('/whacenter/{whacenter}/edit', [WhacenterController::class, 'edit'])->name('admin.whacenter.edit');
    Route::patch('/whacenter/{whacenter}', [WhacenterController::class, 'update'])->name('admin.whacenter.update');
    Route::delete('/whacenter/{whacenter}', [WhacenterController::class, 'destroy'])->name('admin.whacenter.destroy');

    Route::get('/role', [AdminController::class, 'roleIndex'])->name('admin.role.index');
    Route::get('/role/create', [AdminController::class, 'roleCreate'])->name('admin.role.create');
    Route::get('/role/{role}', [AdminController::class, 'roleShow'])->name('admin.role.show');
    Route::post('/role/store', [AdminController::class, 'roleStore'])->name('admin.role.store');
    Route::get('/role/{role}/edit', [AdminController::class, 'roleEdit'])->name('admin.role.edit');
    Route::patch('/role/{role}', [AdminController::class, 'roleUpdate'])->name('admin.role.update');
    Route::delete('/role/{role}', [AdminController::class, 'roleDestroy'])->name('admin.role.destroy');

    Route::get('/permission/create', [AdminController::class, 'permissionCreate'])->name('admin.permission.create');
    Route::post('/permission/store', [AdminController::class, 'permissionStore'])->name('admin.permission.store');
    Route::get('/permission/{permission}/edit', [AdminController::class, 'permissionEdit'])->name('admin.permission.edit');
    Route::patch('/permission/{permission}', [AdminController::class, 'permissionUpdate'])->name('admin.permission.update');
    Route::delete('/permission/{permission}', [AdminController::class, 'permissionDestroy'])->name('admin.permission.destroy');
    
    Route::get('/kelas', [AdminController::class, 'kelasIndex'])->name('admin.kelas.index');
    Route::get('/kelas/create', [AdminController::class, 'kelasCreate'])->name('admin.kelas.create');
    Route::post('/kelas/store', [AdminController::class, 'kelasStore'])->name('admin.kelas.store');
    Route::get('/kelas/{studentClass}/edit', [AdminController::class, 'kelasEdit'])->name('admin.kelas.edit');
    Route::patch('/kelas/{studentClass}', [AdminController::class, 'kelasUpdate'])->name('admin.kelas.update');
    Route::delete('/kelas/{studentClass}', [AdminController::class, 'kelasDestroy'])->name('admin.kelas.destroy');

    Route::get('/admin/user', [AdminController::class, 'userIndex'])->name('admin.user.index');
    Route::get('/admin/user/{user}', [AdminController::class, 'userShow'])->name('admin.user.show');
    Route::get('/admin/user/{user}/edit', [AdminController::class, 'userEdit'])->name('admin.user.edit');
    Route::patch('/admin/user/{user}', [AdminController::class, 'userUpdate'])->name('admin.user.update');
    Route::delete('/admin/user/{user}', [AdminController::class, 'userDestroy'])->name('admin.user.destroy');
});



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
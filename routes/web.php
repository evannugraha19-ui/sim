<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\TeknisiController;
use App\Http\Controllers\UserController;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        $pendingCount = Pengaduan::where('status', 'menunggu')->where('user_id',Auth::id())->count();
        $processingCount = Pengaduan::where('status', 'diproses')->where('user_id',Auth::id())->count();
        $completedCount = Pengaduan::where('status', 'selesai')->where('user_id',Auth::id())->count();

        return view('dashboard', compact('pendingCount', 'processingCount', 'completedCount'));
    });

    Route::get('/admin/profile', function () {
        $admin = Auth::user();
        return view('akun-profil-admin', compact('admin'));
    });

    Route::get('/dashboard-admin', function () {
        $pengaduanCount = Pengaduan::count();

        $userCount = User::where('role', '!=', 'teknisi')->count();

        $teknisiCount = User::where('role', 'teknisi')->count();

        return view('dashboard-admin', compact('pengaduanCount', 'userCount', 'teknisiCount'));
    });

    Route::get('/dashboard-teknisi', function () {
        $pendingCount = Pengaduan::where('status', 'menunggu')->count();
        $processingCount = Pengaduan::where('status', 'diproses')->count();
        $completedCount = Pengaduan::where('status', 'selesai')->count();

        return view('dashboard-teknisi', compact('pendingCount', 'processingCount', 'completedCount'));
    });

    Route::get('/riwayat-pengaduan', [PengaduanController::class, 'index']);
    Route::get('/input-pengaduan', [PengaduanController::class, 'create']);
    Route::post('/input-pengaduan', [PengaduanController::class, 'store']);
    Route::get('/pengaduan/{id}', [PengaduanController::class, 'show']);
    Route::put('/pengaduan/{id}', [PengaduanController::class, 'update']);
    Route::delete('/pengaduan/{id}', [PengaduanController::class, 'destroy']);

    Route::get('/laporan', [PengaduanController::class, 'laporan']);
    Route::get('/laporan/export/pdf', [PengaduanController::class, 'exportPdf'])->name('laporan.export.pdf');
    Route::get('/laporan/export/excel', [PengaduanController::class, 'exportExcel'])->name('laporan.export.excel');

    Route::get('/akun-profil-admin', function () {
        return view('auth.akun-profil-admin');
    });

    Route::resource('/users', UserController::class);
    Route::resource('/teknisi', TeknisiController::class);

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

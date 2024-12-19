<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PelanggaranController;

// Home
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        $view = $user->role === 'Orang Tua' ? 'dashboard.orangtua' : 'dashboard.admin';
        return view($view, compact('user'));
    }
    return redirect()->route('login');
})->name('home');

// Login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {

    // Dashboard 
    Route::get('/dashboard/orangtua', [DashboardController::class, 'showDashboardOrangtua'])->name('dashboard.orangtua');
    Route::get('/dashboard/admin', [DashboardController::class, 'showDashboardAdmin'])->name('dashboard.admin');

    // Pelanggaran 
    Route::prefix('pelanggaran')->group(function () {
        Route::get('/add', [PelanggaranController::class, 'create'])->name('pelanggaran.create');
        Route::post('/add', [PelanggaranController::class, 'store'])->name('pelanggaran.store');

        Route::get('/{id}/comments', [PelanggaranController::class, 'showComments'])->name('pelanggaran.showComments');
        Route::post('/{id}/comments', [PelanggaranController::class, 'storeComment'])->name('pelanggaran.storeComment');

        Route::get('/no-response', function () {
            return view('fitur.detailAdmin-no-response');
        })->name('fitur.detailAdmin-no-response');

        Route::get('/update', [PelanggaranController::class, 'updatePelanggaran'])->name('updatePelanggaran');
        Route::post('/{id}/update-status', [PelanggaranController::class, 'updateStatus'])->name('pelanggaran.updateStatus');
        Route::post('/{id}/update-level', [PelanggaranController::class, 'updateLevel'])->name('pelanggaran.updateLevel');
        Route::patch('/{pelanggaran}/update-level', [PelanggaranController::class, 'updateLevel'])->name('pelanggaran.updateLevel');

        // Search 
        Route::get('/search', [DashboardController::class, 'search'])->name('pelanggaran.search');
    });

    // Pelanggaran Mahasiswa
    Route::get('/pelanggaran-mahasiswa', [PelanggaranController::class, 'showPelanggaranMhs'])->name('pelanggaranMahasiswa');
    Route::get('/pelanggaran-mahasiswa/{id}/', [PelanggaranController::class, 'showDetailMahasiswa'])->name('pelanggaranMahasiswa.detail');

    Route::post('/get-prodi-by-angkatan', [PelanggaranController::class, 'getProdiByAngkatan'])->name('getProdiByAngkatan');
});

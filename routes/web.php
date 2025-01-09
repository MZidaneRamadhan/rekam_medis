<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\KunjunganController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\LabolatoriumController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliklinikController;
use App\Http\Controllers\RekamMedisController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TindakanController;
use App\Http\Controllers\UserController;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', [LoginController::class, 'checklogin'])->name('login');
// Route::get('/login', [LoginController::class, 'checklogin'])->name('login');
Route::post('/login-action', [LoginController::class, 'login_action']);

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/report-rm', [ReportController::class, 'reportrm'])->name('reportrm');
        Route::get('/report-rm-details', [ReportController::class, 'reportdetail'])->name('reportdetail');

        // User
        Route::get('/user', [UserController::class, 'index'])->name('user');
        Route::post('/user-store', [UserController::class, 'store']);
        Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
        Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.delete');

        // Dokter
        Route::get('/dokter', [DokterController::class, 'index'])->name('dashboard.dokter.index');
        Route::post('/dokter-store', [DokterController::class, 'store']);
        Route::get('/dokter/{id}/details', [DokterController::class, 'show'])->name('details.dokter');
        Route::put('/dokter/{id}/edit', [DokterController::class, 'update']);
        Route::delete('/dokter/{id}/delete', [DokterController::class, 'destroy'])->name('dokter.delete');

        // Pasien
        Route::delete('/pasien/{id}/delete', [PasienController::class, 'destroy'])->name('pasien.delete');
        Route::put('/pasien/{id}/update', [PasienController::class, 'update']);

        // Rekam Medis
        Route::put('/rekam-medis/{id}/update', [RekamMedisController::class, 'update']);
        Route::delete('/rekam-medis/{id}/delete', [RekamMedisController::class, 'destroy'])->name('rekammedis.delete');

        // Poli
        Route::get('/poli', [PoliklinikController::class, 'index'])->name('dashboard.poli.index');
        Route::post('/poli-store', [PoliklinikController::class, 'store']);
        Route::put('/poli/{id}/update', [PoliklinikController::class, 'update']);
        Route::delete('/poli/{id}/delete', [PoliklinikController::class, 'destroy'])->name('poli.delete');

        // Kunjungan
        Route::get('/tindakan', [TindakanController::class, 'index'])->name('dashboard.tindakan.index');
        Route::post('/tindakan-store', [TindakanController::class, 'store']);
        Route::put('/tindakan/{id}/update', [TindakanController::class, 'update']);
        Route::delete('/tindakan/{id}/delete', [TindakanController::class, 'destroy'])->name('tindakan.delete');
    });

    Route::middleware(['auth','role:admin,resepsionis'])->group(function () {
        // Kunjungan
    });

    Route::get('/kunjungan', [KunjunganController::class, 'index'])->name('dashboard.kunjungan.index');
    Route::get('/pasien/{id}/kunjungan', [KunjunganController::class, 'pendaftaran'])->name('pendaftaran');
    Route::post('/kunjungan-store', [KunjunganController::class, 'store']);

    Route::middleware(['auth','role:dokter,admin,resepsionis'])->group(function () {
        // Rekam Medis
        Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('dashboard.rekammedis.index');
        Route::get('/rekam-medis/{id}/details', [RekamMedisController::class, 'show']);
        Route::get('/dokter/kunjungan-pasien', [DokterController::class, 'antrianPasien'])->name('antrianPasien');
        Route::get('/dokter/menunggu-lab', [DokterController::class, 'waitedLab'])->name('waitedLab');
        Route::get('/dokter/{id}/pemeriksaan', [DokterController::class, 'medicalCheckup'])->name('pemeriksaan');
        Route::post('/rekam-medis/{id}/store', [RekamMedisController::class, 'store'])->name('rekamMedis.store');
        Route::get('/rekam-medis/{id}/edit', [RekamMedisController::class, 'edit'])->name('rekamMedis.edit');
        Route::put('/rekam-medis/{id}/update', [RekamMedisController::class, 'update'])->name('rekamMedis.update');

        // Pasien
        Route::get('/pasien', [PasienController::class, 'index'])->name('dashboard.pasien.index');
        Route::post('/pasien-store', [PasienController::class, 'store']);
        Route::get('/pasien/{id}/details', [PasienController::class, 'show'])->name('details');
    });

    Route::middleware(['auth','role:admin,apoteker'])->group(function () {
        // Obat
        Route::get('/obat', [ObatController::class, 'index'])->name('dashboard.obat.index');
        Route::post('/obat-store', [ObatController::class, 'store']);
        Route::put('/obat/{id}/update', [ObatController::class, 'update']);
        Route::delete('/obat/{id}/delete', [ObatController::class, 'destroy'])->name('obat.delete');
    });

    Route::middleware(['auth','role:apoteker'])->group(function () {
        // Obat
        Route::get('/rekam-medis/penyerahan-obat', [RekamMedisController::class, 'penyerahanObat'])->name('penyerahan');
        Route::get('/rekam-medis/{id}/invoice', [RekamMedisController::class, 'invoice'])->name('invoice');
        Route::put('/rekam-medis/{id}/finish', [RekamMedisController::class, 'finish'])->name('rekamMedis.finish');
    });

    Route::middleware(['auth','role:lab'])->group(function () {
        // Lab
        Route::get('/lab-penanganan', [LabolatoriumController::class, 'index'])->name('lab');
        Route::get('/lab-permintaan', [LabolatoriumController::class, 'permintaanLab'])->name('lab.permintaan');
        Route::get('/lab/{id}/penanganan', [LabolatoriumController::class, 'lab'])->name('lab.penanganan');
        Route::post('/lab/{id}/store', [LabolatoriumController::class, 'store'])->name('lab.store');
        Route::put('/lab/{id}/update', [LabolatoriumController::class, 'update']);
        Route::delete('/lab/{id}/delete', [LabolatoriumController::class, 'destroy'])->name('lab.delete');
    });

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});

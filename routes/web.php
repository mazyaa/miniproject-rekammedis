<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KelolaDesaController;
use App\Http\Controllers\KelolaJenisKelaminController;
use App\Http\Controllers\KelolaPasienController;
use App\Http\Controllers\KelolaPetugasController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RekamMedisController;
use Illuminate\Support\Facades\Route;
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



/**
 * ========================================= PUBLIC ROUTES =========================================
 * Route publik yang dapat diakses tanpa autentikasi
 * =========================================================================================================
 */

/**
 * Route Login - Halaman Masuk Aplikasi
 * Method: GET
 * Description: Menampilkan halaman login untuk pengguna yang belum terautentikasi
 */
Route::get('/', function () {
    return view('auth.login');
});

/**
 * ========================================= PROTECTED ROUTES =========================================
 * Semua route di bawah ini memerlukan autentikasi dan verifikasi email
 * Middleware: auth, verified
 * =========================================================================================================
 */

Route::middleware(['auth', 'verified'])->group(function () {

    /**
     * ========== DASHBOARD - HALAMAN UTAMA APLIKASI ==========
     * Route: /dashboard
     * Method: GET
     * Controller: DashboardController
     * Description: Menampilkan dashboard admin dengan statistik dan ringkasan data
     * Features:
     *  - Total pasien, petugas, dan konsultasi
     *  - Grafik data pasien 6 bulan terakhir
     *  - Aktivitas terbaru (konsultasi dan pendaftaran pasien)
     *  - Trend analisis perbandingan bulan lalu
     */
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /**
     * ========== KELOLA PASIEN - MANAJEMEN DATA PASIEN ==========
     * Controller: KelolaPasienController
     * Description: CRUD operations untuk manajemen data pasien
     *
     * Routes:
     *  GET    /kelola-pasien              - Menampilkan daftar pasien
     *  POST   /kelola-pasien-tambah      - Menambah pasien baru
     *  PUT    /kelola-pasien-edit-{id}   - Mengubah data pasien
     *  DELETE /kelola-pasien-hapus-{id}  - Menghapus pasien
     */
    Route::get('/kelola-pasien', [KelolaPasienController::class, 'index']);
    Route::post('/kelola-pasien-tambah', [KelolaPasienController::class, 'store']);
    Route::put('/kelola-pasien-edit-{id}', [KelolaPasienController::class, 'update']);
    Route::delete('/kelola-pasien-hapus-{id}', [KelolaPasienController::class, 'destroy']);

    /**
     * ========== KELOLA DESA - MANAJEMEN DATA DESA/WILAYAH ==========
     * Controller: KelolaDesaController
     * Description: CRUD operations untuk manajemen data desa/wilayah
     *
     * Routes:
     *  GET    /kelola-desa              - Menampilkan daftar desa
     *  POST   /kelola-desa-tambah      - Menambah desa baru
     *  PUT    /kelola-desa-edit-{id}   - Mengubah data desa
     *  DELETE /kelola-desa-hapus-{id}  - Menghapus desa
     */
    Route::get('/kelola-desa', [KelolaDesaController::class, 'index']);
    Route::post('/kelola-desa-tambah', [KelolaDesaController::class, 'store']);
    Route::put('/kelola-desa-edit-{id}', [KelolaDesaController::class, 'update']);
    Route::delete('/kelola-desa-hapus-{id}', [KelolaDesaController::class, 'destroy']);

    /**
     * ========== KELOLA JENIS KELAMIN - MANAJEMEN KATEGORI JENIS KELAMIN ==========
     * Controller: KelolaJenisKelaminController
     * Description: CRUD operations untuk data kategori jenis kelamin (Laki-laki, Perempuan, dll)
     *
     * Routes:
     *  GET    /kelola-jenis-kelamin               - Menampilkan daftar jenis kelamin
     *  POST   /kelola-jenis-kelamin-tambah       - Menambah kategori jenis kelamin baru
     *  PUT    /kelola-jenis-kelamin-edit-{id}    - Mengubah data jenis kelamin
     *  DELETE /kelola-jenis-kelamin-hapus-{id}   - Menghapus kategori jenis kelamin
     */
    Route::get('/kelola-jenis-kelamin', [KelolaJenisKelaminController::class, 'index']);
    Route::post('/kelola-jenis-kelamin-tambah', [KelolaJenisKelaminController::class, 'store']);
    Route::put('/kelola-jenis-kelamin-edit-{id}', [KelolaJenisKelaminController::class, 'update']);
    Route::delete('/kelola-jenis-kelamin-hapus-{id}', [KelolaJenisKelaminController::class, 'destroy']);

    /**
     * ========== KELOLA PETUGAS - MANAJEMEN DATA PETUGAS/USER ==========
     * Controller: KelolaPetugasController
     * Description: CRUD operations untuk manajemen data petugas/user aplikasi
     *
     * Routes:
     *  GET    /kelola-petugas              - Menampilkan daftar petugas
     *  POST   /kelola-petugas-tambah      - Menambah petugas baru
     *  PUT    /kelola-petugas-edit-{id}   - Mengubah data petugas
     *  DELETE /kelola-petugas-hapus-{id}  - Menghapus petugas
     */
    Route::get('/kelola-petugas', [KelolaPetugasController::class, 'index']);
    Route::post('/kelola-petugas-tambah', [KelolaPetugasController::class, 'store']);
    Route::put('/kelola-petugas-edit-{id}', [KelolaPetugasController::class, 'update']);
    Route::delete('/kelola-petugas-hapus-{id}', [KelolaPetugasController::class, 'destroy']);

    /**
     * ========== REKAM MEDIS - MANAJEMEN DATA REKAM MEDIS ==========
     * Controller: RekamMedisController
     * Description: CRUD operations untuk manajemen data rekam medis pasien
     *
     * Routes:
     *  GET    /kelola-rekam-medis              - Menampilkan daftar rekam medis
     *  POST   /kelola-rekam-medis-tambah      - Menambah rekam medis baru
     *  PUT    /kelola-rekam-medis-edit-{id}   - Mengubah data rekam medis
     *  DELETE /kelola-rekam-medis-hapus-{id}  - Menghapus rekam medis
     */
    Route::get('/rekam-medis', [RekamMedisController::class, 'index']);
    Route::post('/kelola-rekam-medis-tambah', [RekamMedisController::class, 'store']);
    Route::put('/kelola-rekam-medis-edit-{id}', [RekamMedisController::class, 'update']);
    Route::delete('/kelola-rekam-medis-hapus-{id}', [RekamMedisController::class, 'destroy']);

    /**
     * ========== PROFILE MANAGEMENT - MANAJEMEN PROFIL PENGGUNA ==========
     * Controller: ProfileController
     * Description: Manajemen profil pengguna yang sedang login
     *
     * Routes:
     *  GET    /profile  - Menampilkan form edit profil pengguna
     *  PATCH  /profile  - Memperbarui data profil pengguna
     *  DELETE /profile  - Menghapus akun pengguna
     */
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

}); // Akhir dari Protected Routes Group


require __DIR__ . '/auth.php';

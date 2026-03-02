<?php

use App\Http\Controllers\KelolaDesaController;
use App\Http\Controllers\KelolaJenisKelaminController;
use App\Http\Controllers\KelolaPasienController;
use App\Http\Controllers\KelolaPetugasController;
use App\Http\Controllers\ProfileController;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
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
     * Description: Menampilkan dashboard admin dengan statistik dan ringkasan data
     * Features:
     *  - Total pasien, petugas, dan konsultasi
     *  - Grafik data pasien 6 bulan terakhir
     *  - Aktivitas terbaru (konsultasi dan pendaftaran pasien)
     *  - Trend analisis perbandingan bulan lalu
     */
    Route::get('/dashboard', function () {
        // Total hitungan data
        $totalPasien = Pasien::count();
        $totalPetugas = User::count();
        $totalKonsultasi = RekamMedis::count();

        // Data pasien bulanan untuk grafik (6 bulan terakhir)
        $chartLabels = [];
        $chartData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $chartLabels[] = $date->translatedFormat('M');
            $chartData[] = Pasien::whereYear('created_at', $date->year)
                ->whereMonth('created_at', $date->month)
                ->count();
        }

        // Aktivitas terbaru (5 record terakhir)
        $recentActivities = RekamMedis::with(['pasien', 'petugas'])
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get()
            ->map(function ($record) {
                return [
                    'icon' => 'bi-clipboard2-pulse',
                    'variant' => 'success',
                    'text' => '<strong>' . ($record->pasien->nama_pasien ?? 'Pasien') . '</strong> melakukan konsultasi',
                    'time' => $record->created_at->diffForHumans()
                ];
            });

        // Tambahkan pasien terbaru
        $recentPatients = Pasien::orderBy('created_at', 'desc')
            ->take(3)
            ->get()
            ->map(function ($patient) {
                return [
                    'icon' => 'bi-person-plus',
                    'variant' => 'primary',
                    'text' => '<strong>' . $patient->nama_pasien . '</strong> telah terdaftar',
                    'time' => $patient->created_at->diffForHumans()
                ];
            });

        $activities = $recentActivities->merge($recentPatients)
            ->sortByDesc('time')
            ->take(5)
            ->values()
            ->toArray();

        // Hitung trend (perbandingan dengan bulan lalu)
        $lastMonthPasien = Pasien::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        $thisMonthPasien = Pasien::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $pasienTrend = $lastMonthPasien > 0
            ? round((($thisMonthPasien - $lastMonthPasien) / $lastMonthPasien) * 100)
            : ($thisMonthPasien > 0 ? 100 : 0);

        $lastMonthKonsultasi = RekamMedis::whereMonth('created_at', Carbon::now()->subMonth()->month)
            ->whereYear('created_at', Carbon::now()->subMonth()->year)
            ->count();
        $thisMonthKonsultasi = RekamMedis::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', Carbon::now()->year)
            ->count();

        $konsultasiTrend = $lastMonthKonsultasi > 0
            ? round((($thisMonthKonsultasi - $lastMonthKonsultasi) / $lastMonthKonsultasi) * 100)
            : ($thisMonthKonsultasi > 0 ? 100 : 0);

        return view('admin.dashboard', compact(
            'totalPasien',
            'totalPetugas',
            'totalKonsultasi',
            'chartLabels',
            'chartData',
            'activities',
            'pasienTrend',
            'konsultasiTrend'
        ));
    })->name('dashboard');

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

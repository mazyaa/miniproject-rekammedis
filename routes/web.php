<?php

use App\Http\Controllers\KelolaDesaController;
use App\Http\Controllers\KelolaJenisKelaminController;
use App\Http\Controllers\KelolaPetugasController;
use App\Http\Controllers\ProfileController;
use App\Models\Desa;
use App\Models\JenisKelamin;
use App\Models\Pasien;
use App\Models\RekamMedis;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
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



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    // Total counts
    $totalPasien = Pasien::count();
    $totalPetugas = User::count();
    $totalKonsultasi = RekamMedis::count();

    // Monthly patient data for chart (last 6 months)
    $chartLabels = [];
    $chartData = [];

    for ($i = 5; $i >= 0; $i--) {
        $date = Carbon::now()->subMonths($i);
        $chartLabels[] = $date->translatedFormat('M');
        $chartData[] = Pasien::whereYear('created_at', $date->year)
                            ->whereMonth('created_at', $date->month)
                            ->count();
    }

    // Recent activities (last 5 records)
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

    // Add recent patients
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

    // Calculate trends (comparison with last month)
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
})->middleware(['auth', 'verified'])->name('dashboard');

route::get('/kelola-pasien', function () {
    Session::flash('info', 'Data Dummy Seeder dan CRUD belum berfungsi');
    $data = Pasien::all();
    $jeniskelamin = JenisKelamin::all();
    $desa = Desa::all();
    return view('admin.Pasien.kelola-pasien', compact('data', 'jeniskelamin', 'desa'));
});

// ! ========================================= Desa CRUD ==============================================================
Route::post('/kelola-desa-tambah', [KelolaDesaController::class, 'store']);
route::get('/kelola-desa', [KelolaDesaController::class, 'index']);
Route::put('/kelola-desa-edit-{id}', [KelolaDesaController::class, 'update']);
Route::delete('/kelola-desa-hapus-{id}', [KelolaDesaController::class, 'destroy']);

// ! ========================================= Jenis Kelamin CRUD ==============================================================
Route::post('/kelola-jenis-kelamin-tambah', [KelolaJenisKelaminController::class, 'store']);
route::get('/kelola-jenis-kelamin', [KelolaJenisKelaminController::class, 'index']);
Route::put('/kelola-jenis-kelamin-edit-{id}', [KelolaJenisKelaminController::class, 'update']);
Route::delete('/kelola-jenis-kelamin-hapus-{id}', [KelolaJenisKelaminController::class, 'destroy']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware('auth')->group(function (){
    Route::get('/kelola-petugas', [KelolaPetugasController::class, 'index']);
    Route::post('/kelola-petugas-tambah', [KelolaPetugasController::class, 'store']);
    Route::put('/kelola-petugas-edit-{id}', [KelolaPetugasController::class, 'update']);
    Route::delete('/kelola-petugas-hapus-{id}', [KelolaPetugasController::class, 'destroy']);
});


require __DIR__ . '/auth.php';

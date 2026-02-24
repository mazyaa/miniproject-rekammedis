<?php

use App\Http\Controllers\KelolaDesaController;
use App\Http\Controllers\KelolaJenisKelaminController;
use App\Http\Controllers\ProfileController;
use App\Models\Desa;
use App\Models\JenisKelamin;
use App\Models\Pasien;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
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
    $data = Pasien::all();
    $totalPasien = Pasien::count();
    return view('admin.dashboard', compact('data', 'totalPasien'));
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

// ! ========================================= REKAM MEDIS ==============================================================

Route::middleware('auth')->group(function (){

});

require __DIR__ . '/auth.php';

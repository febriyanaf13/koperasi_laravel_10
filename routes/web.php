<?php

use App\Http\Controllers\AngsuranController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JenisPinjamanController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\ProsesHitungController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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

// Rute untuk Admin
Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UserController::class);
    Route::resource('dashboard', DashboardController::class);
    Route::get('/nasabah-data', [DashboardController::class, 'getNasabahData']);
    Route::resource('nasabah', NasabahController::class);
    Route::resource('jenis_pinjaman', JenisPinjamanController::class);
    Route::resource('transaksis', TransaksiController::class);
    Route::resource('angsurans', AngsuranController::class);
    Route::resource('laporans', LaporanController::class);
    Route::resource('proses_hitungs', ProsesHitungController::class);
    Route::get('/angsurans/by-peminjam/{peminjam_id}', [AngsuranController::class, 'getAngsuranByPeminjam'])->name('angsurans.by-peminjam');
});


// Route untuk halaman utama
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();

        if ($user->role === 'admin' || $user->role === 'operator') {
            return redirect()->route('dashboard.index');
        } elseif ($user->role === 'anggota') {
            return redirect()->route('angsurans.index');
        }
    } else {
        return redirect()->route('login'); // Redirect ke halaman login jika tidak ada pengguna yang terotentikasi
    }
})->name('home');

// Rute untuk halaman login
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// middleware guest untuk halaman login
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'index'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Rute logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

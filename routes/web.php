<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\KategoriAgendaController;
use App\Http\Controllers\Admin\KomentarController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role ?? null;
    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'dosen' => redirect()->route('dosen.dashboard'),
        'staff' => redirect()->route('staff.dashboard'),
        'mahasiswa' => redirect()->route('mahasiswa.landing'),
        default => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', function () {
    return view('admin.dashboard'); // akan SB Admin 2 di sini
})->name('admin.dashboard');

Route::middleware(['auth', 'role:dosen'])->get('/dosen/dashboard', function () {
    return view('dosen.dashboard'); // akan SB Admin 2
})->name('dosen.dashboard');

Route::middleware(['auth', 'role:staff'])->get('/staff/dashboard', function () {
    return view('staff.dashboard'); // akan SB Admin 2
})->name('staff.dashboard');

Route::middleware(['auth', 'role:mahasiswa'])->get('/landing', function () {
    return view('mahasiswa.landing'); // hanya tampilan landing page
})->name('mahasiswa.landing');

Route::middleware(['auth', 'role:mahasiswa'])->get('/informasi', function () {
    // Nanti bisa diganti dengan controller kalau sudah ada model
    return view('mahasiswa.informasi', [
        'dataInformasi' => \App\Models\Informasi::latest()->get()
    ]);
})->name('mahasiswa.informasi');

Route::middleware(['auth', 'role:mahasiswa'])->get('/agenda', function () {
    return view('mahasiswa.agenda', [
        'dataAgenda' => \App\Models\Agenda::latest()->get()
    ]);
})->name('mahasiswa.agenda');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('informasi', InformasiController::class);
    Route::resource('kategori-agenda', KategoriAgendaController::class);
    Route::resource('komentar', KomentarController::class)->only(['index', 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

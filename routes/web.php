<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\KategoriAgendaController;
use App\Http\Controllers\Admin\KomentarController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Mahasiswa\InformasiController as MahasiswaInformasiController;
use App\Http\Controllers\Mahasiswa\KomentarController as MahasiswaKomentarController;

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

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/dashboard', function () {
    $role = auth()->user()->role ?? null;
    return match ($role) {
        'admin' => redirect()->route('admin.dashboard'),
        'dosen' => redirect()->route('dosen.dashboard'),
        'staff' => redirect()->route('staff.dashboard'),
        'mahasiswa' => redirect('/'), // Redirect to welcome page instead
        default => abort(403),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth', 'role:admin'])->get('/admin/dashboard', [DashboardController::class, 'index'])
    ->name('admin.dashboard');

Route::middleware(['auth', 'role:dosen'])->get('/dosen/dashboard', function () {
    return view('dosen.dashboard');
})->name('dosen.dashboard');

Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::resource('informasi', \App\Http\Controllers\Dosen\InformasiController::class);
    Route::resource('agenda', \App\Http\Controllers\Dosen\AgendaController::class);
    Route::get('view-informasi/{id}', [\App\Http\Controllers\Dosen\InformasiController::class, 'viewPublished'])->name('view.informasi');
    Route::resource('komentar', \App\Http\Controllers\Dosen\KomentarController::class)->only(['store']);
});

Route::middleware(['auth', 'role:staff'])->get('/staff/dashboard', function () {
    return view('staff.dashboard'); // akan SB Admin 2
})->name('staff.dashboard');

Route::middleware(['auth', 'role:mahasiswa'])->get('/landing', function () {
    return view('mahasiswa.landing'); // hanya tampilan landing page
})->name('mahasiswa.landing');

Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::resource('informasi', MahasiswaInformasiController::class)->only(['index', 'show']);
    Route::resource('komentar', MahasiswaKomentarController::class)->only(['store', 'destroy']);
});

Route::middleware(['auth', 'role:mahasiswa'])->get('/informasi', function () {
    return redirect()->route('mahasiswa.informasi.index');
})->name('mahasiswa.informasi');

Route::middleware(['auth', 'role:mahasiswa'])->get('/agenda', function () {
    return view('mahasiswa.agenda', [
        'dataAgenda' => \App\Models\Agenda::latest()->get()
    ]);
})->name('mahasiswa.agenda');

Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('informasi', InformasiController::class);
    Route::resource('agenda', AgendaController::class);
    Route::resource('kategori-agenda', KategoriAgendaController::class);
    Route::resource('komentar', KomentarController::class)->only(['index', 'store', 'destroy']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

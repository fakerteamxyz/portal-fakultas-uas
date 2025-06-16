<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\InformasiController;
use App\Http\Controllers\Admin\KategoriAgendaController;
use App\Http\Controllers\Admin\KomentarController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JadwalAkademikController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\Mahasiswa\InformasiController as MahasiswaInformasiController;
use App\Http\Controllers\Mahasiswa\KomentarController as MahasiswaKomentarController;
use App\Http\Controllers\Mahasiswa\JadwalAkademikController as MahasiswaJadwalAkademikController;
use App\Http\Controllers\Staff\AgendaController as StaffAgendaController;
use App\Http\Controllers\Staff\InformasiController as StaffInformasiController;
use App\Http\Controllers\Staff\KomentarController as StaffKomentarController;

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

// Public informasi
Route::get('/informasi/{id}', [\App\Http\Controllers\Public\InformasiController::class, 'show'])->name('public.informasi.show');

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

Route::middleware(['auth', 'role:dosen'])->get('/dosen/dashboard', [\App\Http\Controllers\Dosen\DashboardController::class, 'index'])->name('dosen.dashboard');

Route::middleware(['auth', 'role:dosen'])->prefix('dosen')->name('dosen.')->group(function () {
    Route::resource('informasi', \App\Http\Controllers\Dosen\InformasiController::class);
    Route::get('informasi/{id}/download', [\App\Http\Controllers\Dosen\InformasiController::class, 'download'])->name('informasi.download');
    Route::resource('agenda', \App\Http\Controllers\Dosen\AgendaController::class);
    Route::get('view-informasi/{id}', [\App\Http\Controllers\Dosen\InformasiController::class, 'viewPublished'])->name('view.informasi');
    Route::resource('komentar', \App\Http\Controllers\Dosen\KomentarController::class)->only(['store']);
    Route::resource('downloads', \App\Http\Controllers\Dosen\DownloadController::class);
    Route::get('downloads/{id}/download', [\App\Http\Controllers\Dosen\DownloadController::class, 'downloadFile'])->name('downloads.download');
});

Route::middleware(['auth', 'role:staff'])->get('/staff/dashboard', [\App\Http\Controllers\Staff\DashboardController::class, 'index'])->name('staff.dashboard');

Route::middleware(['auth', 'role:staff'])->prefix('staff')->name('staff.')->group(function () {
    Route::resource('agenda', StaffAgendaController::class);
    Route::resource('informasi', StaffInformasiController::class);
    Route::resource('komentar', StaffKomentarController::class)->only(['store', 'destroy']);
    Route::get('list-agenda', [StaffAgendaController::class, 'listAgenda'])->name('agenda.list');
    Route::get('list-informasi', [StaffInformasiController::class, 'listInformasi'])->name('informasi.list');
    Route::resource('downloads', \App\Http\Controllers\Staff\DownloadController::class);
    Route::get('downloads/{id}/download', [\App\Http\Controllers\Staff\DownloadController::class, 'downloadFile'])->name('downloads.download');
});

Route::middleware(['auth', 'role:mahasiswa'])->get('/landing', [\App\Http\Controllers\Mahasiswa\LandingController::class, 'index'])->name('mahasiswa.landing');

Route::middleware(['auth', 'role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
    Route::resource('informasi', MahasiswaInformasiController::class)->only(['index', 'show']);
    Route::get('informasi/{id}/download', [MahasiswaInformasiController::class, 'download'])->name('informasi.download');
    Route::resource('komentar', MahasiswaKomentarController::class)->only(['store', 'destroy']);
    Route::get('jadwal-akademik', [MahasiswaJadwalAkademikController::class, 'index'])->name('jadwal-akademik.index');
    Route::get('jadwal-akademik/{jadwalAkademik}/download', [MahasiswaJadwalAkademikController::class, 'download'])->name('jadwal-akademik.download');
    // Download Center Routes
    Route::get('downloads', [\App\Http\Controllers\Mahasiswa\DownloadController::class, 'index'])->name('downloads.index');
    Route::get('downloads/{id}', [\App\Http\Controllers\Mahasiswa\DownloadController::class, 'show'])->name('downloads.show');
    Route::get('downloads/{id}/download', [\App\Http\Controllers\Mahasiswa\DownloadController::class, 'downloadFile'])->name('downloads.download');
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
    Route::resource('jadwal-akademik', \App\Http\Controllers\Admin\JadwalAkademikController::class);
    Route::resource('downloads', \App\Http\Controllers\Admin\DownloadController::class);
    Route::resource('download-categories', \App\Http\Controllers\Admin\DownloadCategoryController::class)->names('download-categories');
    Route::get('downloads/{id}/download', [\App\Http\Controllers\Admin\DownloadController::class, 'downloadFile'])->name('downloads.download');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

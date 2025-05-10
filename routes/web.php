<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
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

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

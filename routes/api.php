<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InformasiApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// API v1 Routes
Route::prefix('v1')->group(function () {
    // Public routes - Information API
    Route::get('/informasi/calendar', [InformasiApiController::class, 'calendar']);
    Route::get('/informasi/latest', [InformasiApiController::class, 'latest']);
    Route::get('/informasi/{id}', [InformasiApiController::class, 'show']);
    
    // Public routes - Agenda API
    Route::get('/agenda/calendar', [\App\Http\Controllers\Api\AgendaApiController::class, 'calendar']);
    Route::get('/agenda', [\App\Http\Controllers\Api\AgendaApiController::class, 'index']);
    Route::get('/agenda/{id}', [\App\Http\Controllers\Api\AgendaApiController::class, 'show']);
    
    // Combined Calendar API (optimized endpoint)
    Route::get('/calendar', [\App\Http\Controllers\Api\CalendarApiController::class, 'index']);
});

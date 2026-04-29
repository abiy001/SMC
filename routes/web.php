<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Root redirect ke login (bukan langsung dashboard)
Route::get('/', function () {
    return redirect()->route('login');
});

// ── Auth ──────────────────────────────────────────────────
Route::middleware('guest')->group(function () {
    Route::get('/login',  [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store']);   // ← ini yang hilang
});

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

// ── Teacher ───────────────────────────────────────────────
Route::middleware('auth')->prefix('teacher')->name('teacher.')->group(function () {
    Route::get('/', function () {
        return view('teacher.index'); // buat view ini
    })->name('index');
});

// ── Student ───────────────────────────────────────────────
Route::middleware('auth')->prefix('student')->name('student.')->group(function () {
    Route::get('/', function () {
        return view('student.index'); // buat view ini
    })->name('index');
});

// ── Waka ──────────────────────────────────────────────────
Route::middleware('auth')->prefix('waka')->name('waka.')->group(function () {
    Route::get('/', function () {
        return view('waka.index'); // buat view ini
    })->name('index');
});

// ── Admin (di-handle admin.php) ───────────────────────────
require __DIR__.'/admin.php';
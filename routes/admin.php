<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\WakaController;
use App\Http\Controllers\LeasonHourController;
use App\Http\Controllers\ReportLeasonController;
use App\Http\Controllers\SubjectController;
use App\Exports\TemplateExport;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
use Maatwebsite\Excel\Facades\Excel;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'admin'])   // ← tambah ini
    ->group(function () {

   // ── Dashboard ──────────────────────────────────────────

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
   

    // ── Profile (dropdown) ─────────────────────────────────
    Route::get('/profile',   [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile',[ProfileController::class, 'destroy'])->name('profile.destroy');

    // ── Account Settings ───────────────────────────────────
    Route::get('/settings',  [ProfileController::class, 'settings'])->name('settings');

    // ── Waka ───────────────────────────────────────────────
    Route::resource('waka', WakaController::class)->except(['show']);
    Route::post('/waka/import',  [WakaController::class, 'import'])->name('waka.import');
    Route::get('/waka/template', function () {
        return Excel::download(new TemplateExport(['nama', 'email', 'no_telepon']), 'template-waka.xlsx');
    })->name('waka.template');

    // ── Teacher ────────────────────────────────────────────
    Route::resource('teachers', TeacherController::class)->except(['show']);
    Route::post('/teachers/import',  [TeacherController::class, 'import'])->name('teachers.import');
    Route::get('/teachers/template', function () {
        return Excel::download(new TemplateExport(['nama', 'email', 'nip', 'no_telepon']), 'template-teacher.xlsx');
    })->name('teachers.template');

    // ── Student ────────────────────────────────────────────
    Route::resource('students', StudentController::class)->except(['show']);
    Route::post('/students/import',  [StudentController::class, 'import'])->name('students.import');
    Route::get('/students/template', function () {
        return Excel::download(new TemplateExport(['nama', 'email', 'nisn', 'no_telepon']), 'template-student.xlsx');
    })->name('students.template');

    // ── Kelas ──────────────────────────────────────────────
    Route::resource('classes', ClassesController::class)->except(['show']);

    // ── Subject ────────────────────────────────────────────
    Route::resource('subjects', SubjectController::class)->except(['show']);

    // ── Schedule ───────────────────────────────────────────
    Route::get('/schedule',         [LeasonHourController::class, 'index'])->name('schedule.index');
    Route::get('/schedule/events',  [LeasonHourController::class, 'events'])->name('schedule.events');
    Route::post('/schedule',        [LeasonHourController::class, 'store'])->name('schedule.store');
    Route::put('/schedule/{id}',    [LeasonHourController::class, 'update'])->name('schedule.update');
    Route::delete('/schedule/{id}', [LeasonHourController::class, 'destroy'])->name('schedule.destroy');

    // ── Lisensi ────────────────────────────────────────────
    Route::get('/lisensi', function () {
        return view('admin.pages.lisensi.index');
    })->name('lisensi.index');

    // ── Report ─────────────────────────────────────────────
    Route::get('/report',              [ReportLeasonController::class, 'index'])->name('report.index');
    Route::get('/report/teacher/{id}', [ReportLeasonController::class, 'getTeacherReport'])->name('report.teacher');


     
 
// Setting
Route::get('/admin/settings', [SettingController::class, 'index'])->name('admin.settings.index');
Route::post('/admin/settings', [SettingController::class, 'update'])->name('admin.settings.update');
 
});
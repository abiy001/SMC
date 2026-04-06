<?php 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WakaController;

Route::get('/waka/monitoring', function (){
    return view('waka.monitoring');
});

Route::get('/waka/dashboard-waka', function(){
    return view('waka.pages.dashboard-waka', ['title' => 'Dashboard Waka']);
})->name('dashboard-waka');

Route::get('/waka/jadwal', function(){
    return view('waka.pages.jadwal', ['title' => 'Jadwal']);
})->name('jadwal');

Route::get('/waka/rekap', [WakaController::class, 'index'])
    ->name('waka.rekap');

?>
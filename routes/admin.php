<?php

// use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// dashboard pages
Route::get('/', function () {
    return view('admin.pages.dashboard', ['title' => 'E-commerce Dashboard']);
})->name('dashboard');
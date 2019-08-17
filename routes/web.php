<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/dashboard', DashboardController::class)->name('dashboard');
Route::get('/stations', [\App\Http\Controllers\StationsController::class, 'index'])->name('stations');


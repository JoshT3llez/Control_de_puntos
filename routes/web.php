<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WorkOrderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ValvulasController;
use App\Http\Controllers\MapController;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/registers', function () {
    return view('auth.register');
});

Auth::routes();


Route::resource('work_orders', WorkOrderController::class)->middleware('auth');


Route::resource('valvulas', ValvulasController::class)->middleware('auth');


Route::get('/mapa', [MapController::class, 'index'])->name('mapa')->middleware('auth');




Route::get('/valvulas/{id}/export-pdf', [ValvulasController::class, 'exportPDF'])->name('valvulas.exportPDF');

// Ruta para generar imagen de mapa
Route::get('/valvulas/generate-map', [ValvulasController::class, 'generateMapImage'])->name('valvulas.generateMapImage')->middleware('auth');
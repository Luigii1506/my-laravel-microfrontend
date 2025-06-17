<?php

use Illuminate\Support\Facades\Route;

// Ruta para la página principal del dashboard
Route::get('/', function () {
    return view('welcome'); // Laravel por defecto tiene una vista 'welcome'
});

// Ruta genérica para las aplicaciones de Single-SPA.
// Esta ruta servirá la vista del shell de Single-SPA cuando el path sea /app o /app/loquequieras
Route::get('/app/{any?}', function () {
    return view('dashboard-shell');
})->where('any', '.*');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BusController;
use App\Http\Controllers\EtudiantController;
use App\Http\Controllers\ReclamationController;
use App\Http\Controllers\StationController;
use App\Http\Controllers\TaxiController;
use App\Models\Station;

Route::get('/', function () {
    return view('welcome');
});
Route::resource('buses', BusController::class);
Route::resource('stations', StationController::class);
Route::resource('etudiants', EtudiantController::class);
Route::resource('taxis', TaxiController::class);
Route::resource('reclamations', ReclamationController::class);


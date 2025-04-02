<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChamadoController;

Route::get('/', function () {
    return view('home');
});

Route::resource('chamados', ChamadoController::class);
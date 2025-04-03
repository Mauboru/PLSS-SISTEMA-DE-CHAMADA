<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChamadoController;
use App\Models\Chamado;
use App\Models\Categoria;

Route::get('/', function () {
    $categorias = Categoria::with('chamados')->get();
    $totalChamados = Chamado::count();
    $chamadosNoPrazo = Chamado::whereColumn('data_solucao', '<=', 'prazo_solucao')->count();
    $chamadosForaPrazo = Chamado::whereColumn('data_solucao', '>', 'prazo_solucao')->count();

    return view('home', compact('categorias', 'totalChamados', 'chamadosNoPrazo', 'chamadosForaPrazo'));
});

Route::resource('chamados', ChamadoController::class);
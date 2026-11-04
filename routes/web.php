<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtividadeController;
use App\Http\Controllers\RelatorioController;

Route::get('/', [AtividadeController::class, 'dashboard'])
    ->name('dashboard');

Route::resource('atividades', AtividadeController::class)
    ->except(['show']);

Route::get('/relatorios', [RelatorioController::class, 'index'])
    ->name('relatorios.index');

Route::get('/relatorios/gerar', [RelatorioController::class, 'gerar'])
    ->name('relatorios.gerar');
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AtividadeController;

Route::get('/', [AtividadeController::class, 'dashboard'])
    ->name('dashboard');

Route::resource('atividades', AtividadeController::class)
    ->except(['show']);

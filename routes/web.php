<?php

use App\Http\Controllers\AtividadeController;

Route::get('/atividades', [AtividadeController::class, 'index']);

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AtividadeController extends Controller
{
    public function index()
    {
        return view('atividades.index');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Atividade extends Model
{
    protected $fillable = [
        'data',
        'inicio',
        'fim',
        'usuario',
        'descricao',
        'solucao',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'date',
        ];
    }
}

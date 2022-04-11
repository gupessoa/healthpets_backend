<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $table = 'consultas';

    protected $fillable =[
        'nome',
        'cep',
        'logradouro',
        'numero',
        'bairro',
        'cidade',
        'uf',
        'pais',
    ];
}

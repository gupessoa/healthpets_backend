<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $table = 'locais';

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

    public function consultas()
    {
        return $this->hasMany(Consulta::class, 'id_local', 'id');
    }

    public function procedimentos()
    {
        return $this->hasMany(Procedimento::class, 'id_local', 'id');
    }
}

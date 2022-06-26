<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Info extends Model
{
    use HasFactory;

    protected $table = 'infos';

    protected $fillable = [
        'data',
        'descricao',
        'id_categoria',
        'id_subcategoria',
        'local',
        'valor',
        'hora',
        'alerta',
        'id_animal',
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consulta extends Model
{
    use HasFactory;

    protected $table = 'consultas';

    protected $fillable =[
        'descricao',
        'data',
        'horario',
        'id_animal',
        'id_local',
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class, 'id_animal', 'id');
    }
}

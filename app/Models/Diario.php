<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diario extends Model
{
    use HasFactory;

    protected $table = 'diarios';

    protected $fillable = [
        'peso',
        'humor',
        'descricao',
        'data',
        'foto',
        'id_animal'
    ];

    public function animal()
    {
        return $this->belongsTo(Animal::class,'id_animal','id');
    }
}

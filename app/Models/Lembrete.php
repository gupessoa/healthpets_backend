<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lembrete extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'data',
        'descricao',
        'hora',
        'id_user'
    ];
}

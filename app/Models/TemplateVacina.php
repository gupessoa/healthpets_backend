<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplateVacina extends Model
{
    use HasFactory;

    protected $table = 'template_vacinas';

    protected $fillable = [
        'nome',
        'frequencia',
        'periodo_frequencia',
    ];
}

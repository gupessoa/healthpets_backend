<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Despesa extends Model
{
    use HasFactory;

    protected $table = 'despesas';

    protected $fillable = [
        'descricao',
        'valor',
        'data',
        'dividido_por',
        'id_categoria',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class,'id_categoria','id');
    }

    //relacionamento muitos para muitos com animais
    public function animais()
    {
        return $this->belongsToMany(Animal::class, 'despesas_animais', 'id_despesa', 'id_animal');
    }
}

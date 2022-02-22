<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Especie extends Model
{
    use HasFactory;

    protected $table = 'especies';
    protected $fillable = ['descricao'];

    public function racas()
    {
        return $this->hasMany(Raca::class, 'raca_id', 'id');
    }

    public function animais()
    {
        return $this->hasMany(Animal::class, 'id_especie', 'id');
    }

}

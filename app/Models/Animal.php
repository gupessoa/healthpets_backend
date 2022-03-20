<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'animais';

    protected $fillable = [
        'nome',
        'data_nascimento',
        'foto',
        'id_raca'
    ];

    public function vacinas()
    {
        return $this->hasMany(Vacina::class, 'id_animal', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'animal_user', 'id_animal', 'id_user');
    }

    public function especie()
    {
        $this->belongsTo(Especie::class, 'id_especie', 'íd');
    }

    public function raca()
    {
        $this->belongsTo(Raca::class, 'id_raca', 'id');
    }
}

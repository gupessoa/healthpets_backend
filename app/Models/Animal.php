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
        'name',
        'birth_date',
        'photo',
    ];

    public function vacinas()
    {
        return $this->hasMany(Vacina::class, 'animal_id', 'id');
    }
}

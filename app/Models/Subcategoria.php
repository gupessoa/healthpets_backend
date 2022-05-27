<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategoria extends Model
{
    use HasFactory;

    protected $table = '';
    protected $fillable = ['nome'];

    public function Categoria()
    {
        $this->belongsTo(Categoria::class,'id_categoria','id');
    }
}

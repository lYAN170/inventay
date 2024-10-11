<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'nombre',
        'marca',
    ];

    public $timestamps = true;

    public function productos()
    {
        return $this->hasMany(Productos::class, 'categoria_id');
    }
}

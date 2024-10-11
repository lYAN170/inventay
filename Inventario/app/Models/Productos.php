<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productos extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'Codigo_serie',
        'Descripcion',
        'cantidad',
        'precio',
        'imagen',
        'categoria_id', // Make sure this matches your database column name
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'cantidad' => 'integer',
    ];

    public $timestamps = true;

    public function categoria()
    {
        return $this->belongsTo(Categorias::class, 'categoria_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'pedidos';
    protected $fillable = [
        'proveedor_id',
        'cotizacion_id',
        'producto',
        'descripcion',
        'precio_unitario',
        'cantidad',
        'fecha_pedido',
        'estado',
        'fecha_entrega',
    ];
    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class);
    }
    public function cotizacion()
    {
        return $this->belongsTo(Cotizacion::class);
    }
}
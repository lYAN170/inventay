<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pedidos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proveedor_id')->constrained('proveedores'); 
            $table->foreignId('cotizacion_id')->nullable()->constrained('cotizaciones'); 
            $table->string('producto'); 
            $table->string('descripcion')->nullable(); 
            $table->decimal('precio_unitario', 8, 2); 
            $table->integer('cantidad'); 
            $table->date('fecha_pedido');
            $table->string('estado')->default('Pendiente'); 
            $table->date('fecha_entrega')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pedidos');
    }
};

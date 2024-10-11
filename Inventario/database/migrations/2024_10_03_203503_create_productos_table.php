<?php

use App\Models\Categorias;
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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->string('Codigo_serie', 50)->nullable();
            $table->string('Descripcion', 120);
            $table->integer('cantidad');
            $table->decimal('precio', 8, 2);
            $table->string('imagen');
            $table->foreignId('categorias_id')->constrained('categorias');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};

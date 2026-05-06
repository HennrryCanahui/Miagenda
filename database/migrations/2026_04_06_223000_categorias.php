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
        Schema::create('categorias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('nombre', 255);
            $table->string('color', 7); 
            $table->string('icono')->nullable(); 
            $table->boolean('es_predefinida')->default(false); 
            $table->text('descripcion')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('usuario_id');
            $table->index('es_predefinida');
            $table->unique(['usuario_id', 'nombre']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categorias');
    }
};
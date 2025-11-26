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
        Schema::create('movimientos', function (Blueprint $table) {
            $table->id();
            $table->string('nro_lia');
            $table->foreign('nro_lia')->references('nro_lia')->on('elementos')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('usuarios')->onDelete('cascade');
            $table->enum('estado', ['ingresado', 'guardado', 'funcionando', 'dado de baja', 'prestado']);
            $table->string('ubicacion', 100)->nullable();
            $table->dateTime('fecha');
            $table->string('comentario', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimientos');
    }
};

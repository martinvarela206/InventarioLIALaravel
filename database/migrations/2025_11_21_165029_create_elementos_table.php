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
        Schema::create('elementos', function (Blueprint $table) {
            $table->string('nro_lia', 25)->primary();
            $table->string('nro_unsj', 25)->nullable();
            $table->enum('tipo', ['cpu', 'monitor', 'switch', 'router', 'impresora', 'teclado', 'mouse', 'proyector', 'otro']);
            $table->string('descripcion', 255)->nullable();
            $table->integer('cantidad')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elementos');
    }
};

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
        Schema::create('gimnastas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_g');
            $table->string('apellido_g');
            $table->date('fecha_n_g');
            $table->foreignId('paises_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gimnastas');
    }
};

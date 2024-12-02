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
        Schema::create('equipo_gimnasta', function (Blueprint $table) {
            $table->foreignId('equipo_id')->constrained()->onDelete('cascade'); //aqui van en singular por alguna razón
            $table->foreignId('gimnasta_id')->constrained()->onDelete('cascade');
            $table->boolean('alternate_g')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipo_gimnasta');
    }
};

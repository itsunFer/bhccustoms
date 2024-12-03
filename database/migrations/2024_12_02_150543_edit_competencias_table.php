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
        Schema::table('competencias', function (Blueprint $table) {
            $table->renameColumn('nombre_c', 'map');
            $table->dropColumn('tipo_c');
            $table->boolean('winners');
            $table->string('score');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('competencias', function (Blueprint $table) {
            $table->renameColumn('map', 'nombre_c');
            $table->integer('tipo_c');
            $table->dropColumn('winners');
        });
    }
};

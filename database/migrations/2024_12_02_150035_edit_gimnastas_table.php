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
        Schema::table('gimnastas', function (Blueprint $table) {
            $table->renameColumn('apellido_g', 'gametag');
            $table->dropColumn('fecha_n_g');
            $table->dropForeign(['paises_id']);
            $table->dropColumn('paises_id');
        });
    }
 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gimnastas', function (Blueprint $table) {
            $table->renameColumn('gametag', 'apellido_g');
            $table->date('fecha_n_g');
            $table->foreignId('paises_id')->constrained();
        });
    }
};

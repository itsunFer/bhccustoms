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
        Schema::table('scores', function (Blueprint $table) {
            $table->dropForeign(['gimnastas_id']);
            $table->dropForeign(['events_id']);
            $table->dropForeign(['rounds_id']);
            $table->dropForeign(['aparatos_id']);
            $table->dropForeign(['user_id']);
            
            $table->dropColumn('gimnastas_id');
            $table->dropColumn('events_id');
            $table->dropColumn('rounds_id');
            $table->dropColumn('aparatos_id');
            $table->dropColumn('difficulty_s');
            $table->dropColumn('execution_s');
            $table->dropColumn('deductions_s');
            $table->dropColumn('total_s');
            $table->dropColumn('user_id');

            $table->foreignId('competencias_id')->conntrained()->onDelete('cascade');
            $table->string('gametag');
            $table->boolean('winloss');
            $table->float('acs');
            $table->float('kills');
            $table->float('deaths');
            $table->float('assists');
            $table->float('dd');
            $table->float('adr');
            $table->float('hs');
            $table->float('kast');
            $table->float('fk');
            $table->float('fd');
            $table->float('rank');
            $table->float('plants');
            $table->float('defuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('scores', function (Blueprint $table) {
            $table->foreignId('gimnastas_id')->constrained()->onDelete('cascade');
            $table->foreignId('events_id')->constrained()->onDelete('cascade');
            $table->foreignId('rounds_id')->constrained();
            $table->foreignId('aparatos_id')->constrained();
            $table->float('difficulty_s', 6, 3);
            $table->float('execution_s', 6, 2);
            $table->float('deductions_s', 4, 2)->default(0.0);
            $table->float('total_s', 6, 3);
            $table->foreignId('user_id')->constrained('users');

            $table->dropColumn('competencias_id');
            $table->dropColumn('gametag');
            $table->dropColumn('W/L (0/1)');
            $table->dropColumn('acs');
            $table->dropColumn('kills');
            $table->dropColumn('deaths');
            $table->dropColumn('assists');
            $table->dropColumn('dd');
            $table->dropColumn('adr');
            $table->dropColumn('hs');
            $table->dropColumn('kast');
            $table->dropColumn('fk');
            $table->dropColumn('fd');
            $table->dropColumn('rank');
            $table->dropColumn('plants');
            $table->dropColumn('defuses');
        });
    }
};

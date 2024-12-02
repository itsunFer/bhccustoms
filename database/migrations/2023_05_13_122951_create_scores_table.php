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
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('gimnastas_id')->constrained()->onDelete('cascade');
            $table->foreignId('events_id')->constrained()->onDelete('cascade');
            $table->foreignId('rounds_id')->constrained();
            $table->foreignId('aparatos_id')->constrained();
            $table->float('difficulty_s', 6, 3);
            $table->float('execution_s', 6, 2);
            $table->float('deductions_s', 4, 2)->default(0.0);
            $table->float('total_s', 6, 3);
            $table->foreignId('user_id')->constrained('users');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scores');
    }
};

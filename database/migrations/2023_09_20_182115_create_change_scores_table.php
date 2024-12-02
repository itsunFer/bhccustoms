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
        Schema::create('change_scores', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('old_id');
            $table->unsignedBigInteger('new_id');

            $table->foreign('old_id')->references('id')->on('scores')->onDelete('cascade');
            $table->foreign('new_id')->references('id')->on('scores')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('change_scores');
    }
};

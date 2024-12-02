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
        Schema::table('comments', function (Blueprint $table) {
            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type');
            $table->dropForeign(['news_id']);
            $table->dropColumn('news_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            $table->dropColumn('commentable_id');
            $table->dropColumn('commentable_type');
            $table->unsignedBigInteger('news_id');

            $table->foreign('news_id')->references('id')->on('news')->ondelete('cascade');
        });
    }
};

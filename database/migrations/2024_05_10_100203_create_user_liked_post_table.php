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
        Schema::create('user_liked_post', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained(table: 'users', column: 'user_id')->cascadeOnDelete();
            $table->foreignId('post_id')->constrained(table: 'posts', column: 'post_id')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_liked_post');
    }
};

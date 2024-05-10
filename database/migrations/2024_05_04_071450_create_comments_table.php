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
        Schema::create('comments', function (Blueprint $table) {
            $table->id('comment_id');
            $table->foreignId('user_id')->constrained(table: 'users', column: 'user_id')->cascadeOnDelete();
            $table->foreignId('post_id')->constrained(table: 'posts', column: 'post_id')->cascadeOnDelete();
            $table->longText('comment');
            $table->bigInteger('id_comment_group');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

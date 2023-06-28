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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->index('post_id', 'likes_post_idx');
            $table->index('user_id', 'likes_user_idx');

            $table->foreign('post_id', 'likes_post_fk')->on('posts')->references('id');
            $table->foreign('user_id', 'likes_user_fk')->on('users')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};

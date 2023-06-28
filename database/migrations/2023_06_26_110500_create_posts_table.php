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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('content');
            $table->unsignedInteger('category_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

            $table->index('category_id', 'post_category_idx');
            $table->index('user_id', 'post_user_id_idx');

            $table->foreign('category_id', 'post_category_fk')->on('categories')->references('id');
            $table->foreign('user_id', 'post_user_id_fk')->on('users')->references('id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

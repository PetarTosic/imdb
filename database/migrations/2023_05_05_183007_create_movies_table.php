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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->uniqie();
            $table->integer('year');
            $table->integer('duration');
            $table->float('user_score');
            $table->integer('pegi');
            $table->text('image_url');
            $table->foreignId('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->longText('description');
            $table->date('published_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('cover_url', 2048)->nullable();
            $table->text('description')->nullable();
            $table->foreignId('author_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedInteger('pages')->nullable();
            $table->year('publication_year')->nullable();
            $table->foreignId('publisher_id')->nullable()->constrained()->cascadeOnDelete();
            $table->foreignId('genre_id')->nullable()->constrained()->cascadeOnDelete();
            $table->unsignedInteger('stock')->nullable();
            $table->boolean('active')->default(true);
            $table->string('ISBN')->unique()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};

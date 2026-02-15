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
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->longText('description');
            $table->text('developer');
            $table->string('platform');

            $table->unsignedInteger('stock');
            $table->decimal('price', 10, 2);
            $table->date('release_date')->nullable();
            $table->float('rating')->nullable();
            $table->string('cover')->nullable();
            
            // Field baru untuk game type dan URL/file hosting
            $table->enum('type', ['browser', 'download'])->default('browser')->comment('Tipe game: browser (iframe) atau download');
            $table->text('embed_url')->nullable()->comment('URL untuk iframe jika tipe browser');
            $table->string('file_path')->nullable()->comment('Path file untuk download jika tipe download');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('games');
    }
};

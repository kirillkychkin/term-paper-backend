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
        Schema::create('repositories', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->text('name');
            $table->text('url');
            $table->text('readme_text')->nullable();
            $table->string('readme_lang', length: 10)->nullable();
            $table->text('translated_readme_text')->nullable();
            $table->text('readme_russian')->nullable();
            $table->text('description')->nullable();
            $table->string('description_lang', length: 10)->nullable();
            $table->text('translated_description')->nullable();
            $table->text('description_russian')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repositories');
    }
};

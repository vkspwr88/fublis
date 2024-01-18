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
        Schema::create('press_releases', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('cover_image_path');
			$table->string('title');
			$table->string('image_credits')->nullable();
			$table->text('concept_note');
			$table->text('press_release_writeup');
			$table->text('press_release_doc_path')->nullable();
			$table->text('press_release_doc_link')->nullable();
			$table->text('photographs_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('press_releases');
    }
};

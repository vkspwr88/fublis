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
        Schema::create('articles', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('cover_image_path');
			$table->string('title');
			$table->string('text_credits');
			$table->text('preview_text');
			$table->text('article_doc_path')->nullable();
			$table->text('article_doc_link')->nullable();
			$table->text('article_writeup')->nullable();
			$table->text('company_profile_path')->nullable();
			$table->text('company_profile_link')->nullable();
			$table->text('images_link')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('articles');
    }
};

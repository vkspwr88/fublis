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
        Schema::table('journalists', function (Blueprint $table) {
            $table->text('published_article_link')->nullable()->change();
			$table->text('publishing_platform_link')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('journalists', function (Blueprint $table) {
            $table->text('published_article_link')->change();
			$table->text('publishing_platform_link')->change();
        });
    }
};

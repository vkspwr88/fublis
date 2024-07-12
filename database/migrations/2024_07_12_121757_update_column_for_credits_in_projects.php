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
        Schema::table('projects', function (Blueprint $table) {
            $table->text('image_credits')->nullable()->change();
			$table->text('text_credits')->nullable()->change();
			$table->text('render_credits')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->string('image_credits')->nullable()->change();
			$table->string('text_credits')->nullable()->change();
			$table->string('render_credits')->nullable()->change();
        });
    }
};

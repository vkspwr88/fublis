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
        Schema::create('email_preferences', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('key');
			$table->text('details');
			$table->enum('email_type', ['instant', 'daily', 'weekly', 'monthly']);
			$table->enum('email_for', ['architect', 'journalist', 'none']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_preferences');
    }
};

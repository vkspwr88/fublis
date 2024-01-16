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
        Schema::create('guests', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('name');
            $table->string('email');
            $table->string('password');
			$table->string('email_otp', 4)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('user_type')->default('architect');
            $table->string('google_id')->nullable();
            $table->string('ip_address');
            $table->timestamps();
		});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('guests');
    }
};

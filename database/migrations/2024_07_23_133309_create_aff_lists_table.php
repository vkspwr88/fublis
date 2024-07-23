<?php

use App\Models\AffRegistration;
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
        Schema::create('aff_lists', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(AffRegistration::class);
			$table->string('username')->unique();
			$table->string('return_type')->default('fixed');
			$table->double('return_value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aff_lists');
    }
};

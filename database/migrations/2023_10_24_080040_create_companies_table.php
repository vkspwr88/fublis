<?php

use App\Models;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('name')->unique();
			$table->string('website');
			$table->foreignIdFor(Models\Location::class);
			$table->foreignIdFor(Models\Category::class);
			$table->foreignIdFor(Models\TeamSize::class);
			$table->year('starting_year')->nullable();
			$table->string('twitter')->nullable();
			$table->string('facebook')->nullable();
			$table->string('instagram')->nullable();
			$table->string('linkedin')->nullable();
            $table->string('about_me')->nullable();
			$table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};

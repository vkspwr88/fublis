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
        Schema::create('architects', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(Models\User::class);
			$table->foreignIdFor(Models\Company::class);
			$table->foreignIdFor(Models\ArchitectPosition::class);
			$table->foreignIdFor(Models\Location::class)->nullable();
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
        Schema::dropIfExists('architects');
    }
};

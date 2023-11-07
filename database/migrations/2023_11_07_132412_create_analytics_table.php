<?php

use App\Models\Journalist;
use App\Models\MediaKit;
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
        Schema::create('analytics', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(MediaKit::class);
			$table->foreignIdFor(Journalist::class);
			$table->uuidMorphs('data');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('analytics');
    }
};

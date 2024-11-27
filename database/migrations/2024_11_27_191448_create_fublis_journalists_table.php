<?php

use App\Models\Journalist;
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
        Schema::create('fublis_journalists', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(Journalist::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fublis_journalists');
    }
};

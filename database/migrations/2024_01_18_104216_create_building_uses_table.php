<?php

use App\Models\BuildingTypology;
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
        Schema::create('building_uses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->foreignIdFor(BuildingTypology::class);
			$table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('building_uses');
    }
};

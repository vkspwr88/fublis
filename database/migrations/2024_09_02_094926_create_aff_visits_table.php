<?php

use App\Models\AffList;
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
        Schema::create('aff_visits', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(AffList::class);
			$table->string('campaign')->nullable();
			$table->string('ip_address')->nullable();
			$table->boolean('is_converted')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aff_visits');
    }
};

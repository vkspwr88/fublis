<?php

use App\Models\Architect;
use App\Models\Call;
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
        Schema::create('call_views', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(Call::class);
			$table->foreignIdFor(Architect::class, 'view_by');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('call_views');
    }
};

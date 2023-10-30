<?php

use App\Models\Journalist;
use App\Models\Publication;
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
        Schema::create('journalist_publications', function (Blueprint $table) {
            $table->foreignIdFor(Journalist::class);
            $table->foreignIdFor(Publication::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journalist_publications');
    }
};

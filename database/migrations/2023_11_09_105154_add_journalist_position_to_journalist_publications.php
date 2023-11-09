<?php

use App\Models\JournalistPosition;
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
        Schema::table('journalist_publications', function (Blueprint $table) {
            $table->foreignIdFor(JournalistPosition::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('journalist_publications', function (Blueprint $table) {
            $table->dropColumn('journalist_position_id');
        });
    }
};

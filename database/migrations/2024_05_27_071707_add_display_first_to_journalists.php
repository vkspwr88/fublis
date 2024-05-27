<?php

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
        Schema::table('journalists', function (Blueprint $table) {
            $table->smallInteger('display_first')->default(999)->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('journalists', function (Blueprint $table) {
            $table->dropColumn('display_first');
        });
    }
};

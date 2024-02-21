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
        Schema::table('locations', function (Blueprint $table) {
            $table->boolean('city_flag')->default(true)->after('name');
            $table->boolean('state_flag')->default(false)->after('name');
            $table->boolean('country_flag')->default(false)->after('name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {
            $table->dropColumn('city_flag');
            $table->dropColumn('state_flag');
            $table->dropColumn('country_flag');
        });
    }
};

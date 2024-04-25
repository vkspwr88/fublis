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
        Schema::table('architects', function (Blueprint $table) {
            $table->string('foreground_color')->nullable()->after('about_me')->default('#FFFFFF');
            $table->string('background_color')->nullable()->after('about_me')->default('#000000');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('architects', function (Blueprint $table) {
            $table->dropColumn('foreground_color');
            $table->dropColumn('background_color');
        });
    }
};

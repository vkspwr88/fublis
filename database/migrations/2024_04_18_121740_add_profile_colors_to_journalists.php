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
            $table->string('foreground_color')->nullable()->after('about_me');
            $table->string('background_color')->nullable()->after('about_me');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('journalists', function (Blueprint $table) {
            $table->dropColumn('foreground_color');
            $table->dropColumn('background_color');
        });
    }
};

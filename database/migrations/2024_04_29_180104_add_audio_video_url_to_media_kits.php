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
        Schema::table('media_kits', function (Blueprint $table) {
            $table->text('audio_video_url')->nullable()->after('architect_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media_kits', function (Blueprint $table) {
            $table->dropColumn('audio_video_url');
        });
    }
};

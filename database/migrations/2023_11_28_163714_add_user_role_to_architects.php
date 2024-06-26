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
            $table->string('user_role')->default('super_admin')->after('company_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('architects', function (Blueprint $table) {
            $table->dropColumn('user_role');
        });
    }
};

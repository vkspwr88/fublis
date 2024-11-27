<?php

use App\Models\MediaKit;
use App\Models\User;
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
        Schema::create('download_request_schedules', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(User::class);
			$table->foreignIdFor(MediaKit::class);
			$table->dateTime('schedule_at');
			$table->boolean('is_mail_sent')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('download_request_schedules');
    }
};

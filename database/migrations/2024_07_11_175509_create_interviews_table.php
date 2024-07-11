<?php

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
        Schema::create('interviews', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(User::class);
			$table->string('slug')->unique();
			$table->text('heading');
			$table->text('description');
			$table->boolean('final_submission')->default(false);
			$table->string('profile_pic_path')->nullable();
			$table->dateTime('submission_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};

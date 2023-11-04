<?php

use App\Models\Journalist;
use App\Models\MediaKit;
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
        Schema::create('pitches', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(Journalist::class);
			$table->foreignIdFor(MediaKit::class);
			$table->string('subject');
			$table->text('message');
			$table->uuidMorphs('pitchable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pitches');
    }
};

<?php

use App\Models;
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
        Schema::create('calls', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(Models\Journalist::class);
			$table->foreignIdFor(Models\Category::class);
			$table->string('title');
			$table->text('description');
			$table->foreignIdFor(Models\Location::class);
			$table->foreignIdFor(Models\Publication::class);
			$table->foreignIdFor(Models\Language::class);
			$table->foreignIdFor(Models\PublishFrom::class);
			$table->date('submission_end_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calls');
    }
};

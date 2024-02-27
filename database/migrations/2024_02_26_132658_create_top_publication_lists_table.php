<?php

use App\Models\Publication;
use App\Models\TopPublication;
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
        Schema::create('top_publication_lists', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(TopPublication::class);
			$table->foreignIdFor(Publication::class);
			$table->smallInteger('rank_order')->default(100);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_publication_lists');
    }
};

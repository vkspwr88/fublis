<?php

use App\Models\Category;
use App\Models\Location;
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
        Schema::create('top_journalists', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('list_type');
			$table->foreignIdFor(Category::class);
			$table->string('category_slug');
			$table->foreignIdFor(Location::class);
			$table->string('location_slug');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_journalists');
    }
};

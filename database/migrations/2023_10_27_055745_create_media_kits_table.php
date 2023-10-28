<?php

use App\Models\Architect;
use App\Models\Category;
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
        Schema::create('media_kits', function (Blueprint $table) {
            $table->uuid('id');
			$table->foreignIdFor(Architect::class);
			$table->uuidMorphs('story');
			$table->foreignIdFor(Category::class);
            $table->timestamps();
			$table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_kits');
    }
};

<?php

use App\Models\Architect;
use App\Models\Category;
use App\Models\ProjectAccess;
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
            $table->uuid('id')->primary();
			$table->foreignIdFor(Architect::class);
			$table->uuidMorphs('story');
			$table->foreignIdFor(Category::class);
			$table->foreignIdFor(Architect::class, 'media_contact_id');
			$table->foreignIdFor(ProjectAccess::class);
            
            $table->timestamps();
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

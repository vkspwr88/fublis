<?php

use App\Models\Architect;
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
        Schema::create('media_kit_drafts', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(Architect::class);
			$table->enum('media_kit_type', ['press-release', 'project', 'article']);
			$table->longText('content');
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media_kit_drafts');
    }
};

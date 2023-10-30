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
        Schema::create('journalists', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(Models\User::class);
			$table->foreignIdFor(Models\JournalistPosition::class);
			$table->text('linked_profile');
			$table->text('published_article_link');
			$table->text('publishing_platform_link');
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journalists');
    }
};

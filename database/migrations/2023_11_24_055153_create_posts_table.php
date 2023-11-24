<?php

use App\Models\Category;
use App\Models\Journalist;
use App\Models\Publication;
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
        Schema::create('posts', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(Journalist::class);
			$table->enum('story_type', ['Press Release', 'Article', 'Project']);
			$table->foreignIdFor(Category::class);
			$table->foreignIdFor(Publication::class);
			$table->text('post_url');
			$table->text('meta_title');
			$table->text('meta_content');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};

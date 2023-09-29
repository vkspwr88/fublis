<?php

use Awcodes\Curator\Models\Media;
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
        Schema::create('blogs', function (Blueprint $table) {
            $table->uuid('id');
			$table->string('title');
			$table->string('slug')->unique();
			$table->text('description');
			$table->string('author');
			$table->date('published_date');
			$table->longText('body');
			$table->foreignIdFor(Media::class, 'home_image_id');
			$table->foreignIdFor(Media::class, 'banner_image_id');
            $table->timestamps();
			$table->softDeletes();

			$table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};

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
        Schema::create('projects', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('title');
			$table->double('site_area')->nullable();
			$table->foreignIdFor(Models\Area::class, 'site_area_id')->nullable();
			$table->double('built_up_area')->nullable();
			$table->foreignIdFor(Models\Area::class, 'built_up_area_id')->nullable();
			$table->foreignIdFor(Models\Location::class);
			$table->foreignIdFor(Models\ProjectStatus::class);
			$table->string('materials')->nullable();
			$table->foreignIdFor(Models\BuildingUse::class)->nullable();
			$table->string('image_credits')->nullable();
			$table->string('text_credits')->nullable();
			$table->string('render_credits')->nullable();
			$table->text('consultants')->nullable();
			$table->text('design_team')->nullable();
			$table->text('cover_image_path');
			$table->text('project_brief');
			$table->text('project_doc_path')->nullable();
			$table->text('project_doc_link')->nullable();
			/* $table->foreignIdFor(Models\Architect::class, 'media_contact_id');
			$table->foreignIdFor(Models\ProjectAccess::class); */
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};

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
			$table->double('site_area');
			$table->foreignIdFor(Models\Area::class, 'site_area_id');
			$table->double('built_up_area');
			$table->foreignIdFor(Models\Area::class, 'built_up_area_id');
			$table->foreignIdFor(Models\Location::class);
			$table->foreignIdFor(Models\ProjectStatus::class);
			$table->string('materials');
			$table->foreignIdFor(Models\BuildingTypology::class);
			$table->string('image_credits');
			$table->string('text_credits');
			$table->string('render_credits');
			$table->text('consultants');
			$table->text('design_team');
			$table->text('cover_image_path');
			$table->text('project_brief');
			$table->text('project_doc_path')->nullable();
			$table->text('project_doc_link')->nullable();
			$table->foreignIdFor(Models\Architect::class, 'media_contact_id');
			$table->foreignIdFor(Models\ProjectAccess::class);
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

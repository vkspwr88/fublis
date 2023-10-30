<?php

use App\Models\Publication;
use App\Models\PublicationType;
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
        Schema::create('publication_publication_types', function (Blueprint $table) {
            $table->foreignIdFor(Publication::class);
			$table->foreignIdFor(PublicationType::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_publication_types');
    }
};

<?php

use App\Models\Publication;
use App\Models\PublishFrom;
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
        Schema::create('publication_publish_froms', function (Blueprint $table) {
            $table->foreignIdFor(Publication::class);
			$table->foreignIdFor(PublishFrom::class);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication_publish_froms');
    }
};

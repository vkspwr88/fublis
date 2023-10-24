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
        Schema::create('architects', function (Blueprint $table) {
            $table->uuid('id');
			$table->foreignIdFor(Models\User::class);
			$table->foreignIdFor(Models\Company::class);
			$table->foreignIdFor(Models\ArchitectPosition::class);
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
        Schema::dropIfExists('architects');
    }
};

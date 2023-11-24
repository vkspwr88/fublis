<?php

use App\Models\User;
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
        Schema::create('invite_colleagues', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->foreignIdFor(User::class, 'invited_by');
			$table->string('name');
			$table->string('email');
			$table->text('message');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invite_colleagues');
    }
};

<?php

use App\Models\AffVisit;
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
        Schema::create('aff_referrals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(User::class);
			$table->foreignIdFor(AffVisit::class);
			$table->double('earned_amount')->default(0);
			$table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aff_referrals');
    }
};

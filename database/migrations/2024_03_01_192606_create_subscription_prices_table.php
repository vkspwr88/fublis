<?php

use App\Models\SubscriptionPlan;
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
        Schema::create('subscription_prices', function (Blueprint $table) {
            $table->uuid('id')->primary();
			$table->string('slug')->unique();
			$table->foreignIdFor(SubscriptionPlan::class);
			$table->string('plan_type')->default('monthly');
			$table->double('price_per_month');
			$table->tinyInteger('quantity');
			$table->string('price_id');
            $table->timestamps();
			$table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscription_prices');
    }
};

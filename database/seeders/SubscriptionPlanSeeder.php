<?php

namespace Database\Seeders;

use App\Enums\Users\Architects\SubscriptionPlanTypeEnum;
use App\Models\SubscriptionPlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'slug' => 'essential-monthly-usd',
				'currency' => 'USD',
				'symbol' => '$',
				'plan_name' => 'Essential Monthly',
				'plan_type' => SubscriptionPlanTypeEnum::MONTHLY,
				'plan_id' => 'prod_QXRuZPS0DGc7fZ',
				'price_id' => 'price_1PgN0cSD3swwfNYOPozK2E2O',
				'price_per_month' => 349,
				'actual_price' => 700,
				'discount_percentage' => 50,
				'quantity' => 1,
			],
			[
				'slug' => 'essential-annual-usd',
				'currency' => 'USD',
				'symbol' => '$',
				'plan_name' => 'Essential Annual',
				'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
				'plan_id' => 'prod_QXRyGXXX04tEMq',
				'price_id' => 'price_1PgN4WSD3swwfNYOEmhFYlLy',
				'price_per_month' => 199,
				'actual_price' => 700,
				'discount_percentage' => 72,
				'quantity' => 12,
			],
			[
				'slug' => 'business-annual-usd',
				'currency' => 'USD',
				'symbol' => '$',
				'plan_name' => 'Business Annual',
				'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
				'plan_id' => 'prod_QXS1H0oRsvE37q',
				'price_id' => 'price_1PgN7WSD3swwfNYOMQmuciM6',
				'price_per_month' => 399,
				'actual_price' => 1600,
				'discount_percentage' => 75,
				'quantity' => 12,
			],
			[
				'slug' => 'essential-monthly-eur',
				'currency' => 'EUR',
				'symbol' => '€',
				'plan_name' => 'Essential Monthly',
				'plan_type' => SubscriptionPlanTypeEnum::MONTHLY,
				'plan_id' => 'prod_QXTgSECOhyqj6b',
				'price_id' => 'price_1PgOigSD3swwfNYO3GPCS3E5',
				'price_per_month' => 329,
				'actual_price' => 660,
				'discount_percentage' => 50,
				'quantity' => 1,
			],
			[
				'slug' => 'essential-annual-eur',
				'currency' => 'EUR',
				'symbol' => '€',
				'plan_name' => 'Essential Annual',
				'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
				'plan_id' => 'prod_QXTiM0LDwCLgfA',
				'price_id' => 'price_1PgOlCSD3swwfNYOQ8wdhRGh',
				'price_per_month' => 189,
				'actual_price' => 660,
				'discount_percentage' => 72,
				'quantity' => 12,
			],
			[
				'slug' => 'business-annual-eur',
				'currency' => 'EUR',
				'symbol' => '€',
				'plan_name' => 'Business Annual',
				'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
				'plan_id' => 'prod_QXTlH0kws6xVer',
				'price_id' => 'price_1PgOnWSD3swwfNYOY2G7VCc0',
				'price_per_month' => 369,
				'actual_price' => 1500,
				'discount_percentage' => 75,
				'quantity' => 12,
			],
			[
				'slug' => 'essential-monthly-inr',
				'currency' => 'INR',
				'symbol' => '₹',
				'plan_name' => 'Essential Monthly',
				'plan_type' => SubscriptionPlanTypeEnum::MONTHLY,
				'plan_id' => 'prod_QXRTUob86tS2Bo',
				'price_id' => 'price_1PgMaiSD3swwfNYOCtkwP6GS',
				'price_per_month' => 24999,
				'actual_price' => 50000,
				'discount_percentage' => 50,
				'quantity' => 1,
			],
			[
				'slug' => 'essential-annual-inr',
				'currency' => 'INR',
				'symbol' => '₹',
				'plan_name' => 'Essential Annual',
				'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
				'plan_id' => 'prod_QXRla3HhnhdVd9',
				'price_id' => 'price_1PgMrrSD3swwfNYOdGv7quQF',
				'price_per_month' => 14999,
				'actual_price' => 50000,
				'discount_percentage' => 70,
				'quantity' => 12,
			],
			[
				'slug' => 'business-annual-inr',
				'currency' => 'INR',
				'symbol' => '₹',
				'plan_name' => 'Business Annual',
				'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
				'plan_id' => 'prod_QXRpoJhC0mUKTZ',
				'price_id' => 'price_1PgMveSD3swwfNYOR2eJ7LcM',
				'price_per_month' => 32999,
				'actual_price' => 130000,
				'discount_percentage' => 75,
				'quantity' => 12,
			],
		];

		foreach($data as $row){
			SubscriptionPlan::create($row);
		}
    }
}

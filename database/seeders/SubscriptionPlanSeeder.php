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
				'slug' => 'business-plan-annually',
				'currency' => 'USD',
				'symbol' => '$',
				'plan_name' => 'Fublis Business Plan Annual',
				'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
				'plan_id' => 'prod_Q4nvz5sUZxXcgX',
				'price_id' => 'price_1PEeJYSF38t8VQrgfXOKVCYd',
				'price_per_month' => 299,
				'quantity' => 12,
			],
			[
				'slug' => 'enterprise-plan-annually',
				'currency' => 'USD',
				'symbol' => '$',
				'plan_name' => 'Fublis Enterprise Plan Annual',
				'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
				'plan_id' => 'prod_Q4nuo8BAPsJyVY',
				'price_id' => 'price_1PEeIYSF38t8VQrg3dU38wKu',
				'price_per_month' => 349,
				'quantity' => 12,
			],
			[
				'slug' => 'business-plan-quarterly',
				'currency' => 'USD',
				'symbol' => '$',
				'plan_name' => 'Fublis Business Plan Quarterly',
				'plan_type' => SubscriptionPlanTypeEnum::QUARTERLY,
				'plan_id' => 'prod_Q4npq2ERpBEekb',
				'price_id' => 'price_1PEeDSSF38t8VQrgwgpefFRt',
				'price_per_month' => 449,
				'quantity' => 3,
			],
			[
				'slug' => 'enterprise-plan-quarterly',
				'currency' => 'USD',
				'symbol' => '$',
				'plan_name' => 'Fublis Enterprise Plan Quarterly',
				'plan_type' => SubscriptionPlanTypeEnum::QUARTERLY,
				'plan_id' => 'prod_Q4njxbL0B3bDpi',
				'price_id' => 'price_1PEe7zSF38t8VQrgoB1H4fkB',
				'price_per_month' => 499,
				'quantity' => 3,
			],

			[
				'slug' => 'business-plan-annually-inr',
				'currency' => 'INR',
				'symbol' => '₹',
				'plan_name' => 'Fublis Business Plan Annual',
				'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
				'plan_id' => 'prod_Q4ny3KlIL7WAgX',
				'price_id' => 'price_1PEeMjSF38t8VQrgcCfGfFpm',
				'price_per_month' => 24900,
				'quantity' => 12,
			],
			[
				'slug' => 'enterprise-plan-annually-inr',
				'currency' => 'INR',
				'symbol' => '₹',
				'plan_name' => 'Fublis Enterprise Plan Annual',
				'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
				'plan_id' => 'prod_Q4o05OlOpbYDKh',
				'price_id' => 'price_1PEeOpSF38t8VQrgCxs9gP59',
				'price_per_month' => 29100,
				'quantity' => 12,
			],
			[
				'slug' => 'business-plan-quarterly-inr',
				'currency' => 'INR',
				'symbol' => '₹',
				'plan_name' => 'Fublis Business Plan Quarterly',
				'plan_type' => SubscriptionPlanTypeEnum::QUARTERLY,
				'plan_id' => 'prod_Q4o8uENzynwhWh',
				'price_id' => 'price_1PEeVoSF38t8VQrgn5VuylVb',
				'price_per_month' => 36000,
				'quantity' => 3,
			],
			[
				'slug' => 'enterprise-plan-quarterly-inr',
				'currency' => 'INR',
				'symbol' => '₹',
				'plan_name' => 'Fublis Enterprise Plan Quarterly',
				'plan_type' => SubscriptionPlanTypeEnum::QUARTERLY,
				'plan_id' => 'prod_Q4o5RaHTOcz5Lc',
				'price_id' => 'price_1PEeTQSF38t8VQrgr7NHp6PM',
				'price_per_month' => 40000,
				'quantity' => 3,
			],
		];

		foreach($data as $row){
			SubscriptionPlan::create($row);
		}
    }
}

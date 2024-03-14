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
				'plan_name' => 'Business Plan',
				'plan_id' => 'prod_Peurrie1DsY8GH',
				'price' => [
					[
						'slug' => 'business-plan-quaterly',
						'plan_type' => SubscriptionPlanTypeEnum::QUATERLY,
						'price_per_month' => 449,
						'quantity' => 3,
						'price_id' => 'price_1Opb1zHX5etbOuNbNhoy83Xb',
					],
					[
						'slug' => 'business-plan-annually',
						'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
						'price_per_month' => 299,
						'quantity' => 12,
						'price_id' => 'price_1Opb2dHX5etbOuNb1tqKYzQa',
					],
				]
			],
			[
				'plan_name' => 'Enterprise Plan',
				'plan_id' => 'prod_PeutvWdvZH70qK',
				'price' => [
					[
						'slug' => 'enterprise-plan-quaterly',
						'plan_type' => SubscriptionPlanTypeEnum::QUATERLY,
						'price_per_month' => 499,
						'quantity' => 3,
						'price_id' => 'price_1Opb44HX5etbOuNbaWnI8vX2',
					],
					[
						'slug' => 'enterprise-plan-annually',
						'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
						'price_per_month' => 349,
						'quantity' => 12,
						'price_id' => 'price_1Opb4RHX5etbOuNboGu7Jm4B',
					],
				]
			],
		];

		foreach($data as $row){
			$buildingTypology = SubscriptionPlan::create([
				'plan_name' => $row['plan_name'],
				'plan_id' => $row['plan_id'],
			]);
			$buildingTypology->subscriptionPrices()->createMany($row['price']);
		}
    }
}

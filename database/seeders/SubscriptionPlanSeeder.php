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
				'plan_name' => 'Fublis Business Plan Annual',
				'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
				'plan_id' => 'prod_PmxjtGHlOo1Owy',
				'price_id' => 'price_1OxNo6SD3swwfNYODnUKclnf',
				'price_per_month' => 299,
				'quantity' => 12,
			],
			[
				'slug' => 'enterprise-plan-annually',
				'plan_name' => 'Fublis Enterprise Plan Annual',
				'plan_type' => SubscriptionPlanTypeEnum::ANNUAL,
				'plan_id' => 'prod_PmyjBcHajJNWlZ',
				'price_id' => 'price_1OxOmUSD3swwfNYOn3Rqf3uZ',
				'price_per_month' => 349,
				'quantity' => 12,
			],
			[
				'slug' => 'business-plan-quaterly',
				'plan_name' => 'Fublis Business Plan Quaterly',
				'plan_type' => SubscriptionPlanTypeEnum::QUATERLY,
				'plan_id' => 'prod_PmyrZBrlF7dYTY',
				'price_id' => 'price_1OxOttSD3swwfNYO9cCKkEKx',
				'price_per_month' => 449,
				'quantity' => 3,
			],
			[
				'slug' => 'enterprise-plan-quaterly',
				'plan_name' => 'Fublis Enterprise Plan Quaterly',
				'plan_type' => SubscriptionPlanTypeEnum::QUATERLY,
				'plan_id' => 'prod_PmyvmwfsnRmagl',
				'price_id' => 'price_1OxOxiSD3swwfNYOD7MiL8Zw',
				'price_per_month' => 499,
				'quantity' => 3,
			],
		];

		foreach($data as $row){
			SubscriptionPlan::create($row);
		}
    }
}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'name' => 'administrator',
			],
			[
				'name' => 'architect',
			],
			[
				'name' => 'associate',
			],
			[
				'name' => 'brand manager',
			],
			[
				'name' => 'business development',
			],
			[
				'name' => 'business manager',
			],
			[
				'name' => 'ceo',
			],
			[
				'name' => 'co-founder',
			],
			[
				'name' => 'communications',
			],
			[
				'name' => 'communications director',
			],
			[
				'name' => 'communications manager',
			],
			[
				'name' => 'content editor',
			],
			[
				'name' => 'content manager',
			],
			[
				'name' => 'coo',
			],
			[
				'name' => 'creative director',
			],
			[
				'name' => 'designer',
			],
			[
				'name' => 'director',
			],
			[
				'name' => 'fashion designer',
			],
			[
				'name' => 'founder',
			],
			[
				'name' => 'founder / principal architect',
			],
			[
				'name' => 'graphic designer',
			],
			[
				'name' => 'graphics manager',
			],
			[
				'name' => 'interior architect',
			],
			[
				'name' => 'intern',
			],
			[
				'name' => 'legal representative',
			],
			[
				'name' => 'managing director',
			],
			[
				'name' => 'marketing',
			],
			[
				'name' => 'marketing & communications',
			],
			[
				'name' => 'marketing coordinator',
			],
			[
				'name' => 'marketing director',
			],
			[
				'name' => 'marketing manager',
			],
			[
				'name' => 'office manager',
			],
			[
				'name' => 'operations manager',
			],
			[
				'name' => 'owner',
			],
			[
				'name' => 'partner',
			],
			[
				'name' => 'photographer',
			],
			[
				'name' => 'pr representative',
			],
			[
				'name' => 'president',
			],
			[
				'name' => 'principal',
			],
			[
				'name' => 'product designer',
			],
			[
				'name' => 'public relations',
			],
			[
				'name' => 'public relations director',
			],
			[
				'name' => 'public relations manager',
			],
			[
				'name' => 'social media manager',
			],
			[
				'name' => 'studio head',
			],
			[
				'name' => 'studio manager',
			],
			[
				'name' => 'submissions coordinator',
			],
			[
				'name' => 'writer',
			],
			[
				'name' => 'writing consultant',
			],
		];

		foreach($data as $row){
			Category::create($row);
		}
    }
}

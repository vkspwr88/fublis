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
				'name' => 'architecture',
			],
			[
				'name' => 'Automative',
			],
			[
				'name' => 'Business',
			],
			[
				'name' => 'Education',
			],
			[
				'name' => 'Entertainment',
			],
			[
				'name' => 'Fashion',
			],
			[
				'name' => 'Fitness',
			],
			[
				'name' => 'Food',
			],
			[
				'name' => 'Gadgets',
			],
			[
				'name' => 'Health',
			],
			[
				'name' => 'home & decor',
			],
			[
				'name' => 'Interior Design',
			],
			[
				'name' => 'Life & Style',
			],
			[
				'name' => 'Music',
			],
			[
				'name' => 'Product Design',
			],
			[
				'name' => 'Sports',
			],
			[
				'name' => 'Startups',
			],
			[
				'name' => 'Technology',
			],
			[
				'name' => 'Travel',
			],
		];

		foreach($data as $row){
			Category::create($row);
		}
    }
}

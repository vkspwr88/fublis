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
				'name' => 'home decor',
			],
			[
				'name' => 'interior design',
			],
			[
				'name' => 'automative',
			],
		];

		foreach($data as $row){
			Category::create($row);
		}
    }
}

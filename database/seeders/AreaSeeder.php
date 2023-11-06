<?php

namespace Database\Seeders;

use App\Models\Area;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'name' => 'acre',
			],
			[
				'name' => 'hectare',
			],
			[
				'name' => 'sq. ft.',
			]
		];

		foreach($data as $row){
			Area::create($row);
		}
    }
}

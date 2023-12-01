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
				'name' => 'sq. in.',
			],
			[
				'name' => 'sq. ft.',
			],
			[
				'name' => 'sq. yd.',
			],
			[
				'name' => 'sq. mi.',
			],
			[
				'name' => 'sq. m.',
			],
			[
				'name' => 'sq. km.',
			]
		];

		foreach($data as $row){
			Area::create($row);
		}
    }
}

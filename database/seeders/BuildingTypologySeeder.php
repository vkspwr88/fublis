<?php

namespace Database\Seeders;

use App\Models\BuildingTypology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingTypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'name' => 'hospitality',
			],
			[
				'name' => 'text building typology',
			],
		];

		foreach($data as $row){
			BuildingTypology::create($row);
		}
    }
}

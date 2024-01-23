<?php

namespace Database\Seeders;

use App\Models\PublishFrom;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublishFromSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'name' => 'worldwide',
			],
			[
				'name' => 'Country Specific',
			],
			[
				'name' => 'Regional Specific',
			],
			[
				'name' => 'City Specific',
			],
		];

		foreach($data as $row){
			PublishFrom::create($row);
		}
    }
}

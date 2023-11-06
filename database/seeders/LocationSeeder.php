<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
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
				'name' => 'australia',
			],
			[
				'name' => 'new delhi',
			],
			[
				'name' => 'new york',
			],
			[
				'name' => 'mumbai',
			],
		];

		foreach($data as $row){
			Location::create($row);
		}
    }
}

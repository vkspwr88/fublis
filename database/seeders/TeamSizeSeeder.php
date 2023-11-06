<?php

namespace Database\Seeders;

use App\Models\TeamSize;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TeamSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'name' => '1-5',
			],
			[
				'name' => '6-10',
			],
			[
				'name' => '11-20',
			],
			[
				'name' => '21-50',
			],
			[
				'name' => 'more than 50',
			],
		];

		foreach($data as $row){
			TeamSize::create($row);
		}
    }
}

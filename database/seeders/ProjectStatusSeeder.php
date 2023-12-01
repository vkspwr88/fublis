<?php

namespace Database\Seeders;

use App\Models\ProjectStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'name' => 'built',
			],
			[
				'name' => 'under construction',
			],
			[
				'name' => 'concept',
			],
		];

		foreach($data as $row){
			ProjectStatus::create($row);
		}
    }
}

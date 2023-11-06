<?php

namespace Database\Seeders;

use App\Models\ArchitectPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArchitectPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'name' => 'founder',
			],
			[
				'name' => 'architect',
			],
		];

		foreach($data as $row){
			ArchitectPosition::create($row);
		}
    }
}

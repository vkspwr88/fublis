<?php

namespace Database\Seeders;

use App\Models\JournalistPosition;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JournalistPositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'name' => 'journalist',
			],
			[
				'name' => 'test role',
			],
		];

		foreach($data as $row){
			JournalistPosition::create($row);
		}
    }
}

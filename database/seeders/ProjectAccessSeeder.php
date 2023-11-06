<?php

namespace Database\Seeders;

use App\Models\ProjectAccess;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectAccessSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'name' => 'open to all',
			],
			[
				'name' => 'private',
			],
		];

		foreach($data as $row){
			ProjectAccess::create($row);
		}
    }
}

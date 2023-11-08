<?php

namespace Database\Seeders;

use App\Models\PublicationType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PublicationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'name' => 'online magazine',
			],
			[
				'name' => 'print magazine',
			],
			[
				'name' => 'social media page',
			],
			[
				'name' => 'newspaper',
			],
			[
				'name' => 'blog',
			],
			[
				'name' => 'other',
			],
		];

		foreach($data as $row){
			PublicationType::create($row);
		}
    }
}
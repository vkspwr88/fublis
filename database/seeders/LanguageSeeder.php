<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'name' => 'english',
			],
			[
				'name' => 'spanish',
			],
			[
				'name' => 'french',
			],
			[
				'name' => 'german',
			],
			[
				'name' => 'italian',
			],
		];

		foreach($data as $row){
			Language::create($row);
		}
    }
}

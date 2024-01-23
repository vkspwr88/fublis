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
				'name' => 'English',
			],
			[
				'name' => 'Arabic',
			],
			[
				'name' => 'French',
			],
			[
				'name' => 'German',
			],
			[
				'name' => 'Hindi',
			],
			[
				'name' => 'Indonesian',
			],
			[
				'name' => 'Italian',
			],
			[
				'name' => 'Japanese',
			],
			[
				'name' => 'Korean',
			],
			[
				'name' => 'Mandarin Chinese',
			],
			[
				'name' => 'Portuguese',
			],
			[
				'name' => 'Russian',
			],
			[
				'name' => 'Spanish',
			],
			[
				'name' => 'Turkish',
			],
			[
				'name' => 'Vietnamese',
			],
		];

		foreach($data as $row){
			Language::create($row);
		}
    }
}

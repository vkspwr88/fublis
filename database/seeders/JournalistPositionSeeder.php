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
				'name' => 'associate editor',
			],
			[
				'name' => 'author',
			],
			[
				'name' => 'blogger',
			],
			[
				'name' => 'ceo',
			],
			[
				'name' => 'co founder',
			],
			[
				'name' => 'co-host',
			],
			[
				'name' => 'columnist',
			],
			[
				'name' => 'contributing editor',
			],
			[
				'name' => 'contributing writer',
			],
			[
				'name' => 'contributor',
			],
			[
				'name' => 'creator',
			],
			[
				'name' => 'design editor',
			],
			[
				'name' => 'design writer',
			],
			[
				'name' => 'digital editor',
			],
			[
				'name' => 'editor',
			],
			[
				'name' => 'editor and publisher',
			],
			[
				'name' => 'editor and site director',
			],
			[
				'name' => 'editor and writer',
			],
			[
				'name' => 'editor in chief',
			],
			[
				'name' => 'editorial director',
			],
			[
				'name' => 'executive editor',
			],
			[
				'name' => 'founder',
			],
			[
				'name' => 'freelance writer',
			],
			[
				'name' => 'guest editor',
			],
			[
				'name' => 'guest writer',
			],
			[
				'name' => 'journalist',
			],
			[
				'name' => 'managing editor',
			],
			[
				'name' => 'news editor',
			],
			[
				'name' => 'owner',
			],
			[
				'name' => 'producer',
			],
			[
				'name' => 'production editor',
			],
			[
				'name' => 'publisher',
			],
			[
				'name' => 'publisher',
			],
			[
				'name' => 'senior editor',
			],
			[
				'name' => 'senior writer',
			],
			[
				'name' => 'staff writer',
			],
			[
				'name' => 'sub editor',
			],
			[
				'name' => 'web editor',
			],
			[
				'name' => 'writer',
			],
		];

		foreach($data as $row){
			JournalistPosition::create($row);
		}
    }
}

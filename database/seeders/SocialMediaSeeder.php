<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'name' => 'Twitter',
				'url' => '#',
				'icon' => '<i class="bi bi-twitter-x"></i>',
			],
			[
				'name' => 'Linkedin',
				'url' => '#',
				'icon' => '<i class="bi bi-linkedin"></i>',
			],
			[
				'name' => 'Facebook',
				'url' => '#',
				'icon' => '<i class="bi bi-facebook"></i>',
			],
			[
				'name' => 'Instagram',
				'url' => '#',
				'icon' => '<i class="bi bi-instagram"></i>',
			],
			[
				'name' => 'Pinterest',
				'url' => '#',
				'icon' => '<i class="bi bi-pinterest"></i>',
			],
			[
				'name' => 'Snapchat',
				'url' => '#',
				'icon' => '<i class="bi bi-snapchat"></i>',
			],
		];

		foreach($data as $row){
			SocialMedia::create($row);
		}
    }
}

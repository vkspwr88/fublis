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
				'url' => 'https://twitter.com/fublismedia',
				'icon' => '<i class="bi bi-twitter-x"></i>',
			],
			[
				'name' => 'Linkedin',
				'url' => 'https://www.linkedin.com/company/fublismedia',
				'icon' => '<i class="bi bi-linkedin"></i>',
			],
			[
				'name' => 'Facebook',
				'url' => 'https://www.facebook.com/fublismedianetwork/',
				'icon' => '<i class="bi bi-facebook"></i>',
			],
			[
				'name' => 'Instagram',
				'url' => 'https://www.instagram.com/fublismedia/',
				'icon' => '<i class="bi bi-instagram"></i>',
			],
			[
				'name' => 'Pinterest',
				'url' => 'https://in.pinterest.com/fublismedia/',
				'icon' => '<i class="bi bi-pinterest"></i>',
			],
		];

		foreach($data as $row){
			SocialMedia::create($row);
		}
    }
}

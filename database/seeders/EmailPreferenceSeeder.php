<?php

namespace Database\Seeders;

use App\Models\EmailPreference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmailPreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'key' => 'architect-instant-download-request-mail',
				'details' => 'New publication requests for your media kits.',
				'email_type' => 'instant',
				'email_for' => 'architect',
			],
			[
				'key' => 'architect-instant-download-media-kit-mail',
				'details' => 'Downloads of your media kits.',
				'email_type' => 'instant',
				'email_for' => 'architect',
			],
			[
				'key' => '',
				'details' => 'Messages or inquiries from journalists and publishers.',
				'email_type' => 'instant',
				'email_for' => 'none',
			],
			[
				'key' => 'architect-daily-download-request-mail',
				'details' => 'Daily Publication requests, Media kit downloads or Messages',
				'email_type' => 'daily',
				'email_for' => 'architect',
			],
			[
				'key' => 'architect-weekly-stats-mail',
				'details' => 'New publication requests, Media kit downloads or Messages',
				'email_type' => 'weekly',
				'email_for' => 'architect',
			],
			[
				'key' => 'architect-monthly-stats-mail',
				'details' => 'Your media kits performance metrics (views, downloads, publications)',
				'email_type' => 'monthly',
				'email_for' => 'architect',
			],
		];

		foreach($data as $row){
			EmailPreference::create($row);
		}
    }
}

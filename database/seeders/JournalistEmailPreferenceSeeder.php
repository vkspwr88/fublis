<?php

namespace Database\Seeders;

use App\Models\EmailPreference;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class JournalistEmailPreferenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'key' => 'journalist-daily-pitch-received-mail',
				'details' => 'Daily pitches & media kit download request approvals',
				'email_type' => 'daily',
				'email_for' => 'journalist',
			],
			[
				'key' => 'journalist-daily-media-kit-mail',
				'details' => 'Daily new media kits published on platform',
				'email_type' => 'daily',
				'email_for' => 'journalist',
			],
			[
				'key' => 'journalist-weekly-stats-mail',
				'details' => 'Weekly Stats - pitches, request approvals, calls, submissions',
				'email_type' => 'weekly',
				'email_for' => 'journalist',
			],
			[
				'key' => 'journalist-monthly-stats-mail',
				'details' => 'Monthly Stats - pitches, request approvals, calls, submissions',
				'email_type' => 'monthly',
				'email_for' => 'journalist',
			],
		];

		foreach($data as $row){
			EmailPreference::create($row);
		}
    }
}

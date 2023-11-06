<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
			[
				'setting_key' => 'EMAIL_VERIFICATION_TIMEOUT',
				'setting_value' => '5',
				'remarks' => 'Email verification timeout during signup',
			],
		];

		foreach($data as $row){
			Setting::create($row);
		}
    }
}

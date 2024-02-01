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
				'setting_key' => 'email verification timeout',
				'setting_value' => '5',
				'remarks' => 'Email verification timeout during signup',
			],
			[
				'setting_key' => 'reset password timeout',
				'setting_value' => '60',
				'remarks' => 'Reset password timeout during forgot password',
			],
		];

		foreach($data as $row){
			Setting::create($row);
		}
    }
}

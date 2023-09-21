<?php

namespace Database\Seeders;

use App\Enums\Users\UserTypeEnum;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
			"name" => "Admin",
			"email" => "admin@fublis.com",
			"password" => "12345678",
			"email_verified_at" => now(),
			"user_type" => UserTypeEnum::ADMIN,
			"remember_token" => Str::random(10),
		]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

		$this->call([
			CountryStateCityTableSeeder::class,
			UserSeeder::class,
			ArchitectPositionSeeder::class,
			AreaSeeder::class,
			BuildingTypologySeeder::class,
			CategorySeeder::class,
			JournalistPositionSeeder::class,
			LanguageSeeder::class,
			//LocationSeeder::class,
			ProjectAccessSeeder::class,
			ProjectStatusSeeder::class,
			PublicationTypeSeeder::class,
			PublishFromSeeder::class,
			SettingSeeder::class,
			TeamSizeSeeder::class,
			SocialMediaSeeder::class,
			SubscriptionPlanSeeder::class,
			FaqSeeder::class,
		]);

		// php artisan db:seed --class=SubscriptionPlanSeeder
    }
}

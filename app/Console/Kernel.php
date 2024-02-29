<?php

namespace App\Console;

use App\Console\Commands;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();
		$schedule->command(Commands\SendArchitectWeeklyStatEmails::class)->weeklyOn(3, '16:30');
		$schedule->command(Commands\SendArchitectMonthlyStatEmails::class)->lastDayOfMonth('21:00');

		$schedule->command(Commands\SendJournalistWeeklyStatEmails::class)->weeklyOn(3, '16:30');
		$schedule->command(Commands\SendJournalistMonthlyStatEmails::class)->lastDayOfMonth('21:00');

		/* $schedule->command(Commands\SendArchitectWeeklyStatEmails::class)->everyFiveMinutes();
		$schedule->command(Commands\SendArchitectMonthlyStatEmails::class)->everyFiveMinutes();
		$schedule->command(Commands\SendJournalistWeeklyStatEmails::class)->everyFiveMinutes();
		$schedule->command(Commands\SendJournalistMonthlyStatEmails::class)->everyFiveMinutes(); */
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}

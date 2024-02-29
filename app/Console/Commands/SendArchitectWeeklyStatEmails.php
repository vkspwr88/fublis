<?php

namespace App\Console\Commands;

use App\Services\Architects\StatsService;
use Exception;
use Illuminate\Console\Command;

class SendArchitectWeeklyStatEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-architect-weekly-stat-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending weekly stats to all architects';

    /**
     * Execute the console command.
     */
    public function handle()
    {
		info("SendArchitectWeeklyStatEmails Cron Job running at " . now());
		try{
			$statsService = new StatsService;
			$statsService->sendStatEmails('week');
		}
		catch(Exception $exp){
			info('SendArchitectWeeklyStatEmails Error: ' . $exp->getMessage());
		}
		info("SendArchitectWeeklyStatEmails Cron Job ended at " . now());
    }
}

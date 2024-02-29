<?php

namespace App\Console\Commands;

use App\Services\Architects\StatsService;
use Exception;
use Illuminate\Console\Command;

class SendArchitectMonthlyStatEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-architect-monthly-stat-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending monthly stats to all architects';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info("SendArchitectMonthlyStatEmails Cron Job running at " . now());
		try{
			$statsService = new StatsService;
			$statsService->sendStatEmails('month');
		}
		catch(Exception $exp){
			info('SendArchitectMonthlyStatEmails Error: ' . $exp->getMessage());
		}
		info("SendArchitectMonthlyStatEmails Cron Job ended at " . now());
    }
}

<?php

namespace App\Console\Commands;

use App\Services\Journalists\StatsService;
use Exception;
use Illuminate\Console\Command;

class SendJournalistMonthlyStatEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-journalist-monthly-stat-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending monthly stats to all journalists';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info("SendJournalistMonthlyStatEmails Cron Job running at " . now());
		try{
			$statsService = new StatsService;
			$statsService->sendStatEmails('month');
		}
		catch(Exception $exp){
			info('SendJournalistMonthlyStatEmails Error: ' . $exp->getMessage());
		}
		info("SendJournalistMonthlyStatEmails Cron Job ended at " . now());
    }
}

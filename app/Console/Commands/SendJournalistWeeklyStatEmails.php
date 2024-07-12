<?php

namespace App\Console\Commands;

use App\Services\Journalists\StatsService;
use Exception;
use Illuminate\Console\Command;

class SendJournalistWeeklyStatEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-journalist-weekly-stat-emails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending weekly stats to all journalists';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        info("SendJournalistWeeklyStatEmails Cron Job running at " . now());
		try{
			$statsService = new StatsService;
			$statsService->sendStatEmails('week');
		}
		catch(Exception $exp){
			info('SendJournalistWeeklyStatEmails Error: ' . $exp->getMessage());
		}
		info("SendJournalistWeeklyStatEmails Cron Job ended at " . now());
    }
}

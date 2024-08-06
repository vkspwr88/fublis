<?php

namespace App\Console\Commands;

use App\Services\CronService;
use Illuminate\Console\Command;

class SendJournalistDailyNewPitches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-journalist-daily-new-pitches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily new pitches received to Journalists';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        CronService::sendJournalistDailyNewPitches();
    }
}

<?php

namespace App\Console\Commands;

use App\Services\CronService;
use Illuminate\Console\Command;

class SendJournalistDailyNewMediaKits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-journalist-daily-new-media-kits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send new media kits based on categories to Journalist';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        CronService::sendJournalistDailyNewMediaKits();
    }
}

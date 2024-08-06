<?php

namespace App\Console\Commands;

use App\Services\CronService;
use Illuminate\Console\Command;

class SendArchitectDailyDownloadRequests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-architect-daily-download-requests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send daily download requests to Architects';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        CronService::sendArchitectDailyDownloadRequests();
    }
}

<?php

namespace App\Console\Commands;

use App\Services\CronService;
use Illuminate\Console\Command;

class ProcessDownloadRequestSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:process-download-request-schedule';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Processing schedule for the download request from fublis journalist';

    /**
     * Execute the console command.
     */
    public function handle()
    {
		CronService::processDownloadRequestSchedule();
    }
}

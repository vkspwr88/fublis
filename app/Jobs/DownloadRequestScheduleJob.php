<?php

namespace App\Jobs;

use App\Models\MediaKit;
use App\Services\DownloadRequestScheduleService;
use App\Services\FublisJournalistService;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DownloadRequestScheduleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
		public MediaKit $mediaKit,
	)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
		info("DownloadRequestScheduleJob Job running at " . now());

		$nextTickerInMinute = rand(20, 30);
		$dateNow = Carbon::now();
		// 1. get all fublis journalists and shuffle it, set the nextTickerInMin = rand(20, 30);
		$fublisJournalists = FublisJournalistService::getAll();
		// 2. loop through the list
		foreach($fublisJournalists->shuffle() as $index => $fublisJournalist){
			// 2.1. check if first journalist, set the schedule between 20-30 min.
			if($index > 0){
				// 2.2. set the next 3-5 hours schedule, by setting nextTickerInMin += rand(180, 300);
				$nextTickerInMinute += rand(180, 300);
			}
			// 2.3. store media kit id, user id, schedule at, mail sent (default false)
			DownloadRequestScheduleService::create([
				'user_id' => $fublisJournalist->journalist->user_id,
				'mediakit_id' => $this->mediaKit->id,
				'schedule_at' => $dateNow->addMinutes($nextTickerInMinute),
			]);
		}

		info("DownloadRequestScheduleJob Job ended at " . now());
    }
}

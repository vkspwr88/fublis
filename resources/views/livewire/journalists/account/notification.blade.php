<div>
    <div class="row g-4 align-items-center">
		<div class="col-auto">
			<div class="row g-4 align-items-center">
				<div class="col-auto">
					<div class="bg-gray-400 text-dark rounded-circle fs-5 p-2 fw-light"><i class="bi bi-person-plus"></i></div>
				</div>
				<div class="col">
					<h5 class="text-black fs-6 fw-semibold m-0 p-0">Story Requests</h5>
					<p class="text-secondary fs-6 m-0 p-0">
						<small>Check all received submissions from designers</small>
					</p>
				</div>
			</div>
		</div>
		<div class="col text-end">
			<button type="button" class="btn btn-white text-dark fw-semibold">Check All Requests</button>
		</div>
	</div>

	<hr class="border-gray-300 my-4">

	@if ($todayNotifications->count())
	<div class="row g-4">
		<div class="col-12">
			<h6 class="m-0 p-0 text-dark fs-7 fw-semibold">Today</h6>
		</div>
		<div class="col-12">
			<div class="row g-4">
				@foreach ($todayNotifications as $notification)
					<div class="col-12" wire:key={{ $notification->id }}>
						@include(getJournalistNotificationType($notification->notifiable))
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<hr class="border-gray-300 my-4">
	@endif

	@if ($thisWeekNotifications->count())
	<div class="row g-4">
		<div class="col-12">
			<h6 class="m-0 p-0 text-dark fs-7 fw-semibold">This Week</h6>
		</div>
		<div class="col-12">
			<div class="row g-4">
				@foreach ($thisWeekNotifications as $notification)
					<div class="col-12" wire:key={{ $notification->id }}>
						@include(getJournalistNotificationType($notification->notifiable))
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<hr class="border-gray-300 my-4">
	@endif

	@if ($thisMonthNotifications->count())
	<div class="row g-4">
		<div class="col-12">
			<h6 class="m-0 p-0 text-dark fs-7 fw-semibold">This Month</h6>
		</div>
		<div class="col-12">
			<div class="row g-4">
				@foreach ($thisMonthNotifications as $notification)
					<div class="col-12" wire:key={{ $notification->id }}>
						@include(getJournalistNotificationType($notification->notifiable))
					</div>
				@endforeach
			</div>
		</div>
	</div>
	<hr class="border-gray-300 my-4">
	@endif
</div>

<div>
    <div class="row g-4 align-items-center">
		<div class="col-auto">
			<div class="row g-4 align-items-center">
				<div class="col-auto">
					<div class="p-2 bg-gray-400 text-dark rounded-circle fs-5 fw-light"><i class="bi bi-person-plus"></i></div>
				</div>
				<div class="col">
					<h5 class="p-0 m-0 text-black fs-6 fw-semibold">Story Requests</h5>
					<p class="p-0 m-0 text-secondary fs-6">
						<small>Check all received submissions</small>
					</p>
				</div>
			</div>
		</div>
		<div class="col text-end">
			<button type="button" class="btn btn-white text-dark fw-semibold">Check All Requests</button>
		</div>
	</div>

	<hr class="my-4 border-gray-300">

	@if ($todayNotifications->count())
	<div class="row g-4">
		<div class="col-12">
			<h6 class="p-0 m-0 text-dark fs-7 fw-semibold">Today</h6>
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
	<hr class="my-4 border-gray-300">
	@endif

	@if ($thisWeekNotifications->count())
	<div class="row g-4">
		<div class="col-12">
			<h6 class="p-0 m-0 text-dark fs-7 fw-semibold">This Week</h6>
		</div>
		<div class="col-12">
			<div class="row g-4">
				@foreach ($thisWeekNotifications as $notification)
					<div class="col-12" wire:key={{ $notification->id }}>
						@include(getJournalistNotificationType($notification->notifiable))
					</div>
					{{-- {{ dd($notification); }} --}}
				@endforeach
			</div>
		</div>
	</div>
	<hr class="my-4 border-gray-300">
	@endif

	@if ($thisMonthNotifications->count())
	<div class="row g-4">
		<div class="col-12">
			<h6 class="p-0 m-0 text-dark fs-7 fw-semibold">This Month</h6>
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
	<hr class="my-4 border-gray-300">
	@endif
</div>

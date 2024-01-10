<div>
    <div class="row g-4 align-items-center">
		<div class="col-auto">
			<div class="row g-4 align-items-center">
				<div class="col-auto">
					<div class="bg-gray-400 text-dark rounded-circle fs-5 p-2 fw-light"><i class="bi bi-person-plus"></i></div>
				</div>
				<div class="col">
					<h5 class="text-black fs-6 fw-semibold m-0 p-0">Project Requests</h5>
					<p class="text-secondary fs-6 m-0 p-0">
						<small>Manage your team members here</small>
					</p>
				</div>
			</div>
		</div>
		<div class="col text-end">
			@if ($isRequestWindowDisplay || $isManageRequestWindowDisplay)
				@if ($isRequestWindowDisplay)
					<button type="button" class="btn btn-white text-dark fw-semibold me-2" wire:click="showManageAllRequest">
						Manage <x-users.spinners.primary-btn wire:target="showManageAllRequest" />
					</button>
				@elseif ($isManageRequestWindowDisplay)
					<button type="button" class="btn btn-white text-dark fw-semibold me-2" wire:click="selectAllRequest">
						Select All <x-users.spinners.primary-btn wire:target="selectAllRequest" />
					</button>
				@endif
				<button type="button" class="btn btn-white text-dark fw-semibold" wire:click="hideAllRequest">
					Cancel <x-users.spinners.primary-btn wire:target="hideAllRequest" />
				</button>
			@else
				<button type="button" class="btn btn-white text-dark fw-semibold" wire:click="showAllRequest">
					Check All Requests <x-users.spinners.primary-btn wire:target="showAllRequest" />
				</button>
			@endif
		</div>
	</div>

	<hr class="border-gray-300 my-4">

	@if($isRequestWindowDisplay)
	<div id="requestWindow">
		@if($pendingDownloadRequest->count())
		<div class="row g-3">
			<div class="col-12">
				<div class="input-group mb-4">
					<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
					<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" />
				</div>
			</div>
			@foreach ($pendingDownloadRequest as $downloadRequest)
				@include('users.includes.architect.notification.manage.manage-download-request')
			@endforeach
		</div>
		@else
		<h4 class="text-center">No Request</h4>
		@endif
	</div>
	@elseif ($isManageRequestWindowDisplay)
	<div id="manageRequestWindow">
		@if($pendingDownloadRequest->count())
		<div class="row g-3">
			<div class="col-12">
				<div class="input-group mb-4">
					<label class="input-group-text bg-white" for="filterSearchInput"><i class="bi bi-search"></i></label>
					<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" />
				</div>
			</div>
			@foreach ($pendingDownloadRequest as $downloadRequest)
				@include('users.includes.architect.notification.manage.checkbox-download-request')
			@endforeach
		</div>
		<hr class="border-gray-300 my-4">
		<div class="row">
			<div class="col">
				<div class="text-center">
					<button type="button" class="btn btn-white text-dark fw-semibold me-2" wire:click="declineSelectedMediaKitDownload">
						Decline <x-users.spinners.primary-btn wire:target="declineSelectedMediaKitDownload" />
					</button>
					<button type="button" class="btn btn-primary" wire:click="approveSelectedMediaKitDownload">
						Approve <x-users.spinners.white-btn wire:target="approveSelectedMediaKitDownload" />
					</button>
				</div>
			</div>
		</div>
		@else
			<h4 class="text-center">No Request</h4>
		@endif
	</div>
	@else
	<div id="notificationsWindow">
		@if ($todayNotifications->count())
		<div class="row g-4">
			<div class="col-12">
				<h6 class="m-0 p-0 text-dark fs-7 fw-semibold">Today</h6>
			</div>
			<div class="col-12">
				<div class="row g-4">
					@foreach ($todayNotifications as $notification)
						<div class="col-12" wire:key={{ $notification->id }}>
							@include(getArchitectNotificationType($notification->notifiable))
						</div>
						{{-- <div class="col-12">
							<div class="row g-3 align-items-center">
								<div class="col-auto">
									<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
								</div>
								<div class="col-auto">
									<p class="m-0 p-0">
										{!! $notification->message !!}
									</p>
								</div>
								<div class="col text-end">
									<button type="button" class="btn btn-white text-dark fw-semibold">Decline</button>
									<button type="button" class="btn btn-primary">Approve</button>
								</div>
							</div>
						</div> --}}
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
							@include(getArchitectNotificationType($notification->notifiable))
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
							@include(getArchitectNotificationType($notification->notifiable))
						</div>
					@endforeach
				</div>
			</div>
		</div>
		<hr class="border-gray-300 my-4">
		@endif
	</div>
	@endif

	{{-- <div class="row g-4">
		<div class="col-12">
			<h6 class="m-0 p-0 text-dark fs-7 fw-semibold">Today</h6>
		</div>
		<div class="col-12">
			<div class="row g-4">
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr class="border-gray-300 my-4">

	<div class="row g-4">
		<div class="col-12">
			<h6 class="m-0 p-0 text-dark fs-7 fw-semibold">This Week</h6>
		</div>
		<div class="col-12">
			<div class="row g-4">
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr class="border-gray-300 my-4">

	<div class="row g-4">
		<div class="col-12">
			<h6 class="m-0 p-0 text-dark fs-7 fw-semibold">This Month</h6>
		</div>
		<div class="col-12">
			<div class="row g-4">
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
				<div class="col-12">
					<div class="row g-3 align-items-center">
						<div class="col-auto">
							<img class="img-square rounded-circle" src="https://via.placeholder.com/48x48" alt="..." />
						</div>
						<div class="col">
							<p class="m-0 p-0">
								Kaitlyn was added to Media Park Atlanta.
							</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr class="border-gray-300 my-4"> --}}
</div>

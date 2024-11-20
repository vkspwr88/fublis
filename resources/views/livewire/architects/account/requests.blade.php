<div>
    <div class="row g-4 align-items-center">
		<div class="col-auto">
			<div class="row g-4 align-items-center">
				<div class="col-auto">
					<div class="p-2 bg-gray-400 text-dark rounded-circle fs-5 fw-light"><i class="bi bi-person-plus"></i></div>
				</div>
				<div class="col">
					<h5 class="p-0 m-0 text-black fs-6 fw-semibold">Publication Requests</h5>
					<p class="p-0 m-0 text-secondary fs-6">
						<small>Approve or decline publication requests</small>
					</p>
				</div>
			</div>
		</div>
	</div>

	<hr class="my-4 border-gray-300">

	<div id="requestWindow">
		@if($pendingDownloadRequest->count())
			<div class="row g-3">
				{{-- <div class="col-12">
					<div class="mb-4 input-group">
						<label class="bg-white input-group-text" for="filterSearchInput"><i class="bi bi-search"></i></label>
						<input id="filterSearchInput" class="shadow-none form-control border-start-0 ps-0" type="search" placeholder="Search by name" aria-label="Search" wire:model="name" />
					</div>
				</div> --}}
				@foreach ($pendingDownloadRequest as $downloadRequest)
					@if($downloadRequest->notifiable && $downloadRequest->notifiable->requestedJournalist)
						@include('users.includes.architect.notification.manage.manage-download-request')
					@endif
				@endforeach
			</div>
		@else
			<h4 class="text-center">No Request</h4>
		@endif
	</div>

	@include('users.includes.architect.modal-download-request')
</div>

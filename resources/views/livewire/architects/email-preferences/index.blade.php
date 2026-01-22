<form wire:submit="save">
	<div class="row g-3">
		<h5 class="fs-6 m-0 fw-bold">Notification Preferences</h5>
		<div class="col-12">
			<div class="bg-light p-3 rounded">
				<h6 class="text-purple-600 fw-bold fs-6">Instant Notifications</h6>
				<p class="m-0 text-secondary fw-medium fs-6">Get notified immediately for:</p>
			</div>
		</div>
		<div class="col-12">
			@foreach ($emailPreferences->where('email_type', 'instant') as $emailPreference)
			<div class="form-check" wire:key="{{ $emailPreference->key }}">
				<input class="form-check-input form-check-input-lg filter-checkbox" type="checkbox" value="{{ $emailPreference->id }}" id="{{ $emailPreference->key }}" wire:model="selectedEmailPreferences" />
				<label class="form-check-label fs-5 fw-semibold ms-2" for="{{ $emailPreference->key }}">{{ $emailPreference->details }}</label>
			</div>
			@endforeach
		</div>
		<div class="col-12">
			<div class="bg-light p-3 rounded">
				<h6 class="text-purple-600 fw-bold fs-6">Daily Summary Notifications</h6>
				<p class="m-0 text-secondary fw-medium fs-6">Receive a daily digest of:</p>
			</div>
		</div>
		<div class="col-12">
			@foreach ($emailPreferences->where('email_type', 'daily') as $emailPreference)
			<div class="form-check" wire:key="{{ $emailPreference->key }}">
				<input class="form-check-input form-check-input-lg filter-checkbox" type="checkbox" value="{{ $emailPreference->id }}" id="{{ $emailPreference->key }}" wire:model="selectedEmailPreferences" />
				<label class="form-check-label fs-5 fw-semibold ms-2" for="{{ $emailPreference->key }}">{{ $emailPreference->details }}</label>
			</div>
			@endforeach
		</div>
		<div class="col-12">
			<div class="bg-light p-3 rounded">
				<h6 class="text-purple-600 fw-bold fs-6">Weekly Summary Notifications (Highly Recommended)</h6>
				<p class="m-0 text-secondary fw-medium fs-6">A weekly roundup of:</p>
			</div>
		</div>
		<div class="col-12">
			@foreach ($emailPreferences->where('email_type', 'weekly') as $emailPreference)
			<div class="form-check" wire:key="{{ $emailPreference->key }}">
				<input class="form-check-input form-check-input-lg filter-checkbox" type="checkbox" value="{{ $emailPreference->id }}" id="{{ $emailPreference->key }}" wire:model="selectedEmailPreferences" />
				<label class="form-check-label fs-5 fw-semibold ms-2" for="{{ $emailPreference->key }}">{{ $emailPreference->details }}</label>
			</div>
			@endforeach
		</div>
		<div class="col-12">
			<div class="bg-light p-3 rounded">
				<h6 class="text-purple-600 fw-bold fs-6">Monthly Insights and Reports (Highly Recommended)</h6>
				<p class="m-0 text-secondary fw-medium fs-6">A detailed monthly report including:</p>
			</div>
		</div>
		<div class="col-12">
			@foreach ($emailPreferences->where('email_type', 'monthly') as $emailPreference)
			<div class="form-check" wire:key="{{ $emailPreference->key }}">
				<input class="form-check-input form-check-input-lg filter-checkbox" type="checkbox" value="{{ $emailPreference->id }}" id="{{ $emailPreference->key }}" wire:model="selectedEmailPreferences" />
				<label class="form-check-label fs-5 fw-semibold ms-2" for="{{ $emailPreference->key }}">{{ $emailPreference->details }}</label>
			</div>
			@endforeach
		</div>
		<hr class="my-3">
		<div class="col-12">
			<div class="d-grid">
				<button type="submit" class="btn btn-white text-capitalize fw-semibold">
					save
					<x-users.spinners.primary-btn wire:target="save" />
				</button>
			</div>
		</div>
	</div>
</form>


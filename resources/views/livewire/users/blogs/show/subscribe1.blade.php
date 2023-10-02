<form wire:submit="subscribe" novalidate>
	<div class="form-group mb-3">
		<input type="text" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
		<div class="invalid-feedback text-start">@error('email') {{ $message }} @enderror</div>
		<div class="form-text"><small>Read about our <a href="{{ route('privacy-policy') }}" class="text-muted">privacy policy</a>.</small></div>
	</div>
	<div class="form-group mb-3">
		<div class="d-grid">
			<button class="btn btn-primary text-capitalize" type="submit">subscribe</button>
		</div>
	</div>
</form>

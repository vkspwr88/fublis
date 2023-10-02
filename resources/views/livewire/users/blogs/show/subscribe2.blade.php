<form wire:submit="subscribe" class="d-flex justify-content-center" novalidate>
	<div class="subscribe-input me-1 me-sm-2">
		<input type="text" wire:model="email" class="form-control @error('email') is-invalid @enderror" placeholder="Enter your email">
		<div class="invalid-feedback text-start">@error('email') {{ $message }} @enderror</div>
		<div class="form-text position-absolute"><small>We care about your data in our <a href="{{ route('privacy-policy') }}" class="text-muted">privacy policy</a>.</small></div>
	</div>
	<div class="subscribe-button">
		<button class="btn btn-primary text-capitalize" type="submit">subscribe</button>
	</div>
</form>

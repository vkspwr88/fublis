<form wire:submit="subscribe" class="d-flex justify-content-center" novalidate>
	<div class="subscribe position-relative">
		<div class="subscribe-input">
			<input type="text" wire:model="email" class="bg-dark border-0 form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Enter your email">
			<div class="invalid-feedback text-start">@error('email') {{ $message }} @enderror</div>
			{{-- <div class="form-text position-absolute"><small>We care about your data in our <a href="{{ route('privacy-policy') }}" class="text-muted">privacy policy</a>.</small></div> --}}
		</div>
		<div class="subscribe-button position-absolute" style="top: 5px; right: 5px;">
			<button class="btn btn-primary text-capitalize px-3" type="submit">
				subscribe
				<x-users.spinners.white-btn wire:target="subscribe" />
			</button>
		</div>
	</div>
</form>

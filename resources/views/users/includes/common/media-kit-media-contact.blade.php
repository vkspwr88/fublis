<div class="row">
	<div class="col-12">
		<p class="text-dark fs-6 m-0 pb-2">Media Contact</p>
		<div class="row g-3 align-items-center">
			<div class="col-auto">
				<img class="rounded-circle img-square img-48" src="{{ $mediaKit->mediaContact->profileImage ? Storage::url($mediaKit->mediaContact->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
			</div>
			<div class="col-auto">
				<p class="fs-6 fw-medium m-0 p-0">
					@if ($viewAs == 'architect')
					<a class="text-purple-800" href="{{ route('architect.account.profile.index') }}">
						{{ $mediaKit->mediaContact->user->name }}
					</a>
					@elseif ($viewAs == 'journalist')
					<a class="text-purple-800" href="{{ route('journalist.brand.architect', ['architect' => $mediaKit->mediaContact->user->architect->slug]) }}">
						{{ $mediaKit->mediaContact->user->name }}
					</a>
					@endif
				</p>
				<p class="text-secondary fs-6 m-0 p-0">{{ $mediaKit->mediaContact->position->name }}</p>
			</div>
			<div class="col-auto text-purple-700"><i class="bi bi-arrow-up-right"></i></div>
		</div>
	</div>
</div>

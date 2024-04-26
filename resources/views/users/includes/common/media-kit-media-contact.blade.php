<div class="row">
	<div class="col-12">
		<p class="pb-2 m-0 text-dark fs-6">Media Contact</p>
		<div class="row g-3 align-items-center">
			<div class="col-auto">
				@php
					$architectProfileImg = $mediaKit->mediaContact->profileImage ?
											Storage::url($mediaKit->mediaContact->profileImage->image_path) :
											App\Http\Controllers\Users\AvatarController::setProfileAvatar([
												'name' => $mediaKit->mediaContact->user->name,
												'width' => 48,
												'fontSize' => 21,
												'background' => $mediaKit->mediaContact->background_color,
												'foreground' => $mediaKit->mediaContact->foreground_color,
											]);
				@endphp
				<img class="rounded-circle img-square img-48" src="{{ $architectProfileImg }}" alt="..." />
			</div>
			<div class="col-auto">
				<p class="p-0 m-0 fs-6 fw-medium">
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
				<p class="p-0 m-0 text-secondary fs-6">{{ $mediaKit->mediaContact->position->name }}</p>
			</div>
			<div class="col-auto text-purple-700"><i class="bi bi-arrow-up-right"></i></div>
		</div>
	</div>
</div>

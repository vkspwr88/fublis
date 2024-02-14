<p class="text-dark fs-6 py-2">Submitted By</p>
<div class="row align-items-center">
	<div class="col-auto">
		<div class="row g-2">
			<div class="col-auto">
				<img class="rounded-circle img-square img-48" src="{{ $mediaKit->architect->company->profileImage ? Storage::url($mediaKit->architect->company->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
			</div>
			<div class="col">
				<p class="fs-6 fw-medium m-0 p-0">
					@if ($viewAs == 'architect')
					<a class="text-purple-800" href="{{ route('architect.account.studio.index') }}">
						{{ $mediaKit->architect->company->name }}
					</a>
					@elseif ($viewAs == 'journalist')
					<a class="text-purple-800" href="{{ route('journalist.brand.view', ['brand' => $mediaKit->architect->company->slug]) }}">
						{{ $mediaKit->architect->company->name }}
					</a>
					@endif
				</p>
				<p class="fs-6 m-0 p-0">
					<small>
						<a href="{{ $mediaKit->architect->company->website }}" class="text-secondary" target="_blank">{{ trimWebsiteUrl($mediaKit->architect->company->website) }}</a>
					</small>
				</p>
			</div>
		</div>
	</div>
	<div class="col">
		<div class="row g-2 justify-content-end">
			@if($allowedEdit)
				<div class="col-auto">
					{{-- @empty($drafted)
						<a href="{{ route('architect.media-kit.press-release.edit', ['mediaKit' => $mediaKit->slug]) }}" class="text-purple-600">
							<i class="bi bi-pencil-square"></i>
						</a>
					@endempty --}}
					@isset($drafted)
						<a href="{{ route('architect.add-story.article.draft', ['mediaKitDraft' => $mediaKit->id]) }}" class="text-purple-600">
							<i class="bi bi-pencil-square"></i>
						</a>
					@else
						<a href="{{ route('architect.media-kit.press-release.edit', ['mediaKit' => $mediaKit->slug]) }}" class="text-purple-600">
							<i class="bi bi-pencil-square"></i>
						</a>
					@endisset
				</div>
			@endif
			{{-- <div class="col-auto">
				<a href="javascript:;" class="text-purple-600">
					<i class="bi bi-share-fill"></i>
				</a>
			</div> --}}
		</div>
	</div>
</div>
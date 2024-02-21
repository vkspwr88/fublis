<div class="row g-4">
	<div class="col-md-8">
		<h1 class="py-2 m-0 text-dark fs-2 fw-semibold">{{ str()->headline($mediaKit->story->title) }}</h1>
		<div class="py-3 row justify-content-center g-2">
			<div class="col-auto">
				<x-users.tag name="Article" />
			</div>
			<div class="col-auto">
				<x-users.tag :name="$mediaKit->category->name" />
			</div>
		</div>
		<div class="mb-4 row">
			<div class="col text-secondary fs-6">
				{{-- {!! str()->replace('\n', '<br>', $mediaKit->story->article_writeup) !!} --}}
				{{-- {!! $mediaKit->story->project_brief !!} --}}
				{{ $mediaKit->story->preview_text }}
			</div>
		</div>
		<div class="mb-4 row">
			<div class="col text-secondary fs-6">
				{{-- {!! str()->replace('\n', '<br>', $mediaKit->story->article_writeup) !!} --}}
				{!! $mediaKit->story->article_writeup !!}
			</div>
		</div>
		{{-- <div class="row">
			<div class="col-12">
				<img src="{{ Storage::url($mediaKit->story->cover_image_path) }}" width="790" height="400" {{-- style="max-width: 790px; max-height: 400px;" alt="" class="img-fluid" />
			</div>
		</div> --}}
		<div class="row g-4">
			@foreach ($mediaKit->story->images as $photograph)
				<div class="col-md-4">
					<img src="{{ Storage::url($photograph->image_path) }}" width="250" height="164" alt="" class="img-fluid" />
				</div>
			@endforeach
			@if(!empty($mediaKit->story->draftImages))
				@foreach ($mediaKit->story->draftImages as $photograph)
					<div class="col-md-4">
						<img src="{{ Storage::url($photograph) }}" width="250" height="164" alt="" class="img-fluid" />
					</div>
				@endforeach
			@endif
		</div>
	</div>
	<div class="col-md-4">
		@include('users.includes.common.media-kit-submitted-by')
		<hr class="border-gray-300">
		<div class="row">
			<div class="col-12">
				<img src="{{ Storage::url($mediaKit->story->cover_image_path) }}" width="401" height="213" {{-- style="max-width: 401px; max-height: 213px;" --}} class="img-fluid" alt="..." />
			</div>
		</div>
		<hr class="border-gray-300">
		@if ($viewAs == 'architect')
			@include('users.includes.common.profile-article-download-architect')
		@elseif ($viewAs == 'journalist')
			@include('users.includes.common.profile-article-download-journalist')
		@endif
		<hr class="border-gray-300">
		{{-- <div class="row">
			<div class="col-12">
				<p class="pb-2 m-0 text-dark fs-6">Media Contact</p>
				<div class="row g-3 align-items-center">
					<div class="col-auto">
						<img class="rounded-circle img-square img-48" src="{{ $mediaKit->architect->profileImage ? Storage::url($mediaKit->architect->profileImage->image_path) : 'https://via.placeholder.com/48x48' }}" alt="..." />
					</div>
					<div class="col-auto">
						<p class="p-0 m-0 fs-6 fw-medium">
							@if ($viewAs == 'architect')
							<a class="text-purple-800" href="{{ route('architect.account.profile.index') }}">
								{{ $mediaKit->architect->user->name }}
							</a>
							@elseif ($viewAs == 'journalist')
							<a class="text-purple-800" href="{{ route('journalist.brand.architect', ['architect' => $mediaKit->architect->user->architect->slug]) }}">
								{{ $mediaKit->architect->user->name }}
							</a>
							@endif
						</p>
						<p class="p-0 m-0 text-secondary fs-6">{{ $mediaKit->architect->position->name }}</p>
					</div>
					<div class="col-auto text-purple-700"><i class="bi bi-arrow-up-right"></i></div>
				</div>
			</div>
		</div> --}}
		@include('users.includes.common.media-kit-media-contact')
		@include('users.includes.common.media-kit-tags')
	</div>
</div>

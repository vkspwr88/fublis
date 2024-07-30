@isset($drafted)
	<div class="row align-items-center">
		<div class="col">
			<p class="m-0 text-dark fs-6">Description</p>
		</div>
		<div class="col text-end">
			<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->press_release_doc_path ?? $mediaKit->story->press_release_doc_link }}" target="_blank">Download</a>
		</div>
	</div>
	@if ($mediaKit->story->photographs_link || count($mediaKit->story->draftPhotographs) > 0)
		<hr class="border-gray-300">
		<div class="row align-items-center">
			<div class="col">
				<p class="m-0 text-dark fs-6">Photographs</p>
			</div>
			<div class="col text-end">
				@if($mediaKit->story->photographs_link)
					<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->photographs_link }}" target="_blank">Download</a>
				@else
					<a class="btn btn-primary fs-6 fw-medium" href="javascript:;" target="_blank">Download</a>
					{{-- <form class="p-0 m-0" action="{{ route('architect.download.bulk', ['mediaKit' => $mediaKit->slug]) }}" method="post">
						@csrf
						<input type="hidden" value="photographs" name="file">
						<input type="hidden" name="type" value="Photographs">
						<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
					</form> --}}
				@endif
			</div>
		</div>
	@endif
@else
	<div class="row align-items-center">
		<div class="col">
			<p class="m-0 text-dark fs-6">Fact File</p>
		</div>
		<div class="col text-end">
			<form class="p-0 m-0" action="{{ route('architect.media-kit.press-release.pdf', ['mediaKit' => $mediaKit->slug]) }}" method="post">
				@csrf
				<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
			</form>
		</div>
	</div>
	<hr class="border-gray-300">
	<div class="row align-items-center">
		<div class="col">
			<p class="m-0 text-dark fs-6">Description</p>
		</div>
		<div class="col text-end">
			@if ($mediaKit->story->press_release_doc_path)
				<form class="p-0 m-0" action="{{ route('architect.download', ['mediaKit' => $mediaKit->slug]) }}" method="post">
					@csrf
					<input type="hidden" value="{{ $mediaKit->story->press_release_doc_path }}" name="file">
					<input type="hidden" name="type" value="Description">
					<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
				</form>
			@else
				<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->press_release_doc_link }}" target="_blank">Download</a>
			@endif
		</div>
	</div>
	@if ($mediaKit->story->photographs_link || $mediaKit->story->photographs->count() > 0)
		<hr class="border-gray-300">
		<div class="row align-items-center">
			<div class="col">
				<p class="m-0 text-dark fs-6">Photographs</p>
			</div>
			<div class="col text-end">
				@if($mediaKit->story->photographs_link)
					<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->photographs_link }}" target="_blank">Download</a>
				@else
					<form class="p-0 m-0" action="{{ route('architect.download.bulk', ['mediaKit' => $mediaKit->slug]) }}" method="post">
						@csrf
						<input type="hidden" value="photographs" name="file">
						<input type="hidden" name="type" value="Photographs">
						<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
					</form>
				@endif
			</div>
		</div>
	@endif
@endisset

<div class="row align-items-center">
	<div class="col">
		<p class="text-dark fs-6 m-0">Description</p>
	</div>
	<div class="col text-end">
		@if ($mediaKit->story->press_release_doc_path)
			<form class="m-0 p-0" action="{{ route('architect.download', ['mediaKit' => $mediaKit->slug]) }}" method="post">
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
<hr class="border-gray-300">
<div class="row align-items-center">
	<div class="col">
		<p class="text-dark fs-6 m-0">Gallery</p>
	</div>
	<div class="col text-end">
		@if($mediaKit->story->photographs_link)
			<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->photographs_link }}" target="_blank">Download</a>
		@else
			<form class="m-0 p-0" action="{{ route('architect.download.bulk', ['mediaKit' => $mediaKit->slug]) }}" method="post">
				@csrf
				<input type="hidden" value="photographs" name="file">
				<input type="hidden" name="type" value="Gallery">
				<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
			</form>
		@endif
	</div>
</div>

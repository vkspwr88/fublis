<div class="row align-items-center">
	<div class="col">
		<p class="text-dark fs-6 m-0">Description</p>
	</div>
	<div class="col text-end">
		@if ($mediaKit->story->article_doc_path)
			<form class="m-0 p-0" action="{{ route('architect.download', ['mediaKit' => $mediaKit->slug]) }}" method="post">
				@csrf
				<input type="hidden" value="{{ $mediaKit->story->article_doc_path }}" name="file">
				<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
			</form>
		@else
			<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->article_doc_link }}" target="_blank">Download</a>
		@endif
		{{-- <a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->article_doc_path ? Storage::download($mediaKit->story->article_doc_path) : $mediaKit->story->article_doc_link }}" target="_blank">Download</a> --}}
	</div>
</div>
<hr class="border-gray-300">
<div class="row align-items-center">
	<div class="col">
		<p class="text-dark fs-6 m-0">Gallery</p>
	</div>
	<div class="col text-end">
		@if($mediaKit->story->images_link)
			<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->images_link }}" target="_blank">Download</a>
		@else
			<form class="m-0 p-0" action="{{ route('architect.download.bulk', ['mediaKit' => $mediaKit->slug]) }}" method="post">
				@csrf
				<input type="hidden" value="images" name="file">
				<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
			</form>
		@endif
	</div>
</div>
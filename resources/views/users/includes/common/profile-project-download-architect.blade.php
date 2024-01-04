<div class="row align-items-center">
	<div class="col">
		<p class="text-dark fs-6 m-0">Description</p>
	</div>
	<div class="col text-end">
		@if ($mediaKit->story->project_doc_path)
			<form class="m-0 p-0" action="{{ route('architect.download', ['mediaKit' => $mediaKit->slug]) }}" method="post">
				@csrf
				<input type="hidden" value="{{ $mediaKit->story->project_doc_path }}" name="file">
				<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
			</form>
		@else
			<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->project_doc_link }}" target="_blank">Download</a>
		@endif
	</div>
</div>
<hr class="border-gray-300">
<div class="row align-items-center">
	<div class="col">
		<p class="text-dark fs-6 m-0">Gallery</p>
	</div>
	<div class="col text-end">
		<form class="m-0 p-0" action="{{ route('architect.download.bulk', ['mediaKit' => $mediaKit->slug]) }}" method="post">
			@csrf
			<input type="hidden" value="photographs" name="file">
			<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
		</form>
	</div>
</div>
<hr class="border-gray-300">
<div class="row align-items-center">
	<div class="col">
		<p class="text-dark fs-6 m-0">Render/Drawings</p>
	</div>
	<div class="col text-end">
		<form class="m-0 p-0" action="{{ route('architect.download.bulk', ['mediaKit' => $mediaKit->slug]) }}" method="post">
			@csrf
			<input type="hidden" value="drawings" name="file">
			<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
		</form>
	</div>
</div>
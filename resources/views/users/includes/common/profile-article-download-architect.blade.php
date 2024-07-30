@isset($drafted)
	@if ($mediaKit->story->company_profile_path || $mediaKit->story->company_profile_link)
		<div class="row align-items-center">
			<div class="col">
				<p class="m-0 text-dark fs-6">Company Profile</p>
			</div>
			<div class="col text-end">
				@if ($mediaKit->story->company_profile_path)
					<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->company_profile_path }}" target="_blank">Download</a>
				@else
					<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->company_profile_link }}" target="_blank">Download</a>
				@endif
			</div>
		</div>
		<hr class="border-gray-300">
	@endif
		<div class="row align-items-center">
			<div class="col">
				<p class="m-0 text-dark fs-6">Full Article</p>
			</div>
			<div class="col text-end">
				@if ($mediaKit->story->article_doc_path)
					<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->article_doc_path }}" target="_blank">Download</a>
				@else
					<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->article_doc_link }}" target="_blank">Download</a>
				@endif
			</div>
		</div>
	@if ($mediaKit->story->images_link || count($mediaKit->story->draftImages) > 0)
		<hr class="border-gray-300">
		<div class="row align-items-center">
			<div class="col">
				<p class="m-0 text-dark fs-6">Photographs</p>
			</div>
			<div class="col text-end">
				@if($mediaKit->story->images_link)
					<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->images_link }}" target="_blank">Download</a>
				@else
					<a class="btn btn-primary fs-6 fw-medium" href="javascript:;" target="_blank">Download</a>
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
			<form class="p-0 m-0" action="{{ route('architect.media-kit.article.pdf', ['mediaKit' => $mediaKit->slug]) }}" method="post">
				@csrf
				<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
			</form>
		</div>
	</div>
	<hr class="border-gray-300">
	@if ($mediaKit->story->company_profile_path || $mediaKit->story->company_profile_link)
		<div class="row align-items-center">
			<div class="col">
				<p class="m-0 text-dark fs-6">Company Profile</p>
			</div>
			<div class="col text-end">
				@if ($mediaKit->story->company_profile_path)
					<form class="p-0 m-0" action="{{ route('architect.download', ['mediaKit' => $mediaKit->slug]) }}" method="post">
						@csrf
						<input type="hidden" value="{{ $mediaKit->story->company_profile_path }}" name="file">
						<input type="hidden" name="type" value="CompanyProfile">
						<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
					</form>
				@else
					<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->company_profile_link }}" target="_blank">Download</a>
				@endif
			</div>
		</div>
		<hr class="border-gray-300">
	@endif
	<div class="row align-items-center">
		<div class="col">
			<p class="m-0 text-dark fs-6">Full Article</p>
		</div>
		<div class="col text-end">
			@if ($mediaKit->story->article_doc_path)
				<form class="p-0 m-0" action="{{ route('architect.download', ['mediaKit' => $mediaKit->slug]) }}" method="post">
					@csrf
					<input type="hidden" value="{{ $mediaKit->story->article_doc_path }}" name="file">
					<input type="hidden" name="type" value="FullArticle">
					<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
				</form>
			@else
				<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->article_doc_link }}" target="_blank">Download</a>
			@endif
			{{-- <a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->article_doc_path ? Storage::download($mediaKit->story->article_doc_path) : $mediaKit->story->article_doc_link }}" target="_blank">Download</a> --}}
		</div>
	</div>
	@if ($mediaKit->story->images_link || $mediaKit->story->images->count() > 0)
		<hr class="border-gray-300">
		<div class="row align-items-center">
			<div class="col">
				<p class="m-0 text-dark fs-6">Photographs</p>
			</div>
			<div class="col text-end">
				@if($mediaKit->story->images_link)
					<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->images_link }}" target="_blank">Download</a>
				@else
					<form class="p-0 m-0" action="{{ route('architect.download.bulk', ['mediaKit' => $mediaKit->slug]) }}" method="post">
						@csrf
						<input type="hidden" value="images" name="file">
						<input type="hidden" name="type" value="Photographs">
						<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
					</form>
				@endif
			</div>
		</div>
	@endif
@endisset


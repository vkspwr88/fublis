@if($downloadRequest)
	@if($downloadRequest->request_status === App\Enums\Users\Architects\MediaKits\RequestStatusEnum::APPROVED)
		<div class="row align-items-center">
			<div class="col">
				<p class="text-dark fs-6 m-0">Company Profile</p>
			</div>
			<div class="col text-end">
				@if ($mediaKit->story->article_doc_path)
					<form class="m-0 p-0" action="{{ route('architect.download', ['mediaKit' => $mediaKit->slug]) }}" method="post">
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
		<div class="row align-items-center">
			<div class="col">
				<p class="text-dark fs-6 m-0">Description</p>
			</div>
			<div class="col text-end">
				@if ($mediaKit->story->article_doc_path)
					<form class="m-0 p-0" action="{{ route('journalist.download', ['mediaKit' => $mediaKit->slug]) }}" method="post">
						@csrf
						<input type="hidden" value="{{ $mediaKit->story->article_doc_path }}" name="file">
						<input type="hidden" name="type" value="Description">
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
					<form class="m-0 p-0" action="{{ route('journalist.download.bulk', ['mediaKit' => $mediaKit->slug]) }}" method="post">
						@csrf
						<input type="hidden" value="images" name="file">
						<input type="hidden" name="type" value="Gallery">
						<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
					</form>
				@endif
			</div>
		</div>
	@else
		<div class="row">
			<div class="col">
				@if($downloadRequest->request_status === App\Enums\Users\Architects\MediaKits\RequestStatusEnum::PENDING)
					<button type="button" class="btn btn-success fs-6 fw-medium">Download Requested</button>
				@elseif($downloadRequest->request_status === App\Enums\Users\Architects\MediaKits\RequestStatusEnum::DECLINED)
					<button type="button" class="btn btn-danger fs-6 fw-medium">Download Declined</button>
				@endif
			</div>
		</div>
	@endif
@else
	<div class="row">
		<div class="col">
			<form class="m-0 p-0" action="{{ route('journalist.download.request', ['mediaKit' => $mediaKit->slug]) }}" method="post">
				@csrf
				<button type="submit" class="btn btn-primary fs-6 fw-medium">Request Download</button>
			</form>
		</div>
	</div>
@endif

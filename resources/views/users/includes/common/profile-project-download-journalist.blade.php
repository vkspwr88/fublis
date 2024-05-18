@if( ($downloadRequest && $downloadRequest->request_status === App\Enums\Users\Architects\MediaKits\RequestStatusEnum::APPROVED) || $mediaKit->projectAccess->name === 'open to all')
	<div class="row align-items-center">
		<div class="col-auto">
			<p class="m-0 text-dark fs-6">Description</p>
		</div>
		<div class="col text-end">
			@if ($mediaKit->story->project_doc_path)
				<form class="p-0 m-0" action="{{ route('journalist.download', ['mediaKit' => $mediaKit->slug]) }}" method="post">
					@csrf
					<input type="hidden" value="{{ $mediaKit->story->project_doc_path }}" name="file">
					<input type="hidden" name="type" value="Description">
					<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
				</form>
			@else
				<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->story->project_doc_link }}" target="_blank">Download</a>
			@endif
		</div>
	</div>
	@if ( $mediaKit->story->photographs_link || ($mediaKit->story->photographs && $mediaKit->story->photographs->where('image_type', 'photographs')->count() > 0) )
		<hr class="border-gray-300">
		<div class="row align-items-center">
			<div class="col-auto">
				<p class="m-0 text-dark fs-6">Photographs</p>
			</div>
			<div class="col text-end">
				<form class="p-0 m-0" action="{{ route('journalist.download.bulk', ['mediaKit' => $mediaKit->slug]) }}" method="post">
					@csrf
					<input type="hidden" value="photographs" name="file">
					<input type="hidden" name="type" value="Photographs">
					<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
				</form>
			</div>
		</div>
	@endif
	@if ( $mediaKit->story->drawings_link || ($mediaKit->story->photographs && $mediaKit->story->photographs->where('image_type', 'drawings')->count() > 0) )
		<hr class="border-gray-300">
		<div class="row align-items-center">
			<div class="col-auto">
				<p class="m-0 text-dark fs-6">Render/Drawings</p>
			</div>
			<div class="col text-end">
				<form class="p-0 m-0" action="{{ route('journalist.download.bulk', ['mediaKit' => $mediaKit->slug]) }}" method="post">
					@csrf
					<input type="hidden" value="drawings" name="file">
					<input type="hidden" name="type" value="Drawings">
					<button type="submit" class="btn btn-primary fs-6 fw-medium">Download</button>
				</form>
			</div>
		</div>
	@endif
@elseif ($downloadRequest)
	<div class="row">
		<div class="col">
			@if($downloadRequest->request_status === App\Enums\Users\Architects\MediaKits\RequestStatusEnum::PENDING)
				<button type="button" class="btn btn-success fs-6 fw-medium">Download Requested</button>
			@elseif($downloadRequest->request_status === App\Enums\Users\Architects\MediaKits\RequestStatusEnum::DECLINED)
				<button type="button" class="btn btn-danger fs-6 fw-medium">Download Declined</button>
			@endif
		</div>
	</div>
@else
	<div class="row">
		<div class="col">
			<form class="p-0 m-0" action="{{ route('journalist.download.request', ['mediaKit' => $mediaKit->slug]) }}" method="post">
				@csrf
				<button type="submit" class="btn btn-primary fs-6 fw-medium">Request Download</button>
			</form>
		</div>
	</div>
@endif

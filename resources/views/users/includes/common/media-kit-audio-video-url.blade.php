@if ($mediaKit->audio_video_url)
	<div class="row align-items-center">
		<div class="col">
			<p class="m-0 text-dark fs-6">Audio / Video Url</p>
		</div>
		<div class="col text-end">
			<a class="btn btn-primary fs-6 fw-medium" href="{{ $mediaKit->audio_video_url }}" target="_blank">View</a>
		</div>
	</div>
@endif

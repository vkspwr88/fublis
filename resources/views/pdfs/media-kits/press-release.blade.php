@extends('pdfs.media-kits.layout', [
	'title' => str()->headline($mediaKit->story->title),
])

@section('content')
	<table class="table">
		<tr>
			<th>Media Kit Type</th>
			<td>Press Release</td>
		</tr>
		<tr>
			<th>Title</th>
			<td>{{ str()->headline($mediaKit->story->title) }}</td>
		</tr>
		<tr>
			<th>Company</th>
			<td>{{ $mediaKit->architect->company->name }}</td>
		</tr>
		<tr>
			<th>Company Website</th>
			<td>
				<a href="{{ $mediaKit->architect->company->website }}" target="_blank">
					{{ trimWebsiteUrl($mediaKit->architect->company->website) }}
				</a>
			</td>
		</tr>
		<tr>
			<th>Category</th>
			<td>{{ $mediaKit->category->name }}</td>
		</tr>
		<tr>
			<th>Image Credits</th>
			<td>{{ $mediaKit->story->image_credits ?? '-' }}</td>
		</tr>
		<tr>
			<th>Concept Note</th>
			<td>{{ $mediaKit->story->concept_note }}</td>
		</tr>
		<tr>
			<th>Audio/Video URL</th>
			<td>{{ $mediaKit->audio_video_url ?? '-'; }}</td>
		</tr>
		<tr>
			<th>Tags</th>
			<td>{{ $mediaKit->story->tags->count() ? $mediaKit->story->tags->implode('name', ', ') : '-'; }}</td>
		</tr>
		{{-- <tr>
			<th>Write Up</th>
			<td>{!! $mediaKit->story->press_release_writeup !!}</td>
		</tr> --}}
	</table>
	<div>
		<h4>Write Up</h4>
		{!! $mediaKit->story->press_release_writeup !!}
	</div>
@endsection

@extends('pdfs.media-kits.layout', [
	'title' => str()->headline($mediaKit->story->title),
])

@section('content')
	@php
		$city = $state = $country = '';
		$cityDB = $mediaKit->story->location->city()->first();
		if($cityDB){
			$city = $mediaKit->story->location->name;
			$stateDB = $cityDB->state;
			$state = str()->headline($stateDB->name);
			$countryDB = $stateDB->country;
			$country = str()->headline($countryDB->name);
		}
		else{
			$country = $mediaKit->story->location->name;
			if($country){
				$state = $mediaKit->story->state->name ?? '';
				$city = $mediaKit->story->city->name ?? '';
			}
		}
	@endphp
	<table class="table">
		<tr>
			<th>Media Kit Type</th>
			<td>Project</td>
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
			<th>Site Area</th>
			<td>{{ $mediaKit->story->site_area > 0 ? $mediaKit->story->site_area : '-' }} {{ $mediaKit->story->siteAreaUnit->name ?? '' }}</td>
		</tr>
		<tr>
			<th>Built Up Area</th>
			<td>{{ $mediaKit->story->built_up_area > 0 ? $mediaKit->story->built_up_area : '-' }} {{ $mediaKit->story->builtUpAreaUnit->name ?? '' }}</td>
		</tr>
		<tr>
			<th>Materials</th>
			<td>{{ $mediaKit->story->materials ?? '-' }}</td>
		</tr>
		<tr>
			<th>Building Typology</th>
			<td>{{ $mediaKit->story->country->name ?? '-' }}</td>
		</tr>
		<tr>
			<th>Building Use</th>
			<td>{{ $mediaKit->story->country->name ?? '-' }}</td>
		</tr>
		<tr>
			<th>Country</th>
			<td>{{ $country ?? '-' }}</td>
		</tr>
		<tr>
			<th>State</th>
			<td>{{ $state ?? '-' }}</td>
		</tr>
		<tr>
			<th>City</th>
			<td>{{ $city ?? '-' }}</td>
		</tr>
		<tr>
			<th>Status</th>
			<td>{{ $mediaKit->story->projectStatus->name ?? '-' }}</td>
		</tr>
		<tr>
			<th>Image Credits</th>
			<td>{{ $mediaKit->story->image_credits ?? '-' }}</td>
		</tr>
		<tr>
			<th>Text Credits</th>
			<td>{{ $mediaKit->story->text_credits ?? '-' }}</td>
		</tr>
		<tr>
			<th>Render Credits</th>
			<td>{{ $mediaKit->story->render_credits ?? '-' }}</td>
		</tr>
		<tr>
			<th>Consultants</th>
			<td>{{ $mediaKit->story->consultants ?? '-' }}</td>
		</tr>
		<tr>
			<th>Design Team</th>
			<td>{{ $mediaKit->story->design_team ?? '-' }}</td>
		</tr>
		<tr>
			<th>Project Brief</th>
			<td>{{ $mediaKit->story->project_brief }}</td>
		</tr>
		<tr>
			<th>Audio/Video URL</th>
			<td>{{ $mediaKit->audio_video_url ?? '-'; }}</td>
		</tr>
		<tr>
			<th>Tags</th>
			<td>{{ $mediaKit->story->tags->count() ? $mediaKit->story->tags->implode('name', ', ') : '-'; }}</td>
		</tr>
	</table>
@endsection

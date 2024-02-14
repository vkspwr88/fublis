@extends('users.layouts.master')

{!! seo() !!}

{{-- @push('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css" rel="stylesheet" />
<style>
	.bootstrap-tagsinput{
		width: 100%;
	}
	.label-info{
		background: var(--fublis-purple-700);
		padding: 2px 10px 4px;
  		border-radius: 15px;
	}
</style>
@endpush --}}

@section('body')
<div class="container py-5">
	@include('users.includes.architect.add-story-steps')

	<div class="row justify-content-center pt-5">
		<div class="col-md-11">
			<h4 class="text-purple-600 fs-3 fw-semibold m-0 py-2">Submit Press Release</h4>
			<livewire:architects.add-stories.press-release />
		</div>
	</div>
</div>
@endsection
{{--
@push('scripts')
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.js"></script>
<script>
	$('#inputTags').tagsinput({
		allowDuplicates: false,
		trimValue: true,
		confirmKeys: [13, 44],
		/* typeahead: {
    		source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo']
  		} */
	});
</script>
@endpush --}}

@include('users.includes.architect.add-story.media-kit-form-script')


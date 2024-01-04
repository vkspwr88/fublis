@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	@include('users.includes.common.profile-article', ['mediaKit' => $mediaKit, 'allowedEdit' => false, 'viewAs' => 'journalist'])
</div>
@endsection

@if (session('type') && session('message'))
	@push('scripts')
		<script>
			const alertEvent = new CustomEvent('alert', {
				detail : [{
					type : '{{ session('type') }}',
					message : '{{ session('message') }}',
				}]
			});
			window.dispatchEvent(alertEvent);
		</script>
	@endpush
@endif

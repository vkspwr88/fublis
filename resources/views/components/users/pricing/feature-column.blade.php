{{-- <div class="col-md-6">
	<div class="row gx-2">
		<div class="col-auto">
			<x-users.icons.green-checkbox />
		</div>
		<div class="col fs-6">{{ $feature }}</div>
	</div>
</div> --}}
<div class="col-12">
	<div class="row gx-2">
		<div class="col-auto">
			@if($available)
				<x-users.pricing.features.available />
			@else
				<x-users.pricing.features.not-available />
			@endif
		</div>
		<div class="col fs-6 text-secondary">
			{!! 
				Str::inlineMarkdown($feature, [
					'html_input' => 'strip',
					'allow_unsafe_links' => false,
				])
			!!}
		</div>
	</div>
</div>		

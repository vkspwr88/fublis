<div class="row align-items-center pt-4">
	<div class="col-12">
		<div class="row justify-content-center">
			<div class="col-md-8">
				<div class="row">
					<div class="col-6">
						<div class="step-line bg-gray-200 w-100 position-relative"></div>
					</div>
					<div class="col-6">
						<div class="step-line bg-gray-200 w-100 position-relative"></div>
					</div>
				</div>
			</div>
		</div>

		<div class="row align-items-center">
			@foreach ($steps as $step)
				@if(!$loop->last)
				<div class="col-lg-4 steps {{ $step->isPrevious() ? 'step-complete' : '' }} {{ $step->isCurrent() ? 'step-current' : '' }} {{ $step->isNext() ? 'step-incomplete' : '' }}">
					<div class="d-flex justify-content-center align-items-center">
						<div class="step-icon rounded-circle">
							@if ($step->isPrevious())
							<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M17.0965 7.38967L9.9365 14.2997L8.0365 12.2697C7.6865 11.9397 7.1365 11.9197 6.7365 12.1997C6.3465 12.4897 6.2365 12.9997 6.4765 13.4097L8.7265 17.0697C8.9465 17.4097 9.3265 17.6197 9.7565 17.6197C10.1665 17.6197 10.5565 17.4097 10.7765 17.0697C11.1365 16.5997 18.0065 8.40967 18.0065 8.40967C18.9065 7.48967 17.8165 6.67967 17.0965 7.37967V7.38967Z" fill="white"/>
							</svg>
							@else
							<div class="inner-circle rounded-circle"></div>
							@endif
						</div>
					</div>
					<div class="row align-items-center pt-2">
						<div class="col-12">
							<p class="step-title text-center fs-6 fw-semibold m-0 p-0">{{ $step->title }}</p>
							<p class="step-subtitle text-center fs-6 fw-normal m-0 p-0">{{ $step->subtitle }}</p>
						</div>
					</div>
				</div>
				@endif
			@endforeach
		</div>
	</div>
</div>

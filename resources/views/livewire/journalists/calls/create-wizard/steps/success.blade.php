<div id="createSuccessCall">
	<div class="top-0 bottom-0 position-fixed start-0 end-0 w-100 h-100 bg-dark" style="z-index: 10000;"></div>
	<div class="p-5 mx-auto text-center bg-white position-relative rounded-4" style="z-index: 10001; max-width: 49.875rem;">
		<div class="row justify-content-center">
			<div class="col">
				<h2 class="py-2 m-0 text-purple-900 fs-1 fw-semibold">
					Your call for submissions
					<br/>
					has been successfully posted.
				</h2>
				<p class="py-2 m-0">
					You can check story responses in your Conversations or
					<br/>
					<a href="{{ route('journalist.call.create') }}" class="text-purple-600">post another call</a> for submissions.
					<br>
					<br>
					<a href="{{ route('journalist.call.index') }}" class="btn btn-primary fs-6 fw-medium">Okay</a>
				</p>
			</div>
		</div>
	</div>
</div>

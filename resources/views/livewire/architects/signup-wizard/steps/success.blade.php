<div>
	@include('livewire.architects.signup-wizard.navigation')
	<div class="row bg-white justify-content-center pt-5">
		<div class="col-lg-10">
			<div class="card rounded-4 shadow border border-1">
				<div class="row justify-content-between align-items-center">
					<div class="col-12">
						<div class="row justify-content-center">
							<div class="col-lg-10">
								<div class="card-body p-5 text-center">
									<h5 class="card-title text-purple-900 fs-3 fw-semibold m-0 py-3">Great!<br>You’re all set to go.</h5>
									<p class="card-text text-secondary fs-6 fw-normal m-0 py-3">Getting published was never this easy. Pitch your latest projects, press releases, brand stories to journalists. Start creating your media kits now.</p>
									<p class="card-text m-0 py-3">
										<a class="btn btn-primary fs-6 fw-semibold" href="{{ route('architect.add-story.index') }}">Let Go!</a>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

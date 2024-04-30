<div>
	@include('livewire.architects.signup-wizard.navigation')
	<div class="pt-5 bg-white row justify-content-center">
		<div class="col-lg-10">
			<div class="border shadow card rounded-4 border-1">
				<div class="row justify-content-between align-items-center">
					<div class="col-12">
						<div class="row justify-content-center">
							<div class="col-lg-10">
								<div class="p-5 text-center card-body">
									<h5 class="py-3 m-0 text-purple-900 card-title fs-3 fw-semibold">Great!<br>You’re all set to go.</h5>
									<p class="py-3 m-0 card-text text-secondary fs-6 fw-normal">Getting published was never this easy. Pitch your latest projects, press releases, brand stories to journalists. Start creating your media kits now.</p>
									<p class="py-3 m-0 card-text">
										<a class="btn btn-primary fs-6 fw-semibold" href="{{ route('architect.add-story.index') }}">Let's Go!</a>
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

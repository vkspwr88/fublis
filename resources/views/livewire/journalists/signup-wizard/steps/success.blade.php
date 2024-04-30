<div>
	@include('livewire.journalists.signup-wizard.navigation')
	<div class="pt-5 bg-white row justify-content-center">
		<div class="col-lg-10">
			<div class="border shadow card rounded-4 border-1">
				<div class="row justify-content-between align-items-center">
					<div class="col-12">
						<div class="row justify-content-center">
							<div class="col-lg-10">
								<div class="p-5 text-center card-body">
									<h5 class="py-3 m-0 text-purple-900 card-title fs-3 fw-semibold">Great!<br>You're all set to go.</h5>
									<p class="py-3 m-0 card-text text-secondary fs-6 fw-normal">Start exploring the media kits readily available to publish. You can also use Fublis to invite stories that match your requirements for the upcoming issues.</p>
									<p class="py-3 m-0 card-text">
										<a class="btn btn-primary fs-6 fw-semibold" href="{{ route('journalist.media-kit.index') }}">Let's Go!</a>
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

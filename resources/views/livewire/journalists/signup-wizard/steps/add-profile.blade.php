<div>
	@include('livewire.journalists.signup-wizard.navigation')

	<div class="pt-5 bg-white row justify-content-center">
		<div class="col-lg-10">
			<div class="border shadow card rounded-4 border-1">
				<div class="row g-0 align-items-center">
					<div class="col-md-6">
						<div class="row justify-content-between align-items-center">
							<div class="col-12">
								<div class="px-5 card-body">
									<form class="py-3" wire:submit="add">
										<div class="mb-3">
											<label for="selectPosition" class="form-label text-dark fs-6 fw-medium">Your Position in Platform <span class="text-danger">*</span></label>
											<select class="form-select @error('position') is-invalid @enderror" id="selectPosition" wire:model="position">
												<option value="">Select Your Position</option>
												@foreach ($positions as $position)
												<option value="{{ $position->id }}">{{ $position->name }}</option>
												@endforeach
											</select>
											@error('position')<div class="invalid-feedback">{{ $message }}</div>@enderror
										</div>
										<div class="mb-3">
											<label for="inputLinkedinProfile" class="form-label text-dark fs-6 fw-medium">LinkedIn profile <span class="text-danger">*</span></label>
											<div class="input-group">
												<span class="bg-white input-group-text" id="linkedinProfileAddon">http://</span>
												<input type="text" class="form-control @error('linkedinProfile') is-invalid @enderror" id="inputLinkedinProfile" placeholder="www.your-website.com" aria-label="LinkedIn profile" aria-describedby="linkedinProfileAddon" wire:model="linkedinProfile">
												@error('linkedinProfile')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div>
										</div>
										<div class="mb-3">
											<label for="inputPublishedArticleLink" class="form-label text-dark fs-6 fw-medium">Link to your published article</label>
											<div class="input-group">
												<span class="bg-white input-group-text" id="publishedArticleLinkAddon">http://</span>
												<input type="text" class="form-control @error('publishedArticleLink') is-invalid @enderror" id="inputPublishedArticleLink" placeholder="www.your-website.com" aria-label="Link to your published article" aria-describedby="publishedArticleLinkAddon" wire:model="publishedArticleLink">
												@error('publishedArticleLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div>
										</div>
										<div class="mb-3">
											<label for="inputPublishingPlatformLink" class="form-label text-dark fs-6 fw-medium">Link to your profile on the publishing platform</label>
											<div class="input-group">
												<span class="bg-white input-group-text" id="publishingPlatformLinkAddon">http://</span>
												<input type="text" class="form-control @error('publishingPlatformLink') is-invalid @enderror" id="inputPublishingPlatformLink" placeholder="www.your-website.com" aria-label="Link to your profile on the publishing platform" aria-describedby="publishingPlatformLinkAddon" wire:model="publishingPlatformLink">
												@error('publishingPlatformLink')<div class="invalid-feedback">{{ $message }}</div>@enderror
											</div>
										</div>
										<div class="d-grid">
											<button class="btn btn-primary fs-6 fw-semibold" type="submit">
												Submit <x-users.spinners.white-btn wire:target="add" />
											</button>
										</div>
									</form>
								</div>
							</div>
						</div>
					</div>
					<x-users.auth.image-column :src="asset('images/signup/fublis.png')" />
				</div>
			</div>
		</div>
	</div>
</div>


<div class="col-12">
	@php
		use Illuminate\Support\HtmlString;
	@endphp
	@if($posts->count() > 0)
	<div class="row g-4">
		@foreach ($posts as $post)
			<div class="col-12" wire:key="{{ $post->id }}">
				<div class="border-0 shadow card rounded-4">
					<div class="card-body">
						<div class="row g-3">
							<div class="col-12">
								<div class="pb-2 row justify-content-center">
									<p class="m-0 text-secondary fs-6 fw-semibold col">{{ $post->story_type }}</p>
									<p class="m-0 text-end text-secondary fs-6 fw-semibold col">{{ $post->category->name }}</p>
								</div>
							</div>
							<div class="col-12">
								<a class="text-dark" href="{{ $post->post_url }}" target="_blank">
									<h4 class="fs-5 fw-semibold">{{ new HtmlString($post->meta_title) }}</h4>
									<p class="fs-6">
										@if($post->meta_content)
											{{ $post->meta_content }}
										@else
											{{ $post->post_url }}
										@endif
									</p>
								</a>
							</div>
							<div class="col-12">
								<div class="row align-items-center">
									<div class="col">
										<p class="m-0 text-dark fs-6 fw-bold">
											@php
												$profileImg = $post->publication->profileImage ?
																Storage::url($post->publication->profileImage->image_path) :
																App\Http\Controllers\Users\AvatarController::setProfileAvatar([
																	'name' => $post->journalist->user->name,
																	'width' => 150,
																	'fontSize' => 60,
																	'background' => $post->journalist->background_color,
																	'foreground' => $post->journalist->foreground_color,
																]);
											@endphp
											<img class="rounded-circle img-square img-30 me-2" src="{{ $profileImg }}" alt="..." />
											{{ $post->publication->name }}
										</p>
									</div>
									@if (isJournalist() && $post->journalist_id == auth()->user()->journalist->id)
										<div class="col text-end">
											<button class="btn btn-sm btn-primary" wire:click="deletePost('{{ $post->id }}')">
												<i class="bi bi-trash3" {{-- wire:loading.remove="deletePost('{{ $post->id }}')" --}}></i>
												<x-users.spinners.white-btn wire:target="deletePost('{{ $post->id }}')" />
											</button>
										</div>
									@endif
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		@endforeach
	</div>
	{{ $posts->links('vendor.livewire.custom-pagination') }}
	@else
	<div class="row">
		<div class="col-12">
			<div class="bg-white border-0 shadow card rounded-3">
				<div class="text-center card-body">
					<h4 class="py-3 m-0 text-purple-900 card-title fs-5 fw-semibold">No result found.</h4>
				</div>
			</div>
		</div>
	</div>
	@endif
</div>

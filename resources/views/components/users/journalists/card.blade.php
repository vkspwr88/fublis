<div class="col-12">
    <div class="card border-0 rounded-3 bg-white shadow">
        <div class="card-body">
            <div class="row gx-2 gy-4">
                <div class="col-sm-3">
                    <div class="d-block mx-auto text-center">
                        <img src="{{ $journalist->profileImage ? Storage::url($journalist->profileImage->image_path) : 'https://via.placeholder.com/150x150' }}" class="img-square img-150" alt="...">
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="row align-items-center pb-4">
                        <p class="fs-6 col m-0">
							@if ($journalist->location)
								<span class="badge rounded-pill text-bg-secondary mb-1">
									<i class="bi bi-geo-alt"></i>
									{{ $journalist->location->name }}
								</span>
							@endif
                            {{-- <span class="badge rounded-pill text-bg-secondary mb-1">
                                <i class="bi bi-geo-alt"></i>
                                {{ $journalist->publications[0]->location->name }}
                            </span> --}}
                            @foreach ($journalist->publications[0]->publicationTypes as $publicationType)
                            	<span class="badge rounded-pill text-bg-secondary mb-1">{{ $publicationType->name }}</span>
                            @endforeach
                            @if($journalist->language)
                            <span class="badge rounded-pill text-bg-secondary mb-1">
                                {{ $journalist->language->name }}
                            </span>
                            @endif
                        </p>
                        @if(isArchitect())
							<p class="text-end fs-6 col m-0">
								<button type="button" class="btn btn-primary btn-sm fw-medium" wire:click="pitchJournalist('{{ $journalist->id }}')">
									Submit Story <x-users.spinners.white-btn wire:target="pitchJournalist('{{ $journalist->id }}')" />
								</button>
							</p>
						@elseif(isJournalist())
						@else
							<p class="text-end fs-6 col m-0">
								<button type="button" class="btn btn-primary btn-sm fw-medium" onclick="createAccountPrompt()">
									Submit Story
								</button>
							</p>
                        @endif
                    </div>
                    <div class="row justify-content-center pb-2">
                        <div class="col">
                            <h5 class="fs-5 fw-semibold m-0">
								@if(isArchitect())
									<a class="text-dark" href="{{ route('architect.pitch-story.journalists.view', ['journalist' => $journalist->slug]) }}">{{ $journalist->user->name }}</a>
								@elseif(isJournalist())
									<a class="text-dark" href="{{ route('journalist.account.profile.journalists.view', ['journalist' => $journalist->slug]) }}">{{ $journalist->user->name }}</a>
								@else
									<a class="text-dark" href="javascript:;" onclick="createAccountPrompt()"><span class="small">{{ $journalist->user->name }}</span></a>
								@endif
                            </h5>
                            <p class="text-secondary fs-6 m-0 p-0"><span class="small">{{ $journalist->position->name }}</span></p>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="row align-items-center g-2">
                                <div class="col-auto">
                                    <img src="{{ $journalist->publications[0]->profileImage ? Storage::url($journalist->publications[0]->profileImage->image_path) : 'https://via.placeholder.com/30x30' }}" style="max-width: 30px; max-height: 30px;" class="img-fluid rounded-circle" alt="..." />
                                </div>
                                <div class="col">
                                    <p class="fs-6 m-0 p-0 fw-bold">
                                        @if(isArchitect())
                                            <a class="text-dark" href="{{ route('architect.pitch-story.publications.view', ['publication' => $journalist->publications[0]->slug]) }}"><span class="small">{{ $journalist->publications[0]->name }}</span></a>
                                        @elseif(isJournalist())
                                            <a class="text-dark" href="{{ route('journalist.account.profile.publications.view', ['publication' => $journalist->publications[0]->slug]) }}"><span class="small">{{ $journalist->publications[0]->name }}</span></a>
										@else
											<a class="text-dark" href="javascript:;" onclick="createAccountPrompt()"><span class="small">{{ $journalist->publications[0]->name }}</span></a>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <div class="d-flex justify-content-end align-items-center flex-wrap fw-medium">
                                @foreach ($journalist->publications[0]->categories as $category)
                                    <span class="badge rounded-pill bg-purple-50 text-purple-700">{{ $category->name }}</span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

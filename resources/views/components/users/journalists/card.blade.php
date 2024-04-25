<div class="col-12">
    <div class="bg-white border-0 shadow card rounded-3">
        <div class="card-body">
            <div class="row gx-2 gy-4">
                <div class="col-sm-3">
                    <div class="mx-auto text-center d-block">
						@php
							use App\Http\Controllers\Users\AvatarController as AvatarController;
							$profileImg = $journalist->profileImage ?
												Storage::url($journalist->profileImage->image_path) :
												AvatarController::setProfileAvatar([
													'name' => $journalist->user->name,
													'width' => 150,
													'fontSize' => 75,
													'background' => $journalist->background_color,
													'foreground' => $journalist->foreground_color,
												]);
							$cardImg = '<img src="' . $profileImg . '" class="img-square img-150" alt="...">';
						@endphp
						@if(isArchitect())
							<a href="{{ route('architect.pitch-story.journalists.view', ['journalist' => $journalist->slug]) }}">
								{!! $cardImg !!}
							</a>
						@elseif(isJournalist())
							<a href="{{ route('journalist.account.profile.journalists.view', ['journalist' => $journalist->slug]) }}">
								{!! $cardImg !!}
							</a>
						@else
							<a href="javascript:;" onclick="createAccountPrompt()">
								{!! $cardImg !!}
							</a>
						@endif
                    </div>
                </div>
                <div class="col-sm-9">
                    <div class="pb-4 row align-items-center">
                        <p class="m-0 fs-6 col">
							@if ($journalist->location)
								<x-utility.badges.secondary-badge :text="$journalist->location->name" icon='<i class="bi bi-geo-alt"></i>' />
							@endif
                            @foreach ($journalist->publications[0]->publicationTypes as $publicationType)
								<x-utility.badges.secondary-badge :text="$publicationType->name" />
                            @endforeach
                            @if($journalist->language)
								<x-utility.badges.secondary-badge :text="$journalist->language->name" />
                            @endif
                        </p>
                        @if(isArchitect())
							<p class="m-0 text-end fs-6 col">
								<button type="button" class="btn btn-primary btn-sm fw-medium" wire:click="pitchJournalist('{{ $journalist->id }}')">
									Submit Story <x-users.spinners.white-btn wire:target="pitchJournalist('{{ $journalist->id }}')" />
								</button>
							</p>
						@elseif(isJournalist())
						@else
							<p class="m-0 text-end fs-6 col">
								<button type="button" class="btn btn-primary btn-sm fw-medium" onclick="createAccountPrompt()">
									Submit Story
								</button>
							</p>
                        @endif
                    </div>
                    <div class="pb-2 row justify-content-center">
                        <div class="col">
                            <h5 class="m-0 fs-5 fw-semibold">
								@if(isArchitect())
									<a class="text-dark" href="{{ route('architect.pitch-story.journalists.view', ['journalist' => $journalist->slug]) }}">{{ $journalist->user->name }}</a>
								@elseif(isJournalist())
									<a class="text-dark" href="{{ route('journalist.account.profile.journalists.view', ['journalist' => $journalist->slug]) }}">{{ $journalist->user->name }}</a>
								@else
									<a class="text-dark" href="javascript:;" onclick="createAccountPrompt()"><span class="small">{{ $journalist->user->name }}</span></a>
								@endif
                            </h5>
                            <p class="p-0 m-0 text-secondary fs-6"><span class="small">{{ $journalist->position->name }}</span></p>
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col">
                            <div class="row align-items-center g-2">
                                <div class="col-auto">
									@php
										$profileImg = $journalist->publications[0]->profileImage ?
														Storage::url($journalist->publications[0]->profileImage->image_path) :
														AvatarController::setProfileAvatar([
															'name' => $journalist->publications[0]->name,
															'width' => 30,
															'fontSize' => 12,
															'background' => $journalist->publications[0]->background_color,
															'foreground' => $journalist->publications[0]->foreground_color,
														], 'publication');
									@endphp
                                    <img src="{{ $profileImg }}" style="max-width: 30px; max-height: 30px;" class="rounded-circle img-30 img-square" alt="..." />
                                </div>
                                <div class="col">
                                    <p class="p-0 m-0 fs-6 fw-bold">
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
                            <div class="flex-wrap d-flex justify-content-end align-items-center fw-medium">
                                @foreach ($journalist->publications[0]->categories as $category)
									<x-utility.badges.purple-badge :text="$category->name" />
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

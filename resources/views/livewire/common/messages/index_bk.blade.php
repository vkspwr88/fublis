<div class="row">
	<div class="col-md-7">
		<h5 class="text-black fs-5 fw-semibold mb-5">Your Messages</h5>
		{{-- <livewire:common.messages.chat-list /> --}}
		<div class="row g-0">
			@foreach ($chats as $chat)
			<div class="col-12">
				<div class="card border-0 bg-transparent">
					{{-- <a href="javascript:;" wire:click="$set('selectedChat', '{{ $chat->id }}')" class="stretched-link"></a> --}}
					<a href="javascript:;" wire:click="changeChannel('{{ $chat->id }}')" class="stretched-link"></a>
					<div class="row align-items-center">
						<div class="col-3">
							<p class="{{ $selectedChat === $chat->id ? 'text-purple-600' : 'text-dark' }} fs-6 fw-semibold m-0">
								@if ($chat->sender_id == auth()->id())
									{{ $chat->receiver->name }}
								@elseif ($chat->receiver_id == auth()->id())
									{{ $chat->sender->name }}
								@endif
							</p>
						</div>
						<div class="col-9">
							<p class="{{ $selectedChat === $chat->id ? 'text-purple-700' : 'text-dark' }} fs-6 fw-semibold m-0">{{ $chat->pitch->subject }}</p>
							<p class="{{ $selectedChat === $chat->id ? 'text-purple-600' : 'text-secondary' }} fs-6 fw-normal m-0 text-truncate">{{ $chat->latestMessage->message }}</p>
						</div>
					</div>
				</div>
			</div>
			<hr class="border-gray-300 my-3">
			@endforeach
			{{-- <div class="col-12">
				<div class="row align-items-center">
					<div class="col-3">
						<p class="text-dark fs-6 fw-semibold m-0">Leila</p>
					</div>
					<div class="col-9">
						<p class="text-dark fs-6 fw-semibold m-0">New Project | Elgin Cafe</p>
						<p class="text-secondary fs-6 fw-normal m-0">I'm sharing the plans of the cafe.</p>
					</div>
				</div>
			</div>
			<hr class="border-gray-300 my-3">
			<div class="col-md-12">
				<div class="row align-items-center">
					<div class="col-3">
						<p class="text-dark fs-6 fw-semibold m-0">Kaitlyn</p>
					</div>
					<div class="col-9">
						<p class="text-dark fs-6 fw-semibold m-0">New Press Release | Renesa Design Studio uses Emerald Green to create the bold interiors of Elgin Cafe in Amritsar</p>
						<p class="text-secondary fs-6 fw-normal m-0">Residential project in the middle of nowhere</p>
					</div>
				</div>
			</div>
			<hr class="border-gray-300 my-3">
			<div class="col-md-12">
				<div class="row align-items-center">
					<div class="col-3">
						<p class="text-purple-600 fs-6 fw-semibold m-0">Phoenix Baker</p>
					</div>
					<div class="col-9">
						<p class="text-purple-700 fs-6 fw-semibold m-0">New Article | 10 Things you did not know about Vessel, New York</p>
						<p class="text-purple-600 fs-6 fw-normal m-0">A beautiful public project</p>
					</div>
				</div>
			</div>
			<hr class="border-gray-300 my-3"> --}}
		</div>
	</div>
	<div class="col-md-5">
		{{-- <livewire:common.messages.chat-messages /> --}}
		<div class="row g-3">
			<div class="col-12" wire:loading wire:target="selectedChat">
				Loading...
			</div>
			<div class="col-12">
				<div class="row g-3" wire:loading.remove wire:target="selectedChat" style="max-height: 400px; overflow:hidden scroll;">
					@foreach ($chatMessages as $chatMessage)
						@if ($chatMessage->user_id === auth()->id())
						<div class="col-8 offset-4" wire:key="{{ $chatMessage->id }}">
							<div class="row g-2">
								<div class="col-12">
									<div class="row">
										<div class="col">
											<p class="text-start fw-medium text-dark m-0">You</p>
										</div>
										<div class="col">
											<p class="text-end text-secondary m-0">{{ $chatMessage->created_at }}</p>
										</div>
									</div>
								</div>
								<div class="col-12">
									<div class="card bg-purple-600 border-0 rounded-3">
										<div class="card-body">
											<p class="card-text text-white m-0">{{ $chatMessage->message }}</p>
										</div>
									</div>
								</div>
							</div>
						</div>
						@else
						<div class="col-12" wire:key="{{ $chatMessage->id }}">
							<div class="row">
								<div class="col-auto">
									<img src="https://via.placeholder.com/40x40" alt="..." class="img-square img-40 rounded-circle">
								</div>
								<div class="col">
									<div class="row g-2">
										<div class="col-12">
											<div class="row">
												<div class="col">
													<p class="text-start fw-medium text-dark m-0">{{ $chatMessage->user->name }}</p>
												</div>
												<div class="col">
													<p class="text-end text-secondary m-0">{{ $chatMessage->created_at }}</p>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="card bg-gray-100 border-0 rounded-3">
												<div class="card-body">
													<p class="card-text text-dark m-0">{{ $chatMessage->message }}</p>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						@endif
					@endforeach

				</div>
			</div>
			@if ($chatMessages->count())
				{{-- <livewire:common.messages.input-message :selectedChatId="$selectedChatId" /> --}}
				<div class="col-12" wire:loading.remove wire:target="selectedChat">
					<form wire:submit="sendMessage">
						<div class="input-group mb-3 rounded-3 border-gray-300">
							<input class="form-control shadow-none" rows="2" aria-describedby="button-send" placeholder="Type your message here..." wire:model="newMessage" />
							<button class="btn btn-primary" type="submit" id="button-send">
								Send <x-users.spinners.white-btn wire:target="sendMessage" />
							</button>
						</div>
						@error('newMessage')<div class="text-error">{{ $message }}</div>@enderror
					</form>
				</div>
			@endif


			{{-- <div class="col-12">
				<div class="row">
					<div class="col-auto">
						<img src="https://via.placeholder.com/40x40" alt="..." class="img-square img-40 rounded-circle">
					</div>
					<div class="col">
						<div class="row g-2">
							<div class="col-12">
								<div class="row">
									<div class="col">
										<p class="text-start fw-medium text-dark m-0">Phoenix Baker</p>
									</div>
									<div class="col">
										<p class="text-end text-secondary m-0">Friday 2:20pm</p>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="card bg-gray-100 border-0 rounded-3">
									<div class="card-body">
										<p class="card-text text-dark m-0">Hey Olivia, can you please review the latest design when you can?</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-8 offset-4">
				<div class="row g-2">
					<div class="col-12">
						<div class="row">
							<div class="col">
								<p class="text-start fw-medium text-dark m-0">You</p>
							</div>
							<div class="col">
								<p class="text-end text-secondary m-0">Friday 2:20pm</p>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="card bg-purple-600 border-0 rounded-3">
							<div class="card-body">
								<p class="card-text text-white m-0">Sure thing, I'll have a look today.</p>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-12">
				<div class="row">
					<div class="col-auto">
						<img src="https://via.placeholder.com/40x40" alt="..." class="img-square img-40 rounded-circle">
					</div>
					<div class="col">
						<div class="row g-2">
							<div class="col-12">
								<div class="row">
									<div class="col">
										<p class="text-start fw-medium text-dark m-0">Phoenix Baker</p>
									</div>
									<div class="col">
										<p class="text-end text-secondary m-0">Friday 2:20pm</p>
									</div>
								</div>
							</div>
							<div class="col-12">
								<div class="card bg-gray-100 border-0 rounded-3">
									<div class="card-body">
										<p class="card-text text-dark m-0">Hey Olivia, can you please review the latest design when you can?</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div> --}}

			{{-- <hr class="border-gray-300 my-3"> --}}
		</div>
	</div>
</div>

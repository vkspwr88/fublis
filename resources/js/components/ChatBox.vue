<script setup>
	import { ref, watchEffect } from 'vue';
	import axios from 'axios';
	// import moment from

	const authId = window.auth;
	const newMessage = ref('');
	const errorMessage = ref('');

	const subjects = ref(null);
	const selectedChat = ref(window.selectedChat);
	const subjectsRoute = ref(window.subjectsRoute);
	const messages = ref(null);
	const chatsRoute = ref(window.chatsRoute);
	const sendMessageRoute = ref(window.sendMessageRoute);

	const scrollToBottom = () => {
    	const element = document.getElementById('chatWindow');
		const chatWindowHeight = element.clientHeight;
		console.log(element, chatWindowHeight);
		element.scrollIntoView({behavior: "smooth", block: "end"});
	}

	console.log(subjects.value, selectedChat.value, subjectsRoute.value, messages.value, chatsRoute.value, sendMessageRoute.value);

	watchEffect(async () => {
		await getSubjects();
		await getMessages();
		joinChannel();
	});

	async function getSubjects(){
		const url = subjectsRoute.value;
		subjects.value = await (await fetch(url)).json();
	}

	function joinChannel(){
		window.Echo.private(`chats.${selectedChat.value}`)
			.listen('SendMessage', (e) => {
				console.log('incoming');
				refreshChat();
				/* if(e.chat.id === e.chatMessage.chat_id){
					messages.value.push(e.chatMessage);
					getSubjects();
				} */
			});
	}

	function refreshChat(){
		getSubjects();
		getMessages();
	}

	function changeSubject(chatId){
		window.Echo.leave(`chats.${selectedChat.value}`);
		selectedChat.value = chatId;
		joinChannel();
		getMessages();
	}

	async function getMessages(){
		const url = `${chatsRoute.value}/${selectedChat.value}`;
		/* messages.value = await (await fetch(url)).json();
		let obj = subjects.value.find(o => o.id === selectedChat.value);
		obj.is_unread = false;
		scrollToBottom(); */
		axios.get(url).then(response => {
			messages.value = response.data;
			let obj = subjects.value.find(o => o.id === selectedChat.value);
			obj.is_unread = false;
			scrollToBottom();
		});
	}

	function sendMessage(){
		errorMessage.value = '';
		const url = sendMessageRoute.value;
		if(newMessage.value == '' || selectedChat.value == ''){
			errorMessage.value = 'Enter the message';
			return;
		}
		const data = {
			'selectedChat': selectedChat.value,
			'newMessage': newMessage.value,
		};
		console.log(data);
		axios.post(url, data).then(response => {
			console.log(response.data);
			messages.value.push(response.data);
			newMessage.value = '';
			getSubjects();
			scrollToBottom();
		});
	}
</script>
<template>
	<div class="row">
		<div class="col-md-7">
			<h5 class="mb-5 text-black fs-5 fw-semibold">Your Messages</h5>
			<div class="row g-0">
				<div class="col-12" v-for="chat in subjects" :key="chat.id">
					<div class="bg-transparent border-0 card">
						<a href="javascript:;" class="stretched-link" @click="changeSubject(chat.id)"></a>
						<div class="row align-items-center">
							<div class="col-3">
								<p class="m-0 fs-6"
									:class="[
										selectedChat === chat.id ? 'text-purple-600 fw-semibold' : 'text-gray-900',
										(selectedChat != chat.id && chat.is_unread) ? 'fw-semibold' : ''
									]"
								>
									<span v-if="chat.sender_id === authId">
										{{ chat.receiver.name }}
									</span>
									<span v-else-if="chat.receiver_id == authId">
										{{ chat.sender.name }}
									</span>
								</p>
							</div>
							<div class="col-9">
								<p class="m-0 fs-6"
									:class="[
										selectedChat === chat.id ? 'text-purple-700' : 'text-gray-900',
										(selectedChat != chat.id && chat.is_unread) ? 'fw-semibold' : 'fw-normal'
									]"
								>
									{{ chat.pitch.subject }}
								</p>
								<p class="m-0 fs-6 fw-normal text-truncate"
									:class="[
										selectedChat === chat.id ? 'text-purple-600' : 'text-gray-600',
									]"
								>
									{{ chat.latest_message.message.replace(/(<([^>]+)>)/gi, "") }}
								</p>
							</div>
						</div>
					</div>
					<hr class="my-3 border-gray-300">
				</div>
			</div>
		</div>
		<div class="col-md-5">
			<div class="row g-3">
				<div class="col-12">
					<div class="px-2" style="max-height: 400px; overflow: hidden scroll;">
						<div id="chatWindow" ref="chatWindow" class="row g-3">
							<TransitionGroup v-for="(chatMessage, index) in messages" :key="chatMessage.id">
								<div class="col-8 offset-4" v-if="chatMessage.user_id === authId">
									<div class="row g-2">
										<div class="col-12">
											<div class="row">
												<div class="col-auto">
													<p class="m-0 text-start fw-medium text-dark">You</p>
												</div>
												<div class="col">
													<p class="m-0 text-end text-secondary">{{ chatMessage.created_at }}</p>
												</div>
											</div>
										</div>
										<div class="col-12">
											<div class="bg-purple-600 border-0 card rounded-3">
												<div class="card-body">
													<p class="m-0 text-white card-text" v-if="index == 0" v-html="chatMessage.message"></p>
													<p class="m-0 text-white card-text" v-else>{{ chatMessage.message.replace(/(<([^>]+)>)/gi, "") }}</p>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="col-12" v-else>
									<div class="row">
										<div class="col-auto" v-if="chatMessage.user.architect && chatMessage.user.architect.profile_image">
											<img :src="'/storage/' + chatMessage.user.architect.profile_image.image_path" alt="..." class="img-square img-40 rounded-circle">
										</div>
										<div class="col-auto" v-else-if="chatMessage.user.journalist && chatMessage.user.journalist.profile_image">
											<img :src="'/storage/' + chatMessage.user.journalist.profile_image.image_path" alt="..." class="img-square img-40 rounded-circle">
										</div>
										<div class="col-auto" v-else>
											<img src="https://via.placeholder.com/40x40" alt="..." class="img-square img-40 rounded-circle">
										</div>
										<div class="col">
											<div class="row g-2">
												<div class="col-12">
													<div class="row">
														<div class="col-auto">
															<p class="m-0 text-start fw-medium text-dark">{{ chatMessage.user.name }}</p>
														</div>
														<div class="col">
															<p class="m-0 text-end text-secondary">{{ chatMessage.created_at }}</p>
														</div>
													</div>
												</div>
												<div class="col-12">
													<div class="bg-gray-100 border-0 card rounded-3">
														<div class="card-body">
															<p class="m-0 card-text text-dark" v-if="index == 0" v-html="chatMessage.message"></p>
															<p class="m-0 card-text text-dark" v-else>{{ chatMessage.message.replace(/(<([^>]+)>)/gi, "") }}</p>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</TransitionGroup>
						</div>
					</div>
				</div>
				<div class="col-12" v-if="messages">
					<div class="mb-1 border-gray-300 input-group rounded-3">
						<input class="shadow-none form-control" rows="2" aria-describedby="button-send" placeholder="Type your message here..." v-model.trim="newMessage" @keyup.enter="sendMessage" />
						<button class="btn btn-primary" type="button" id="button-send" @click="sendMessage">
							Send <x-users.spinners.white-btn />
						</button>
					</div>
					<div class="text-danger" v-if="errorMessage">{{ errorMessage }}</div>
				</div>
			</div>
		</div>
	</div>
</template>

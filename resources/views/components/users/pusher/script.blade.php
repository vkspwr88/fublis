<div>
	{{-- <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
	<script>

		// Enable pusher logging - don't include this in production
		Pusher.logToConsole = true;

		var pusher = new Pusher('{{ env('PUSHER_APP_KEY') }}', {
			cluster: '{{ env('PUSHER_APP_CLUSTER') }}'
		});

		window.addEventListener('open-channel', event => {
			console.log('OPENING CHANNEL');
			// const channel = pusher.subscribe('{{ env('CHANNEL_NAME') }}');
			const channel = pusher.subscribe('chats.' + event.detail.chatId);
			// channel.bind('SendMessage', function(data) {
			// 	alert(JSON.stringify(data));
			// });
		});

		window.addEventListener('close-channel', event => {
			console.log('CLOSING CHANNEL');
			pusher.unsubscribe('chats.' + event.detail.chatId);
		});
	</script> --}}
	<script>
		window.auth = '{{ auth()->id() }}';
		window.selectedChat = '{{ $selectedChat }}';
		window.subjectsRoute = '{{ $subjectsRoute }}';
		window.chatsRoute = '{{ $chatsRoute }}';
		window.sendMessageRoute = '{{ $sendMessageRoute }}';
	</script>
</div>

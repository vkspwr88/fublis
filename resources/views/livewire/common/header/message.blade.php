<li class="nav-item nav-icon px-2 ps-0 px-xl-1">
	<a href="{{ route('journalist.account.profile.message.index') }}" class="nav-link text-center text-purple-600 border border-2 border-purple-600 rounded-circle lh-1 position-relative">
		<i class="bi bi-envelope"></i>
		@if ($totalUnread)
			<span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger notification-badge">
				@if ($totalUnread > 9)
					<span style="margin-left: -4px;">9+</span>
				@else
					<span style="margin-left: -1px;">{{ $totalUnread }}</span>
				@endif
				<span class="visually-hidden">unread messages</span>
			</span>
		@endif
	</a>
</li>

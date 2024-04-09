<li class="px-2 nav-item nav-icon px-xl-1">
	<a href="{{ $url }}" class="text-center text-purple-600 border border-2 border-purple-600 nav-link rounded-circle lh-1 position-relative px-0">
		<i class="bi bi-bell"></i>
		@if ($totalUnread)
			<span class="top-0 position-absolute start-100 translate-middle badge rounded-circle bg-danger notification-badge">
				@if ($totalUnread > 9)
					<span style="margin-left: -4px;">9+</span>
				@else
					<span style="margin-left: -1px;">{{ $totalUnread }}</span>
				@endif
				<span class="visually-hidden">unread notifications</span>
			</span>
		@endif
	</a>
</li>

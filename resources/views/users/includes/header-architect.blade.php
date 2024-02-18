<div class="offcanvas-body align-items-center">
	<ul id="headerNav" class="mb-2 navbar-nav ms-xl-5 me-xl-auto mb-xl-0">
		<li class="nav-item">
			<a class="nav-link {{ request()->segment(2) === 'add-story' ? 'active fw-medium' : '' }}" {{ request()->segment(2) === 'add-story' ? 'aria-current=page' : '' }} href="{{ route('architect.add-story.index') }}">Add Story</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ request()->segment(1) === 'media-kit' ? 'active fw-medium' : '' }}" {{ request()->segment(2) === 'media-kit' ? 'aria-current=page' : '' }} href="{{ route('architect.media-kit.index') }}">Media Kits</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ request()->segment(2) === 'pitch-story' ? 'active fw-medium' : '' }}" {{ request()->segment(2) === 'pitch-story' ? 'aria-current=page' : '' }} href="{{ route('architect.pitch-story.index') }}">Pitch Story</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				Resources
			</a>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="#">Action</a></li>
				<li><a class="dropdown-item" href="#">Another action</a></li>
				<li>
					<hr class="dropdown-divider">
				</li>
				<li><a class="dropdown-item" href="#">Something else here</a></li>
			</ul>
		</li>
	</ul>
	<form class="my-5 d-flex my-xl-0" aria-label="search">
		<div class="input-group">
			<label class="bg-white input-group-text" for="headerSearchInput"><i class="bi bi-search"></i></label>
			<input id="headerSearchInput" class="shadow-none form-control border-start-0 ps-0" type="search" placeholder="Search journalists, publications" aria-label="Search">
		</div>
	</form>
	<ul id="profileNav" class="flex-row mt-5 navbar-nav mt-xl-0 ms-xl-auto align-items-center">
		{{-- <li class="px-2 nav-item nav-icon ps-0 px-xl-1">
			<a href="{{ route('architect.account.profile.message.index') }}" class="text-center text-purple-600 border border-2 border-purple-600 nav-link rounded-circle lh-1 position-relative">
				<i class="bi bi-envelope"></i>
				@if ($totalUnreadMessages)
					<span class="top-0 position-absolute start-100 translate-middle badge rounded-circle bg-danger notification-badge">
						@if ($totalUnreadMessages > 9)
							<span style="margin-left: -4px;">9+</span>
						@else
							<span style="margin-left: -1px;">{{ $totalUnreadMessages }}</span>
						@endif
						<span class="visually-hidden">unread messages</span>
					</span>
				@endif
			</a>
		</li>
		<li class="px-2 nav-item nav-icon px-xl-1">
			<a href="{{ route('architect.account.profile.notification') }}" class="text-center text-purple-600 border border-2 border-purple-600 nav-link rounded-circle lh-1 position-relative">
				<i class="bi bi-bell"></i>
				@if ($totalUnreadNotifications)
					<span class="top-0 position-absolute start-100 translate-middle badge rounded-circle bg-danger notification-badge">
						@if ($totalUnreadNotifications > 9)
							<span style="margin-left: -4px;">9+</span>
						@else
							<span style="margin-left: -1px;">{{ $totalUnreadNotifications }}</span>
						@endif
						<span class="visually-hidden">unread notifications</span>
					</span>
				@endif
			</a>
		</li> --}}
		<livewire:common.header.message :url="route('architect.account.profile.message.index')" />
		<livewire:common.header.notification :url="route('architect.account.profile.notification')" />
		<li class="px-2 nav-item px-xl-1 dropdown">
			<a href="javascript:;" class="p-0 nav-link rounded-circle" role="button" data-bs-toggle="dropdown">
				<img class="rounded-circle img-40 img-square" src="{{ $profileImage }}" alt="..." />
			</a>
			<ul class="dropdown-menu profile-dropdown">
				<li><a class="dropdown-item" href="{{ route('architect.account.studio.index') }}">Studio</a></li>
				<li><a class="dropdown-item" href="{{ route('architect.account.profile.index') }}">Profile</a></li>
				<li><a class="dropdown-item" href="{{ route('architect.account.profile.analytic') }}">Analytics</a></li>
				<li><a class="dropdown-item" href="{{ route('architect.account.profile.alert') }}">Alerts</a></li>
				<li><a class="dropdown-item" href="{{ route('architect.account.profile.notification') }}">Notifications</a></li>
				<li><a class="dropdown-item" href="{{ route('architect.account.profile.message.index') }}">Messages</a></li>
				<li><a class="dropdown-item" href="{{ route('architect.account.profile.invite-colleague') }}">Invite Colleague</a></li>
				<li><a class="dropdown-item" href="{{ route('architect.account.profile.setting.personal-info') }}">Settings</a></li>
				<li><a class="dropdown-item" href="{{ route('architect.logout') }}">Log Out</a></li>
			</ul>
		</li>
	</ul>
</div>

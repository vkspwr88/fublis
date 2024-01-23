<div class="offcanvas-body align-items-center">
	<ul id="headerNav" class="navbar-nav ms-xl-5 me-xl-auto mb-2 mb-xl-0">
		<li class="nav-item">
			<a class="nav-link {{ request()->segment(2) === 'add-story' ? 'active fw-medium' : '' }}" {{ request()->segment(2) === 'add-story' ? 'aria-current=page' : '' }} href="{{ route('architect.add-story.index') }}">Add Story</a>
		</li>
		<li class="nav-item">
			<a class="nav-link {{ request()->segment(2) === 'media-kit' ? 'active fw-medium' : '' }}" {{ request()->segment(2) === 'media-kit' ? 'aria-current=page' : '' }} href="{{ route('architect.media-kit.index') }}">Media Kits</a>
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
	<form class="d-flex my-5 my-xl-0" aria-label="search">
		<div class="input-group">
			<label class="input-group-text bg-white" for="headerSearchInput"><i class="bi bi-search"></i></label>
			<input id="headerSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search journalists, publications" aria-label="Search">
		</div>
	</form>
	<ul id="profileNav" class="navbar-nav mt-5 mt-xl-0 ms-xl-auto flex-row align-items-center">
		<li class="nav-item nav-icon px-2 ps-0 px-xl-1">
			<a href="{{ route('architect.account.profile.message.index') }}" class="nav-link text-center text-purple-600 border border-2 border-purple-600 rounded-circle lh-1 position-relative">
				<i class="bi bi-envelope"></i>
				@if ($totalUnreadMessages)
					<span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger notification-badge">
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
		<li class="nav-item nav-icon px-2 px-xl-1">
			<a href="{{ route('architect.account.profile.notification') }}" class="nav-link text-center text-purple-600 border border-2 border-purple-600 rounded-circle lh-1 position-relative">
				<i class="bi bi-bell"></i>
				@if ($totalUnreadNotifications)
					<span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger notification-badge">
						@if ($totalUnreadNotifications > 9)
							<span style="margin-left: -4px;">9+</span>
						@else
							<span style="margin-left: -1px;">{{ $totalUnreadNotifications }}</span>
						@endif
						<span class="visually-hidden">unread notifications</span>
					</span>
				@endif
			</a>
		</li>
		<li class="nav-item px-2 px-xl-1 dropdown">
			<a href="javascript:;" class="nav-link rounded-circle p-0" role="button" data-bs-toggle="dropdown">
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

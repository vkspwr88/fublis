<div class="offcanvas-body">
	<ul id="headerNav" class="mb-2 navbar-nav ms-xl-5 me-xl-auto mb-xl-0">
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle {{ ( (request()->segment(2) === 'invite-story' && request()->segment(3) === 'create') || (request()->segment(2) === 'invite-story' && request()->segment(3) == '') || (request()->segment(2) === 'submission' && request()->segment(3) == '') ) ? 'active fw-medium' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				Invite Story
			</a>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item {{ (request()->segment(2) === 'invite-story' && request()->segment(3) === 'create') ? 'active fw-medium' : '' }}" href="{{ route('journalist.call.create') }}">Invite Story</a></li>
				<li><a class="dropdown-item {{ (request()->segment(2) === 'invite-story' && request()->segment(3) == '') ? 'active fw-medium' : '' }}" href="{{ route('journalist.call.index') }}">Your Calls</a></li>
				<li><a class="dropdown-item {{ (request()->segment(2) === 'submission' && request()->segment(3) == '') ? 'active fw-medium' : '' }}" href="{{ route('journalist.submission.index') }}">Submissions</a></li>
			</ul>
		</li>
		{{-- <li class="nav-item">
			<a class="nav-link" href="{{ route('journalist.call.create') }}">Invite Story</a>
		</li> --}}
		{{-- <li class="nav-item">
			<a class="nav-link" href="{{ route('journalist.call.create') }}">Your Calls</a>
		</li> --}}
		<li class="nav-item">
			<a class="nav-link {{ request()->segment(2) === 'media-kit' ? 'active fw-medium' : '' }}" {{ request()->segment(2) === 'media-kit' ? 'aria-current=page' : '' }} href="{{ route('journalist.media-kit.index') }}">Media Kits</a>
		</li>
		<li class="nav-item dropdown">
			<a class="nav-link dropdown-toggle {{ ( (request()->segment(2) === 'invite-story' && request()->segment(3) === 'all') || (request()->segment(4) === 'publications' && request()->segment(5) == '') || (request()->segment(4) === 'journalists' && request()->segment(5) == '')) ? 'active fw-medium' : '' }}" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
				Calls
			</a>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item {{ (request()->segment(2) === 'invite-story' && request()->segment(3) === 'all') ? 'active fw-medium' : '' }}" href="{{ route('journalist.call.all') }}">Calls</a></li>
				<li><a class="dropdown-item {{ (request()->segment(4) === 'publications' && request()->segment(5) == '') ? 'active fw-medium' : '' }}" href="{{ route('journalist.account.profile.publications.index') }}">Publications</a></li>
				<li><a class="dropdown-item {{ (request()->segment(4) === 'journalists' && request()->segment(5) == '') ? 'active fw-medium' : '' }}" href="{{ route('journalist.account.profile.journalists.index') }}">Journalists</a></li>
			</ul>
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
			<a href="{{ route('journalist.account.profile.message.index') }}" class="text-center text-purple-600 border border-2 border-purple-600 nav-link rounded-circle lh-1 position-relative">
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
		</li> --}}
		<livewire:common.header.message :url="route('journalist.account.profile.message.index')" />
		<livewire:common.header.notification :url="route('journalist.account.profile.notification')" />
		{{-- <li class="px-2 nav-item nav-icon px-xl-1">
			<a href="{{ route('journalist.account.profile.notification') }}" class="text-center text-purple-600 border border-2 border-purple-600 nav-link rounded-circle lh-1 position-relative">
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
		<li class="px-2 nav-item px-xl-1 dropdown">
			<a href="javascript:;" class="nav-link rounded-circle p-0 {{-- dropdown-toggle --}}" role="button" data-bs-toggle="dropdown">
				<img class="rounded-circle img-40 img-square" src="{{ $profileImage }}" alt="..." />
			</a>
			<ul class="dropdown-menu profile-dropdown">
				<li><a class="dropdown-item" href="{{ route('journalist.account.profile.index') }}">Profile</a></li>
				<li><a class="dropdown-item" href="{{ route('journalist.account.profile.notification') }}">Notifications</a></li>
				<li><a class="dropdown-item" href="{{ route('journalist.account.profile.message.index') }}">Messages</a></li>
				<li><a class="dropdown-item" href="{{ route('journalist.account.profile.invite-colleague') }}">Invite Colleague</a></li>
				<li><a class="dropdown-item" href="{{ route('journalist.account.profile.setting.personal-info') }}">Settings</a></li>
				<li><a class="dropdown-item" href="{{ route('journalist.logout') }}">Log Out</a></li>
			</ul>
		</li>
	</ul>
</div>

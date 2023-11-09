@php
	$settingsNav = [
		[
			'route' => route('journalist.account.profile.setting.personal-info'),
			'name' => 'Personal Info',
		],
		[
			'route' => route('journalist.account.profile.setting.password'),
			'name' => 'Password',
		],
		[
			'route' => route('journalist.account.profile.setting.associated-publication'),
			'name' => 'Associated Publications',
		],
		[
			'route' => route('journalist.account.profile.setting.publication'),
			'name' => 'Your Publications',
		],
	];
@endphp
<div class="row">
	<div class="col">
		<ul class="nav setting-nav border-bottom">
			@foreach ($settingsNav as $nav)
			<li class="nav-item">
				@if ($nav['name'] === $setting)
				<a class="nav-link text-purple-700 border-bottom border-2 border-purple-700 fs-6 fw-semibold" aria-current="page" href="{{ $nav['route'] }}">
					{{ $nav['name'] }}
				</a>
				@else
				<a class="nav-link text-secondary fs-6 fw-semibold" href="{{ $nav['route'] }}">{{ $nav['name'] }}</a>
				@endif
			</li>
			@endforeach
		</ul>
	</div>
</div>

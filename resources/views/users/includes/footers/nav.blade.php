@php
	$path = resource_path('menus/guestFooterMenu.json');
	$menus = json_decode(file_get_contents($path));
	// dd($menus);
@endphp

@foreach($menus->items as $item)
	<div class="col-xl-2 col-lg-4 col-md-4 col-sm-6 text-sm-start text-center">
		<x-users.footer.heading :text="$item->name" />
		<ul class="nav flex-column footer-list">
			@foreach ($item->submenu as $submenu)
				<li class="nav-item">
					@php
						$href = $submenu->url ? (str()->contains($submenu->url, 'https://') ? $submenu->url : route($submenu->url)) : '#';
					@endphp
					<a class="nav-link px-0 {{-- pe-0 pe-sm-3 --}} py-2 text-dark" href="{{ $href }}" {{ str()->contains($submenu->url, 'https://') ? 'target=_blank' : '' }}>
						{{ $submenu->name }}
					</a>
				</li>
			@endforeach
		</ul>
	</div>
@endforeach
<div>
    @if ($paginator->hasPages())
		<hr class="divider">
		<div class="row g-3 g-md-1">
			<div class="col col-sm order-1 order-sm-1 order-md-1 text-start text-nowrap">
				@if ($paginator->onFirstPage())
					<button type="button" class="btn btn-white btn-sm text-capitalize disabled" aria-disabled="true" aria-label="@lang('pagination.previous')"><i class="bi bi-arrow-left-short"></i> previous</button>
				@else
					<button type="button" class="btn btn-white btn-sm text-capitalize" dusk="previousPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" wire:click="previousPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="prev" aria-label="@lang('pagination.previous')"><i class="bi bi-arrow-left-short"></i> previous</button>
				@endif
			</div>
			<div class="col-12 col-sm-auto order-3 order-sm-3 order-md-2 text-center">
				<nav aria-label="...">
					<ul class="pagination pagination-sm justify-content-center m-0">
						{{-- Pagination Elements --}}
						@foreach ($elements as $element)
							{{-- "Three Dots" Separator --}}
							@if (is_string($element))
								<li class="page-item disabled" aria-current="page" aria-disabled="true">
									<span class="page-link px-3 border-0 bg-transparent text-dark rounded">{{ $element }}</span>
								</li>
							@endif
		
							{{-- Array Of Links --}}
							@if (is_array($element))
								@foreach ($element as $page => $url)
									@if ($page == $paginator->currentPage())
										<li class="page-item" aria-current="page" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}">
											<span class="page-link px-3 border bg-white text-dark rounded">{{ $page }}</span>
										</li>
									@else
										<li class="page-item" wire:key="paginator-{{ $paginator->getPageName() }}-page-{{ $page }}">
											<button type="button" class="page-link px-3 border-0 bg-transparent text-dark rounded" wire:click="gotoPage({{ $page }}, '{{ $paginator->getPageName() }}')">{{ $page }}</button>
										</li>
									@endif
								@endforeach
							@endif
						@endforeach
					</ul>
				</nav>
			</div>
			<div class="col col-sm order-2 order-sm-2 order-md-3 text-end text-nowrap">
				@if ($paginator->hasMorePages())
					<button type="button" class="btn btn-white btn-sm text-capitalize" dusk="nextPage{{ $paginator->getPageName() == 'page' ? '' : '.' . $paginator->getPageName() }}" wire:click="nextPage('{{ $paginator->getPageName() }}')" wire:loading.attr="disabled" rel="next" aria-label="@lang('pagination.next')">next <i class="bi bi-arrow-right-short"></i></button>
                @else
					<button type="button" class="btn btn-white btn-sm text-capitalize disabled" aria-disabled="true" aria-label="@lang('pagination.next')">next <i class="bi bi-arrow-right-short"></i></button>
                @endif
			</div>
		</div>
    @endif
</div>

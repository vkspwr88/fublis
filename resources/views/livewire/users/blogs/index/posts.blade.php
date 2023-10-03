<div class="col-sm-7 col-md-8 col-lg-9">
	<div class="row row-cols-1 row-cols-lg-2 g-4">
		@foreach ($blogs as $blog)
			<livewire:users.blogs.index.post :blog="$blog" :key="$blog->id" />
		@endforeach
	</div>
	<hr class="divider">
	<div class="row g-3 g-md-1">
		<div class="col col-sm order-1 order-sm-1 order-md-1 text-start text-nowrap">
			<button type="button" class="btn btn-white btn-sm text-capitalize"><i class="bi bi-arrow-left-short"></i> previous</button>
		</div>
		<div class="col-12 col-sm-auto order-3 order-sm-3 order-md-2 text-center">
			<nav aria-label="...">
				<ul class="pagination pagination-sm justify-content-center m-0">
					<li class="page-item" aria-current="page">
						<span class="page-link px-3 border bg-white text-dark rounded">1</span>
					</li>
					<li class="page-item"><a class="page-link px-3 border-0 bg-transparent text-dark rounded" href="#">2</a></li>
					<li class="page-item"><a class="page-link px-3 border-0 bg-transparent text-dark rounded" href="#">3</a></li>
					<li class="page-item" aria-current="page">
						<span class="page-link px-3 border-0 bg-transparent text-dark rounded">...</span>
					</li>
					<li class="page-item"><a class="page-link px-3 border-0 bg-transparent text-dark rounded" href="#">8</a></li>
					<li class="page-item"><a class="page-link px-3 border-0 bg-transparent text-dark rounded" href="#">9</a></li>
					<li class="page-item"><a class="page-link px-3 border-0 bg-transparent text-dark rounded" href="#">10</a></li>
				</ul>
			</nav>
		</div>
		<div class="col col-sm order-2 order-sm-2 order-md-3 text-end text-nowrap">
			<button type="button" class="btn btn-white btn-sm text-capitalize">next <i class="bi bi-arrow-right-short"></i></button>
		</div>
	</div>
</div>

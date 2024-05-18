@if ($errors->any())
	<div class="mb-3 row">
		<div class="col-md-12">
			<div class="alert alert-danger">
				<ul class="m-0 ps-2">
					@foreach ($errors->all() as $error)
						<li>{{ $error }}</li>
					@endforeach
				</ul>
			</div>
		</div>
	</div>
@endif

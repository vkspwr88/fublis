<div class="col-12">
	<div class="row align-items-center g-3">
		<div class="col-auto">
			<div class="row align-items-center gx-2 gy-4">
				@foreach ($form->selectedMediaKitTypes as $key => $selectedMediaType)
					<div class="col-auto">
						<span class="badge rounded-pill text-purple-700 bg-purple-100">
							{{ showModelName($selectedMediaType) }}
							<a href="javascript:;" class="text-purple-700" wire:click="removeFilterOption('{{ $key }}')">X</a>
						</span>
					</div>
				@endforeach
				<div class="col">
					<div class="dropdown">
						<button type="button" class="btn btn-white btn-sm fw-semibold dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
							<i class="bi bi-filter"></i> More filters
						</button>
						<ul class="dropdown-menu px-2">
							@foreach ($form->mediaKitTypes as $key => $mediaKitType)
								<div class="form-check" wire:key="{{ $key }}">
									<input class="form-check-input filter-checkbox" type="checkbox" value="{{ $mediaKitType['id'] }}" id="mediaKitType{{ $key }}" wire:model.change="form.selectedMediaKitTypes" />
									<label class="form-check-label" for="mediaKitType{{ $key }}">{{ $mediaKitType['name'] }}</label>
								</div>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="col">
			<div class="d-flex justify-content-end">
				<div class="input-group" style="width: 280px;">
					<label for="filterSearchInput" class="input-group-text bg-white"{{--  wire:click="$refresh" --}}><i class="bi bi-search"></i></label>
					<input id="filterSearchInput" class="form-control border-start-0 shadow-none ps-0" type="search" placeholder="Search media kit by name" aria-label="Search" wire:model="form.searchedName" wire:keydown.enter="$refresh" />
				</div>
			</div>
		</div>
	</div>
</div>

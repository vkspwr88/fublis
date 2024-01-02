<div>
    <div class="row pt-4 g-4 justify-content-end align-items-end">
		<div class="col">
			<h4 class="text-dark fs-6 fw-semibold m-0 p-0">Team</h4>
			<p class="text-secondary fs-6 m-0 p-0">
				<small>Manage your team members here</small>
			</p>
		</div>
	</div>

	<hr class="border-gray-300 my-4">

	<div class="row">
		<div class="col-md-3">
			<h5 class="text-dark fs-7 fw-medium-0 p-0">Team members</h5>
			<p class="text-secondary fs-7 m-0 p-0">
				<small>Manage your existing team and change roles/permissions.</small>
			</p>
		</div>
		<div class="col-md-9">
			<div class="card rounded-3">
				<table class="table m-0">
					<thead class="card-header">
						<tr>
							<th class="text-secondary fs-7 align-middle py-3">Name</th>
							<th class="text-secondary fs-7 align-middle py-3">Role</th>
							<th></th>
						</tr>
					</thead>
					<tbody class="card-body">
						@foreach ($architects as $architect)
						@if(auth()->id() !== $architect->user_id)
						<tr>
							<td class="align-middle py-3 {{ $loop->last ? 'border-0' : '' }}">
								<div class="row g-2 align-items-center">
									<div class="col-auto">
										<img class="img-square rounded-circle img-40" src="{{ $architect->profileImage ? Storage::url($architect->profileImage->image_path) : 'https://via.placeholder.com/40x40' }}" alt="...">
									</div>
									<div class="col">
										<p class="fs-7 text-dark fw-semibold m-0 p-0">{{ $architect->user->name }}</p>
										<p class="fs-7 text-secondary m-0 p-0">{{ $architect->user->email }}</p>
									</div>
								</div>
							</td>
							<td class="text-secondary fs-7 align-middle py-3 {{ $loop->last ? 'border-0' : '' }}">
								@if($isEditEnabled && $selectedArchitectId === $architect->id)
								<select class="form-select" wire:model="selectedUserRole">
									@foreach ($userRoles as $userRole)
										<option value="{{ $userRole }}">{{ $userRole->name }}</option>
									@endforeach
								</select>
								@else
								{{ str()->headline($architect->user_role->value) }}
								@endif
							</td>
							<td class="align-middle py-3 {{ $loop->last ? 'border-0' : '' }}">
								@if($isEditEnabled && $selectedArchitectId === $architect->id)
									<a href="javascript:;" class="text-purple-700 fw-semibold fs-7 me-2" wire:click="updateArchitect">Update</a>
									<a href="javascript:;" class="text-secondary fw-semibold fs-7" wire:click="cancelArchitect">Cancel</a>
								@else
									<a href="javascript:;" class="text-purple-700 fw-semibold fs-7 me-2" wire:click="editArchitect('{{ $architect->id }}')">Edit</a>
									<a href="javascript:" class="text-secondary fw-semibold fs-7">Delete</a>
								@endif
							</td>
						</tr>
						@endif
						@endforeach
					</tbody>
				</table>
				{{-- <div class="card-header">
				</div>
				<div class="card-body">

				</div> --}}
			</div>
		</div>
	</div>
</div>

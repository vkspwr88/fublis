<div>
    <div class="pt-4 row g-4 justify-content-end align-items-end">
		<div class="col">
			<h4 class="p-0 m-0 text-dark fs-6 fw-semibold">Team</h4>
			<p class="p-0 m-0 text-secondary fs-6">
				<small>Manage your team members here</small>
			</p>
		</div>
	</div>

	<hr class="my-4 border-gray-300">

	<div class="row g-4">
		<div class="col-md-3">
			<h5 class="p-0 text-dark fs-7 fw-medium-0">Team members</h5>
			<p class="p-0 m-0 text-secondary fs-7">
				<small>Manage your existing team and change roles/permissions.</small>
			</p>
		</div>
		<div class="col-md-9">
			<div class="card rounded-3">
				<table class="table m-0">
					<thead class="card-header">
						<tr>
							<th class="py-3 align-middle text-secondary fs-7">Name</th>
							<th class="py-3 align-middle text-secondary fs-7">Role</th>
							<th class="py-3 align-middle text-secondary fs-7">Action</th>
						</tr>
					</thead>
					<tbody class="card-body">
						@foreach ($architects as $architect)
						<tr>
							<td class="align-middle py-3 {{ $loop->last ? 'border-0' : '' }}">
								<div class="row g-2 align-items-center">
									<div class="col-auto">
										@php
											$profileImg = $architect->profileImage ?
																Storage::url($architect->profileImage->image_path) :
																App\Http\Controllers\Users\AvatarController::setProfileAvatar([
																	'name' => $architect->user->name,
																	'width' => 40,
																	'fontSize' => 18,
																	'background' => $architect->background_color,
																	'foreground' => $architect->foreground_color,
																]);
										@endphp
										<img class="img-square rounded-circle img-40" src="{{ $profileImg }}" alt="...">
									</div>
									<div class="col">
										<p class="p-0 m-0 fs-7 text-dark fw-semibold">{{ $architect->user->name }}</p>
										<p class="p-0 m-0 fs-7 text-secondary">{{ $architect->user->email }}</p>
									</div>
								</div>
							</td>
							<td class="text-secondary fs-7 align-middle py-3 {{ $loop->last ? 'border-0' : '' }}">
								@if($isEditEnabled && $selectedArchitectId === $architect->id)
								<select class="form-select" wire:model="selectedUserRole">
									@foreach ($userRoles as $userRole)
										@if($userRole != App\Enums\Users\Architects\UserRoleEnum::SUPERADMIN)
											<option value="{{ $userRole }}">{{ $userRole->name }}</option>
										@endif
									@endforeach
								</select>
								@else
								{{ str()->headline($architect->user_role->value) }}
								@endif
							</td>
							<td class="align-middle py-3 {{ $loop->last ? 'border-0' : '' }}">
								@if(auth()->id() === $architect->user_id || $architect->user_role === App\Enums\Users\Architects\UserRoleEnum::SUPERADMIN)
									NA
								@else
									@if($isEditEnabled && $selectedArchitectId === $architect->id)
										<a href="javascript:;" class="text-purple-700 fw-semibold fs-7 me-2" wire:click="updateArchitect" wire:key="update-role">
											Update <x-users.spinners.primary-btn wire:target="updateArchitect" />
										</a>
										<a href="javascript:;" class="text-secondary fw-semibold fs-7" wire:click="cancelArchitect" wire:key="cancel-role">
											Cancel <x-users.spinners.secondary-btn wire:target="cancelArchitect" />
										</a>
									@else
										<a href="javascript:;" class="text-purple-700 fw-semibold fs-7 me-2" wire:click="editArchitect('{{ $architect->id }}')" wire:key="edit-role">
											Edit <x-users.spinners.primary-btn wire:target="editArchitect('{{ $architect->id }}')" />
										</a>
										<a href="javascript:" class="text-secondary fw-semibold fs-7">
											Delete
										</a>
									@endif
								@endif
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-12">
			<p class="m-0 text-end">
				<a href="{{ route('architect.account.profile.invite-colleague') }}" class="btn btn-primary fw-medium">Invite Colleague</a>
			</p>
		</div>
	</div>
</div>

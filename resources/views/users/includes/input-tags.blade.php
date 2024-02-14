<div>
	<div x-data="{tags: @entangle('form.tags'), newTag: '' }">
		<template x-for="tag in tags">
			<input type="hidden" :value="tag" name="tags">
		 </template>
		<div class="max-w-sm w-full ">
			<div class="tags-input">
				<input class="form-control @error('form.tags') is-invalid @enderror"
								@keydown.enter.prevent="if (newTag.trim() !== '') tags.push(newTag.trim().toLowerCase()); newTag = ''"
								@input.debounce="if (newTag.includes(',')) { tags.push(newTag.split(',')[0].trim().toLowerCase()); newTag = ''; }"
								{{-- @keydown.space.prevent="if (newTag.trim() !== '') tags.push(newTag.trim().toLowerCase()); newTag = ''" --}}
								{{-- @keydown.backspace="if (newTag.trim() === '') tags.pop()" --}}
								x-model="newTag"
				>
				<div class="mt-2">
					<template x-for="tag in tags" :key="tag">
						<span class="tags-input-tag badge rounded-pill bg-primary me-1">
							<span x-text="tag" class="fs-6 align-middle"></span>
							<button type="button" class="tags-input-remove btn-close btn-close-white align-middle" @click="tags = tags.filter(i => i !== tag)"></button>
						</span>
					</template>
				</div>
				
			</div>
		 </div>
	</div>
	<div id="tagsHelpBlock" class="form-text">Press enter or comma to add tags.</div>
	@error('form->tags')<div class="invalid-feedback">{{ $message }}</div>@enderror
</div>
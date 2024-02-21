<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 99%;">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title mx-auto" id="modalLabel">Crop Cover Image Before Upload</h5>
				{{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button> --}}
			</div>
			<div class="modal-body">
				<div class="img-container">
					<div class="row">
						<div class="col-md-8">
							<img id="image" src="https://avatars0.githubusercontent.com/u/3456749" class="img-fluid" alt="..." />
						</div>
						<div class="col-md-4">
							<div class="preview"></div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="mx-auto">
					<button type="button" class="btn btn-primary" id="crop" @click="cropFile" style="width: 90px;">Crop</button>
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="width: 90px;">Cancel</button>
				</div>
			</div>
		</div>
	</div>
</div>
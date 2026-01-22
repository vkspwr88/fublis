@push('scripts')
<script>
	const $modal = $('#modal');
	const image = document.getElementById('image');
	let cropper;

	$modal.on('shown.bs.modal', function () {
		cropper = new Cropper(image, {
			aspectRatio: 2/1,
			viewMode: 1,
			preview: '.preview',
		});
	}).on('hidden.bs.modal', function () {
		cropper.destroy();
		cropper = null;
	});

	window.addEventListener('hide-media-kit-limit-alert-modal', event => {
		$('#addMediaKitAlertModal').modal('hide');
	});
	window.addEventListener('show-media-kit-limit-alert-modal', event => {
		$('#addMediaKitAlertModal').modal('show');
	});
</script>
@endpush

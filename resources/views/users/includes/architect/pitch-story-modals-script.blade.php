@push('scripts')
	<script>
		window.addEventListener('hide-select-contact-modal', event => {
			$('#selectContactModal').modal('hide');
		});
		window.addEventListener('show-select-contact-modal', event => {
			$('#selectContactModal').modal('show');
		});

		window.addEventListener('hide-select-mediakit-modal', event => {
			$('#selectMediaKitModal').modal('hide');
		});
		window.addEventListener('show-select-mediakit-modal', event => {
			$('#selectMediaKitModal').modal('show');
		});

		window.addEventListener('hide-send-message-modal', event => {
			$('#sendMessageModal').modal('hide');
		});
		window.addEventListener('show-send-message-modal', event => {
			$('#sendMessageModal').modal('show');
		});

		window.addEventListener('hide-pitch-success-modal', event => {
			$('#pitchSuccessModal').modal('hide');
		});
		window.addEventListener('show-pitch-success-modal', event => {
			$('#pitchSuccessModal').modal('show');
		});
	</script>
@endpush

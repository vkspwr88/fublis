@push('scripts')
	<script>
		window.addEventListener('set-message', event => {
			let editor = document.querySelector("trix-editor");
			console.log(event.detail[0].message, editor);
			editor.editor.loadHTML(event.detail[0].message);
		});

		window.addEventListener('hide-select-publication-modal', event => {
			$('#selectPublicationModal').modal('hide');
		});
		window.addEventListener('show-select-publication-modal', event => {
			$('#selectPublicationModal').modal('show');
		});

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

		window.addEventListener('hide-pitch-publication-success-modal', event => {
			$('#pitchPublicationSuccessModal').modal('hide');
		});
		window.addEventListener('show-pitch-publication-success-modal', event => {
			$('#pitchPublicationSuccessModal').modal('show');
		});

		window.addEventListener('hide-pitch-journalist-success-modal', event => {
			$('#pitchJournalistSuccessModal').modal('hide');
		});
		window.addEventListener('show-pitch-journalist-success-modal', event => {
			$('#pitchJournalistSuccessModal').modal('show');
		});

		window.addEventListener('hide-pitch-call-success-modal', event => {
			$('#pitchCallSuccessModal').modal('hide');
		});
		window.addEventListener('show-pitch-call-success-modal', event => {
			$('#pitchCallSuccessModal').modal('show');
		});

		window.addEventListener('hide-pitch-premium-alert-modal', event => {
			$('#pitchCallPremiumAlertModal').modal('hide');
		});
		window.addEventListener('show-pitch-premium-alert-modal', event => {
			$('#pitchCallPremiumAlertModal').modal('show');
		});

		window.addEventListener('hide-pitch-limit-alert-modal', event => {
			$('#pitchTotalLimitAlertModal').modal('hide');
		});
		window.addEventListener('show-pitch-limit-alert-modal', event => {
			$('#pitchTotalLimitAlertModal').modal('show');
		});
	</script>
@endpush

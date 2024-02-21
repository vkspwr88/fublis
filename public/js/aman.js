$('trix-toolbar .trix-button--icon-link, trix-toolbar .trix-button--icon-code, trix-toolbar .trix-button-group--file-tools, trix-toolbar .trix-button--icon-attach').remove();

window.addEventListener('alert', event => {
    const type = event.detail[0].type;
    const message = event.detail[0].message;
    const title = event.detail[0].title ?? '';
    const options = {
        'closeButton': true,
        'progressBar': true,
        'showDuration': '300',
        'hideDuration': '5000',
        'timeOut': '5000',
    };
    switch(type){
        case 'success':
            toastr.success(message, title ?? '', options);
            break;
        case 'warning':
            toastr.warning(message, title ?? '', options);
            break;
        case 'error':
            toastr.error(message, title ?? '', options);
            break;
        case 'info':
            toastr.info(message, title ?? '', options);
            break;
        default:
            toastr.info(message, title ?? '', options);
    };
});

function togglePassword(element){
	const toggleBtn = element + 'Toggle';
	if($(element).attr('type') === 'password'){
		$(element).attr('type', 'text');
		$(toggleBtn).html('<i class="bi bi-eye-slash"></i>');
	}
	else{
		$(element).attr('type', 'password');
		$(toggleBtn).html('<i class="bi bi-eye"></i>');
	}
}

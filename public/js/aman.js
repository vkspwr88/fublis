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

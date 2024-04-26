// $('trix-toolbar .trix-button--icon-link, trix-toolbar .trix-button--icon-code, trix-toolbar .trix-button-group--file-tools, trix-toolbar .trix-button--icon-attach').remove();

$('trix-toolbar .trix-button--icon-code').remove();

window.addEventListener('alert', event => {
	// console.log('alert', event);
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

window.addEventListener('get-focus', event => {
	console.log(event);
	/* const element = event.detail[0].element;
	$(element).focus();
	window.location.hash = element; */
	const element = document.querySelector(event.detail[0].element);
	element.scrollIntoView({
		behavior: 'smooth',
		block: 'start'
	});
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

function createAccountPrompt(){
	Swal.fire({
		title: '',
		text: 'Please create an account',
		icon: 'warning',
		showCancelButton: true,
		  confirmButtonText: 'Sign Up'
	}).then((result) => {
		if (result.isConfirmed) {
			window.location = '/user/signup';
		}
	});
}

function showAlert(details){

	// Create the event
	const event = new CustomEvent('alert', {
		detail: [details]
	});
	// Dispatch/Trigger/Fire the event
	window.dispatchEvent(event);
}

/* $(document).on('focusin', '.nav-sub-menu', function(e){
	e.preventDefault();
	console.log($(this), $(this).parent());
	$(this).parent().addClass('mouse-hover');
});

$(document).on('focusout', '.nav-sub-menu', function(e){
	e.preventDefault();
	console.log($(this), $(this).parent());
	$(this).parent().removeClass('mouse-hover');
}); */

$(document).on('mouseover', '.hover', function() {
	const $this = $(this);
	$this.removeClass("hover");
	setTimeout(function() {
		$this.addClass("hover")
	}, 20);
});

(function() {
	const HOST = uploadHostUrl;

	/* addEventListener('trix-file-accept', function(event) {
		// event.preventDefault();
		console.log('trix-file-accept', event.file);
	}) */

	addEventListener('trix-attachment-add', function(event) {
		if (event.attachment.file) {
			uploadFileAttachment(event.attachment)
		}
	})

	function uploadFileAttachment(attachment) {
		uploadFile(attachment.file, setProgress, setAttributes)

		function setProgress(progress) {
			attachment.setUploadProgress(progress)
		}

		function setAttributes(attributes) {
			attachment.setAttributes(attributes)
		}
	}

	function uploadFile(file, progressCallback, successCallback) {
		let key = createStorageKey(file)
		let formData = createFormData(key, file)
		let xhr = new XMLHttpRequest()

		xhr.open("POST", HOST, true)

		xhr.upload.addEventListener("progress", function(event) {
			let progress = event.loaded / event.total * 100
			progressCallback(progress)
		})

		xhr.addEventListener("load", function(event) {
			// console.log('load', event);
			// console.log('xhr', xhr);
			if (xhr.status == 200) {
				const response = JSON.parse(xhr.response);
				let attributes = {
					/* url: HOST + key,
					href: HOST + key + "?content-disposition=attachment" */
					url: response.url,
					href: response.href,
				}
				successCallback(attributes)
				// console.log('successCallback', attributes);
			}
		})

	  	xhr.send(formData)
	}

	function createStorageKey(file) {
		let date = new Date()
		let day = date.toISOString().slice(0,10)
		let name = date.getTime() + "-" + file.name
		return [ "tmp", day, name ].join("/")
	}

	function createFormData(key, file) {
		let data = new FormData()
		data.append("key", key)
		data.append("Content-Type", file.type)
		data.append("file", file)
		return data
	}

	/* const REMOVEHOST = removeHostUrl;

	addEventListener('trix-attachment-remove', function(event) {
		event.preventDefault();
		console.log('trix-attachment-remove', event.attachment);

		$.ajax({
			url: REMOVEHOST,
			type: 'POST',
			data: {
				'path': event.attachment.attachment.previewURL
			},
			success: function(success){
				console.log('success', success);
			},
			error: function(error){
				console.log('error', error);
			}
		});
	}) */
})();



let inputAllowed = false;
$(document).on('keydown', '.otp-inputs', function (e) {
	if( (e.which >= 48 && e.which <= 57) || (e.which >= 96 && e.which <= 105)){
		inputAllowed = true;
	}
	else if (e.key.length === 1){
		inputAllowed = false;
		e.preventDefault();
	}
	/* if (48 > e.which || e.which > 57){
		if (e.key.length === 1){
			inputAllowed = false;
			e.preventDefault();
		}
	}
	else{
		inputAllowed = true;
	} */
});
$(document).on('keyup', '.otp-inputs', function (e) {
	if(e.which == 8){
		$(this).prev('.otp-inputs').focus();
	}
	else if(inputAllowed){
		$(this).next('.otp-inputs').focus();
	}
});

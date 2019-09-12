$(document).ready(function () {

	/*
	* Disable Contact Form 7 submit button
	* when it is clicked and AJAX didn't respond yet
	* to prevent repeating requests
	* */

	var button
	var disableSubmit = false;
	$('.wpcf7-form').submit(function() {

		button = $(this).find('input[type = submit]')
		$(button).attr('disabled','disabled')
		$(button).attr('value',"Sending...")
		if (disableSubmit == true) {
			return false;
		}
		disableSubmit = true;
		return true;
	})

	var wpcf7Elm = document.querySelector( '.wpcf7' );
	wpcf7Elm.addEventListener( 'wpcf7submit', function( event ) {
		$(button).removeAttr('disabled')
		$(button).attr('value',"Send")
		disableSubmit = false;
	}, false );


})
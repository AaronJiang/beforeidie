$(document).ready(function(){

	// if both are empty, hide it
	$('#form-feedback').submit(function(){
		var fbContent = $.trim($('#feedback-content').val());

		// if both are empty, hide the panel
		if(fbContent == ''){
			$('#feedback-panel').animate({'right':'-200px'}, 'fast');
			return false;
		}
	});

	// show & hide
	$('#feedback-tag').click(function(){
		var rightLen = $('#feedback-panel').css('right');

		// show
		if(rightLen == '-200px'){
			$('#feedback-panel').animate({'right':'0px'}, 'fast');
			$('#feedback-content').focus();
		}
		else if(rightLen == '0px') {
			$('#feedback-panel').animate({'right':'-200px'}, 'fast');
		}
		else {
			$('#feedback-panel').animate({'right':'-200px'}, 'fast');
		}
	});

});
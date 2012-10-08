$(document).ready(function(){
	$('#form-feedback').validationEngine({
			promptPosition: 'topLeft',
			scroll: false
		});

	$('#feedback-tag').toggle(function(){
		$(this).parent().animate({'right':'0px'}, 'fast');
	}, 
	function(){
		$(this).parent().animate({'right':'-200px'}, 'fast');
	});
});
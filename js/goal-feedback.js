$(document).ready(function(){
	$('#feedback-tag').toggle(function(){
		$(this).parent().animate({'right':'0px'}, 'fast');
	}, 
	function(){
		$(this).parent().animate({'right':'-200px'}, 'fast');
	});
});

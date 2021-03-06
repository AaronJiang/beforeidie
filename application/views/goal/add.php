<?php if($isFull): ?>

<p>已经9个了，请保持简单。</p>

<?php else: ?>

<script type="text/javascript">

// simulate placeholder on any element
function simuPlaceholder(selector, placeholder){

	var label = document.createElement('label');

	$(label).text(placeholder).css({
		'position' : 'absolute',
		'color' : 'gray',
		'cursor' : 'text',
		'font-size' :  '16px',
		'font-family' : '宋体'
	}).insertBefore(selector);

	$(label).click(function(){
		$(this).hide();
		$(selector).focus();
	});

	$(selector).focus(function(){
		$(label).hide();
	});	
}

$(document).ready(function(){

	$('#goal-title').trigger('focus');

	// simulate placeholder on goal-content
	simuPlaceholder('#goal-content', '内容');

	// switch lock state
	$('.btn-lock').click(function(){
		var isPublic = $(this).attr('data-is-public');

		if(isPublic == 1){
			$(this).removeClass('btn-lock-false');
			$(this).attr({'data-is-public': 0}); 
		}
		else{
			$(this).addClass('btn-lock-false');
			$(this).attr({'data-is-public': 1});
		}
	});

	// new goal
	$('#btn-new-goal').click(function(){

		var title = $.trim($('#goal-title').text());

		if(title == '')
			return;

		var content = $.trim($('#goal-content').html()),
			userID = $('#goal-title').attr('data-user-id'),
			isPublic = $('.btn-lock').first().attr('data-is-public');

		$.ajax({
			url: "<?= base_url('goal/add_goal') ?>",
			type: 'POST',
			data: {
				'userID': userID,
				'title': title,
				'content': content,
				'isPublic': isPublic,
				<?= $this->security->get_csrf_token_name(); ?> : '<?= $this->security->get_csrf_token_hash(); ?>'
			},
			success: function(isSucc){
				if(isSucc == 1){
					window.location = "<?= base_url('person') ?>";
				}
			}
		});
	});
});

</script>

<div id="goal-title-wap">
	<h2 id="pre">Before I die I want to</h2>
	<h2 id="goal-title" data-user-id="<?= $userID ?>" contenteditable="true"></h2>

	<div id="extra-info-wap">
		<span class="btn-icon btn-lock btn-lock-false" data-is-public="1"></span>
	</div>
</div>

<div id="goal-content" contenteditable="true">
	<div></div>
</div>

<a id="btn-new-goal" class="btn btn-primary">添加</a>

<?php endif; ?>
<?php if($isFull): ?>

<p>已经有16个愿望了，请保持简单。</p>

<?php else: ?>

<script type="text/javascript">

var isSaved = false;

$(document).ready(function(){

	$('#goal-title').focus();

	// 切换lock状态
	$('.btn-lock').click(function(){
		var isPublic = $(this).attr('data-is-public');

		if(isPublic == 1){
			$(this).removeClass('btn-lock-false');
			$(this).attr({'data-is-public': 0}); 
		} else {
			$(this).addClass('btn-lock-false');
			$(this).attr({'data-is-public': 1});
		}
	});

	// 避免意外的关闭
	$(window).unload(function(){

		/*
		if( ! isSaved){
			return;
		}

		var title = $.trim($('#goal-title').text());

		if(title == '')
			return;

		var	content = $('#goal-content').html(),
			userID = $('#goal-title').attr('data-user-id'),
			isPublic = $('.btn-lock').first().attr('data-is-public');

		$.ajax({
			url: "<?= base_url('goal/add_goal') ?>",
			type: 'POST',
			async: false,
			data: {
				'userID': userID,
				'title': title,
				'content': content,
				'isPublic': isPublic
			},
			// 成功则跳转
			success: function(isSucc){
				if(isSucc == 1){}
			}
		});
		*/
	});

	// 新建
	$('#btn-new-goal').click(function(){

		var title = $.trim($('#goal-title').text());

		if(title == '')
			return;

		var	content = $('#goal-content').html(),
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
				<?= $this->security->get_csrf_token_name(); ?> : '<?= $this->security->get_csrf_hash(); ?>'
			},
			success: function(isSucc){
				if(isSucc == 1){
					isSaved = true;
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
	<span class="btn-icon btn-lock btn-lock-false" data-is-public="1"></span>
</div>

<div id="goal-content" contenteditable="true"><div></div></div>

<a id="btn-new-goal" class="btn btn-primary">添加</a>

<?php endif; ?>
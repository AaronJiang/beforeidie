<script type="text/javascript">

$(document).ready(function(){
	<?php if($isCreator): ?>

	// save
	$(window).unload(function(){

		var goalID = $('#goal-title').data('goal-id'),
			goalTitle = $.trim($('#goal-title').text()),
			goalContent = $.trim($('#goal-content').html());

		if(goalTitle == ''){
			return;
		}
			
		$.ajax({
			url: "<?= base_url('goal/update_goal') ?>",
			type: 'POST',
			async: false,
			data: {
				'goalID': goalID,
				'goalTitle': goalTitle,
				'goalContent': goalContent,
				<?= $this->security->get_csrf_token_name(); ?>: '<?= $this->security->get_csrf_token_hash(); ?>'
			},
			success: function(isSucc){
				if(isSucc == 1){}
			}
		});
	});

	// lock
	$('.btn-lock').click(function(){
		var goalID = $(this).attr('data-goal-id'),
			isPublic = $(this).attr('data-is-public'),
			btn = $(this);

		$.ajax({
			url: "<?= base_url('goal/change_goal_lock') ?>",
			type: 'POST',
			data: {
				'goalID': goalID,
				'isPublic': isPublic,
				<?= $this->security->get_csrf_token_name(); ?>: '<?= $this->security->get_csrf_token_hash(); ?>'
			},
			success: function(isSucc){
				if(isSucc == 1){
					// 切换图标样式
					if(isPublic == 1){
						// 若之前为 unlock
						$(btn).removeClass('btn-lock-false');
						$(btn).attr({'title': '开锁啦', 'data-is-public': 0});
					} else {
						// 若之前为 lock
						$(btn).addClass('btn-lock-false');
						$(btn).attr({'title': '锁起来，只给自己看', 'data-is-public': 1});
					}
				}
			}
		});
	});

	<?php else: ?>

	// like
	$('.btn-like').click(function(){
		var goalID = $(this).attr('data-goal-id'),
			userID = $(this).attr('data-user-id'),
			isLike = $(this).attr('data-is-like'),
			btn = $(this);

		$.ajax({
			url: "<?= base_url('goal/change_goal_like') ?>",
			type: 'POST',
			data: {
				'goalID': goalID,
				'userID': userID,
				'isLike': isLike,
				<?= $this->security->get_csrf_token_name(); ?>: '<?= $this->security->get_csrf_token_hash(); ?>'
			},
			success: function(isSucc){
				if(isSucc == 1){
					if(isLike == 1){
						// 若之前为 like
						$(btn).addClass('btn-like-false');
						$(btn).attr('data-is-like', 0);
					} else {
						// 若之前为 unlike
						$(btn).removeClass('btn-like-false');
						$(btn).attr('data-is-like', 1);
					}
				}
			}
		});
	});

	<?php endif; ?>
});

</script>


<div id='goal-title-wap'>
	<h2 id="pre">
		<?php if($isCreator): ?>
			Before I die I want to
		<?php else: ?>
			<?php if($goal->UserSex == 'male'): ?>
			Before he dies he wants to
			<?php else: ?>
			Before she dies she wants to
			<?php endif; ?>
		<?php endif; ?>
	</h2>

	<h2 id="goal-title" data-goal-id="<?=$goal->GoalID ?>"
		<?php if($isCreator): ?>contenteditable="true"<?php endif; ?>
		><?= $goal->Title ?></h2>

	<div id="extra-info-wap">
		<?php if($isCreator): ?>

			<!-- lock -->
			<?php if($goal->IsPublic): ?>
			<span class="btn-icon btn-lock btn-lock-false" data-goal-id="<?= $goal->GoalID ?>" data-is-public="1" title="上锁"></span>
			<?php else: ?>
			<span class="btn-icon btn-lock" data-goal-id="<?= $goal->GoalID ?>" data-is-public="0" title="上锁"></span>
			<?php endif; ?>
		
		<?php else: ?>

			<!-- creator -->
			<span id="goal-creator">by <a href="<?= base_url('person/'.$goal->UserID) ?>"><?= $goal->Username ?></a></span>

			<!-- like -->
			<?php if(isset($isLike)): ?>

				<?php if($isLike): ?>
				<span class="btn-icon btn-like" title="喜欢" data-goal-id="<?= $goal->GoalID ?>" data-user-id="<?= $currUserID ?>" data-is-like="1"></span>
				<?php else: ?>
				<span class="btn-icon btn-like btn-like-false" title="喜欢" data-goal-id="<?= $goal->GoalID ?>" data-user-id="<?= $currUserID ?>" data-is-like="0"></span>
				<?php endif; ?>

			<?php endif; ?>

		<?php endif; ?>
	</div>
</div>

<div id="goal-content" data-goal-id="<?= $goal->GoalID ?>"
	<?php if($isCreator): ?>contenteditable="true"<?php endif; ?>
	><?= stripslashes($goal->Content) ?>
</div>
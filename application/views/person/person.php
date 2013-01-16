<script type="text/javascript">

$(document).ready(function(){
	
	// index
	$('.goal-index').each(function(index){
		$(this).text(index + 1);
	});

	<?php if($isCreator): ?>

	$('.goal-wap').sortable({
		placeholder: "goal-item-highlight",
		start: function(event, ui){
			ui.item.css('border-bottom', '1px solid #F2F2F2');
			ui.item.css('background-color', '#FAFAFA');
		},
		stop: function(event, ui){
			ui.item.css('border-bottom', 'none');
			ui.item.css('background-color', 'white');

			// 组装数组
			var idArray = '',
				indexArray = '',
				isFirstChanged = 1;	// 是否为第一个待变更的元素

			$('.goal-index').each(function(index){
				var preIndex = $(this).attr('data-goal-index');

				if(preIndex != index){
					// 数组开头不加&
					if(isFirstChanged == 1){
						isFirstChanged = 0;
					}else{
						idArray += '&';
						indexArray += '&';
					}

					idArray += $(this).attr('data-goal-id');
					indexArray += index;
				}
			});

			// 若未改动次序，则不发送ajax
			if(idArray.length == 0){
				return;
			}

			// 排序
			$.ajax({
				url: "<?=base_url('person/change_goal_index') ?>",
				type: 'POST',
				data: {
					idArray: idArray,
					indexArray: indexArray
				},
				success: function(isSucc){
					if(isSucc == 1){}
				}
			});

			// 重新排序
			$('.goal-index').each(function(index){
				$(this).text(index + 1);
				$(this).attr('data-goal-index', index);
			});
		}
	});
	$('.goal-wap').disableSelection();

	// lock
	$('.btn-lock').click(function(){
		var goalID = $(this).attr('data-goal-id'),
			isPublic = $(this).attr('data-is-public'),
			btn = $(this);

		$.ajax({
			url: "<?=base_url('person/change_goal_lock') ?>",
			type: 'POST',
			data: {
				'goalID': goalID,
				'isPublic': isPublic
			},
			success: function(isSucc){
				if(isSucc){
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

	// delete
	$('.btn-remove').click(function(){
		var goalID = $(this).attr('data-goal-id'),
			goalTitle = $(this).attr('data-goal-title'),
			isSure = confirm('确定舍弃 ' + goalTitle + " ?"),
			goalItem = $(this).parents('.goal-item').first();

		if(isSure){
			$.ajax({
				url: "<?=base_url('person/drop_goal') ?>",
				type: 'POST',
				data: {
					'goalID': goalID
				},
				success: function(isSucc){
					if(isSucc){
						$(goalItem).detach();

						// refresh index
						$('.goal-index').each(function(index){
							$(this).text(index + 1);
						});
					}
				}
			});
		}
	});

	<?php endif; ?>
});

</script>

<div id='user-info-wap' class="clearleft">
	<?php if($isCreator AND ! $hasGravatar): ?>
	<a href="http://cn.gravatar.com/" target="_blank" title="去 Gravatar 上传你的头像，全球通用哦，亲！"><img class="avatar avatar-side avatar-large" src="<?=$user->AvatarUrl ?>" /></a>
	<?php else: ?>
	<img class='avatar avatar-side avatar-large' src="<?=$user->AvatarUrl ?>" />
	<?php endif; ?>

	<div id="user-info">
		<div id="title">
		<?php if($isCreator): ?>
			Before I die I want to...
		<?php else: ?>
			<?php if($user->Sex == 'male'): ?>
			Before he dies he wants to...
			<?php else: ?>
			Before she dies she wants to...
			<?php endif; ?>
		<?php endif; ?>
		</div>
		<div id="username"><?=$user->Username?></div>
	</div>
</div>

<?php if(count($goals) == 0): ?>

<div id="null-warning">还没有任何东东哦，你可以 <a href="<?= base_url('goal/add') ?>">添加</a> 一个条目，或者先随便 <a href="<?= base_url('discover') ?>">逛逛</a> 啦~</div>

<?php else: ?>

<div class='goal-wap'>

	<?php foreach($goals as $goal): ?>
	<div class="goal-item">
		<span class='goal-index <?php if($isCreator): ?>goal-dragable<?php endif; ?>' data-goal-index="<?=$goal->GoalIndex ?>" data-goal-id="<?=$goal->GoalID ?>"></span>
		<a class="goal-title" href="<?=base_url('goal/'. $goal->GoalID) ?>"><?=$goal->Title ?></a>
		
		<?php if($isCreator): ?>
		<div class="extra-info-wap">

			<!-- lock -->
			<?php if($goal->IsPublic): ?>
			<span class="btn-icon btn-lock btn-lock-false" data-goal-id="<?=$goal->GoalID ?>" data-is-public="1" title="锁起来，只给自己看"></span>
			<?php else: ?>
			<span class="btn-icon btn-lock" data-goal-id="<?=$goal->GoalID ?>" data-is-public="0" title="开锁啦"></span>
			<?php endif; ?>

			<!-- delete -->
			<span class="btn-icon btn-remove" data-goal-id="<?=$goal->GoalID ?>" data-goal-title="<?=$goal->Title ?>" title="去掉它"></span>
		</div>
		<?php endif; ?>
	</div>
	<?php endforeach; ?>
</div>

<?php endif; ?>

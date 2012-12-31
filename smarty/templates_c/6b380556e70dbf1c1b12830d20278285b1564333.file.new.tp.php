<?php /* Smarty version Smarty-3.1.12, created on 2012-12-28 11:35:25
         compiled from "..\view\goal\new.tp" */ ?>
<?php /*%%SmartyHeaderCode:225625092389e5c3365-55689534%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b380556e70dbf1c1b12830d20278285b1564333' => 
    array (
      0 => '..\\view\\goal\\new.tp',
      1 => 1356686771,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '225625092389e5c3365-55689534',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5092389e6abef7_81803631',
  'variables' => 
  array (
    'isFull' => 0,
    'userID' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5092389e6abef7_81803631')) {function content_5092389e6abef7_81803631($_smarty_tpl) {?><?php echo $_smarty_tpl->getSubTemplate ('../header.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array('title'=>"新",'page'=>'page-new-goal'), 0);?>


<?php if ($_smarty_tpl->tpl_vars['isFull']->value){?>

<p>已经有16个愿望了，请让生命保持简单。</p>

<?php }else{ ?>

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

		if(isSaved == true)
			return;

		var title = $.trim($('#goal-title').text());

		if(title == '')
			return;

		var	content = $('#goal-content').html(),
			userID = $('#goal-title').attr('data-user-id'),
			isPublic = $('.btn-lock').first().attr('data-is-public');

		$.ajax({
			url: 'GoalC.php',
			type: 'POST',
			async: false,
			data: {
				'act': 'new_goal',
				'userID': userID,
				'title': title,
				'content': content,
				'isPublic': isPublic
			},
			success: function(){
				window.history.go(-1);
			}
		});
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
			url: 'GoalC.php',
			type: 'POST',
			data: {
				'act': 'new_goal',
				'userID': userID,
				'title': title,
				'content': content,
				'isPublic': isPublic
			},
			success: function(){
				isSaved = true;
				window.history.go(-1);
			}
		});
	});
});

</script>


<div id="goal-title-wap">
	<h2 id="pre">Before I die I want to</h2>
	<h2 id="goal-title" data-user-id="<?php echo $_smarty_tpl->tpl_vars['userID']->value;?>
" contenteditable="true"></h2>
	<span class="btn-icon btn-lock btn-lock-false" data-is-public="1"></span>
</div>

<div id="goal-content" contenteditable="true"><div></div></div>

<a id="btn-new-goal" class="btn btn-primary">添加</a>

<?php }?>

<?php echo $_smarty_tpl->getSubTemplate ('../footer.tc', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null, array(), 0);?>
<?php }} ?>
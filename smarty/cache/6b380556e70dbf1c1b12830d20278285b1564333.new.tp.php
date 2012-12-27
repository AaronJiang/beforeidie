<?php /*%%SmartyHeaderCode:2342250dc532fa56ed2-42168688%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6b380556e70dbf1c1b12830d20278285b1564333' => 
    array (
      0 => '..\\view\\goal\\new.tp',
      1 => 1356266732,
      2 => 'file',
    ),
    '10a14be1ec1cbc88fbdb1c1c0b43bd71e78d5980' => 
    array (
      0 => 'D:\\xampp\\htdocs\\beforeidie\\view\\header.tc',
      1 => 1356615501,
      2 => 'file',
    ),
    'fabbb9ae3ac75ea5efca630c838f2446e6e93053' => 
    array (
      0 => 'D:\\xampp\\htdocs\\beforeidie\\view\\footer.tc',
      1 => 1356615471,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2342250dc532fa56ed2-42168688',
  'variables' => 
  array (
    'isFull' => 0,
    'userID' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50dc532fb16b03_90263365',
  'cache_lifetime' => 3600,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50dc532fb16b03_90263365')) {function content_50dc532fb16b03_90263365($_smarty_tpl) {?><!DOCTYPE html><html>	<head>		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		<title>新</title>		<link rel="stylesheet" href="../style/jquery-ui-1.8.22.custom.css" />		<link rel="stylesheet" href="../style/style.css" />		<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>		<script type="text/javascript" src="../js/jquery-ui-1.8.22.custom.min.js"></script>		<script type="text/javascript" src="../js/jquery.ui.datepicker-zh-CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine-zh_CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>		<link rel="stylesheet" href="../style/validationEngine.jquery.css" type="text/css"/>		<script type="text/javascript" src="../js/goal-feedback.js"></script>	</head>	<body id="page-new-goal">		<div id="feedback-panel">			<div id="feedback-tag"></div>			<form action="PublicC.php" method="post" id="form-feedback">				<input id="feedback-subject" name="feedbackSubject" placeholder="主题（可不填）" autocomplete="off" type="text" />				<textarea id="feedback-content" class="validate[required]" name="feedbackContent" rows="10" placeholder="建议内容"></textarea>				<input class="btn btn-primary" type="submit" value="发送" />				<input type="hidden" name="act" value="send_feedback" />			</form>		</div>		<div id="header">			<div class="container">				<ul id="nav">					<li><span id="logo" class="btn-icon"></span></li>										<li><a href="PersonC.php?act=person">首页</a></li>					<li><a href="LikeC.php?act=mylikes">收藏</a></li>										<li><a href="DiscoverC.php?act=discover">浏览</a></li>										<li><a href="GoalC.php?act=new">添加</a></li>									</ul>								<div id="account-info">										<a href="AccountC.php?act=details">hustlzp</a>					<a href="PublicC.php?act=logout">登出</a>									</div>			</div>		</div>		<div id="content-wap" class="container">


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
	<h2 id="goal-title" data-user-id="0" contenteditable="true"></h2>
	<span class="btn-icon btn-lock btn-lock-false" data-is-public="1"></span>
</div>

<div id="goal-content" contenteditable="true"><div></div></div>

<a id="btn-new-goal" class="btn btn-primary">添加</a>


		</div>
	
		<div id='footer'>
			<a href='HomeC.php?act=about'>关于</a>
			<span>2012 © beforeidie.asia</span>
		</div>
	</body>
</html><?php }} ?>
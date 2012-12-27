<?php /*%%SmartyHeaderCode:651850dc52a805b016-71859922%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '6c71f1ce3e74505d967d613caadd6976236f3c18' => 
    array (
      0 => '..\\view\\goal\\details.tp',
      1 => 1356597315,
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
  'nocache_hash' => '651850dc52a805b016-71859922',
  'variables' => 
  array (
    'goal' => 0,
    'isCreator' => 0,
    'creator' => 0,
    'isLike' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50dc52a8230b17_63214831',
  'cache_lifetime' => 3600,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50dc52a8230b17_63214831')) {function content_50dc52a8230b17_63214831($_smarty_tpl) {?><!DOCTYPE html><html>	<head>		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		<title>做有意义的软件</title>		<link rel="stylesheet" href="../style/jquery-ui-1.8.22.custom.css" />		<link rel="stylesheet" href="../style/style.css" />		<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>		<script type="text/javascript" src="../js/jquery-ui-1.8.22.custom.min.js"></script>		<script type="text/javascript" src="../js/jquery.ui.datepicker-zh-CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine-zh_CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>		<link rel="stylesheet" href="../style/validationEngine.jquery.css" type="text/css"/>		<script type="text/javascript" src="../js/goal-feedback.js"></script>	</head>	<body id="page-goal-details">		<div id="feedback-panel">			<div id="feedback-tag"></div>			<form action="PublicC.php" method="post" id="form-feedback">				<input id="feedback-subject" name="feedbackSubject" placeholder="主题（可不填）" autocomplete="off" type="text" />				<textarea id="feedback-content" class="validate[required]" name="feedbackContent" rows="10" placeholder="建议内容"></textarea>				<input class="btn btn-primary" type="submit" value="发送" />				<input type="hidden" name="act" value="send_feedback" />			</form>		</div>		<div id="header">			<div class="container">				<ul id="nav">					<li><span id="logo" class="btn-icon"></span></li>										<li><a href="PersonC.php?act=person">首页</a></li>					<li><a href="LikeC.php?act=mylikes">收藏</a></li>										<li><a href="DiscoverC.php?act=discover">浏览</a></li>										<li><a href="GoalC.php?act=new">添加</a></li>									</ul>								<div id="account-info">										<a href="AccountC.php?act=details">hustlzp</a>					<a href="PublicC.php?act=logout">登出</a>									</div>			</div>		</div>		<div id="content-wap" class="container">

<script type='text/javascript' src='../js/goal-comment.js'></script>
<script type="text/javascript">


$(document).ready(function(){

	// save
	$(window).unload(function(){
		var goalID = $('#goal-title').data('goal-id'),
			goalTitle = $('#goal-title').text(),
			goalContent = $('#goal-content').html();
			
		$.ajax({
			url: 'GoalC.php',
			type: 'POST',
			async: false,
			data: {
				'act': 'update_goal',
				'goalID': goalID,
				'goalTitle': goalTitle,
				'goalContent': goalContent
			}
		});
	});

	// lock
	$('.btn-lock').click(function(){
		var goalID = $(this).attr('data-goal-id'),
			isPublic = $(this).attr('data-is-public'),
			btn = $(this);

		$.ajax({
			url: 'GoalC.php',
			type: 'POST',
			data: {
				'act': 'change_goal_state',
				'goalID': goalID,
				'isPublic': isPublic
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

	// like
	$('.btn-like').click(function(){
		var goalID = $(this).attr('data-goal-id'),
			userID = $(this).attr('data-user-id'),
			isLike = $(this).attr('data-is-like'),
			btn = $(this);

		$.ajax({
			url: 'GoalC.php',
			type: 'POST',
			data: {
				'act': 'change_goal_like',
				'goalID': goalID,
				'userID': userID,
				'isLike': isLike
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
		})
	});

});


</script>

<div id='title-wap'>
	<h2 id="pre">
					Before I die I want to
			</h2>
	<h2 id="goal-title" data-goal-id="10" contenteditable="true"> 做有意义的软件</h2>
	<div id="extra-info-wap">
					<!-- lock -->
						<span class="btn-icon btn-lock btn-lock-false" data-goal-id="10" data-is-public="1" title="锁起来，只给自己看"></span>
						</div>
</div>

<div id="goal-content" data-goal-id="10" contenteditable="true"><div>做真正有意义、真正能够帮助到他人的软件。在精，不在多！</div><div><b>transy</b></div><div>Chrome插件，中英对照翻译辅助工具。已上线。</div><div>抽时间进行重构，使用一种前端MVC框架（比如blackbone.js）实现。</div><div><b>woxiang</b></div><div>记录并分享每个人发自内心想要的东西、想达到的目标、想实现的梦想。</div><div>开发中，专注于最核心的功能，争取早日上线！</div><div><b>classic</b></div><div>让所有人都能方便地欣赏到中国传统的诗/词/文（当然要精心挑选一些比较适于现代人阅读的材料，并以恰当的方式呈现出来）。我觉得无论有无清晰的盈利模式，这个项目总是蛮有意义的，现代人需要古代文学的滋养！</div><div>原型开发中。</div></div>

<!-- 不为创造者且isLike不为空 -->

		</div>
	
		<div id='footer'>
			<a href='HomeC.php?act=about'>关于</a>
			<span>2012 © beforeidie.asia</span>
		</div>
	</body>
</html><?php }} ?>
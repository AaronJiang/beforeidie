<?php /*%%SmartyHeaderCode:2882750dc529606ce01-68721232%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '408a68eee0c915ea04698cd6d0862e63ac44b953' => 
    array (
      0 => '..\\view\\person\\person.tp',
      1 => 1356615548,
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
  'nocache_hash' => '2882750dc529606ce01-68721232',
  'variables' => 
  array (
    'user' => 0,
    'isCreator' => 0,
    'hasGravatar' => 0,
    'goals' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50dc5296292390_43155637',
  'cache_lifetime' => 3600,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50dc5296292390_43155637')) {function content_50dc5296292390_43155637($_smarty_tpl) {?><!DOCTYPE html><html>	<head>		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		<title>hustlzp</title>		<link rel="stylesheet" href="../style/jquery-ui-1.8.22.custom.css" />		<link rel="stylesheet" href="../style/style.css" />		<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>		<script type="text/javascript" src="../js/jquery-ui-1.8.22.custom.min.js"></script>		<script type="text/javascript" src="../js/jquery.ui.datepicker-zh-CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine-zh_CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>		<link rel="stylesheet" href="../style/validationEngine.jquery.css" type="text/css"/>		<script type="text/javascript" src="../js/goal-feedback.js"></script>	</head>	<body id="page-person">		<div id="feedback-panel">			<div id="feedback-tag"></div>			<form action="PublicC.php" method="post" id="form-feedback">				<input id="feedback-subject" name="feedbackSubject" placeholder="主题（可不填）" autocomplete="off" type="text" />				<textarea id="feedback-content" class="validate[required]" name="feedbackContent" rows="10" placeholder="建议内容"></textarea>				<input class="btn btn-primary" type="submit" value="发送" />				<input type="hidden" name="act" value="send_feedback" />			</form>		</div>		<div id="header">			<div class="container">				<ul id="nav">					<li><span id="logo" class="btn-icon"></span></li>										<li><a href="PersonC.php?act=person">首页</a></li>					<li><a href="LikeC.php?act=mylikes">收藏</a></li>										<li><a href="DiscoverC.php?act=discover">浏览</a></li>										<li><a href="GoalC.php?act=new">添加</a></li>									</ul>								<div id="account-info">										<a href="AccountC.php?act=details">hustlzp</a>					<a href="PublicC.php?act=logout">登出</a>									</div>			</div>		</div>		<div id="content-wap" class="container">

<script type='text/javascript' src='../js/goal-comment.js'></script>
<script type="text/javascript">



$(document).ready(function(){
	
	// index
	$('.goal-index').each(function(index){
		$(this).text(index + 1);
	});



	

	// lock
	$('.btn-lock').click(function(){
		var goalID = $(this).attr('data-goal-id'),
			isPublic = $(this).attr('data-is-public'),
			btn = $(this);

		$.ajax({
			url: 'PersonC.php',
			type: 'POST',
			data: {
				'act': 'change_goal_state',
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
				url: 'PersonC.php',
				type: 'POST',
				data: {
					'act': 'drop_goal',
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

	

});

</script>

<div id='user-info-wap' class="clearleft">
		<img class='avatar avatar-side avatar-large' src='http://www.gravatar.com/avatar/a4ae9ee239aa66109e7a44e2edb2d757' />
	
	<div id="user-info">
		<div id="title">
					Before I die I want to...
				</div>
		<div id="username">hustlzp</div>
	</div>
</div>

<div class='goal-wap'>
		<div class="goal-item">
		<span class='goal-index'></span>
		<a class="goal-title" href='GoalC.php?act=details&goalID=9'>     保持健康</a>
		
				<div class="extra-info-wap">

			<!-- lock -->
						<span class="btn-icon btn-lock btn-lock-false" data-goal-id="9" data-is-public="1" title="锁起来，只给自己看"></span>
			
			<!-- delete -->
			<span class="btn-icon btn-remove" data-goal-id="9" data-goal-title="     保持健康" title="去掉它"></span>
		
		</div>
		
	</div>
		<div class="goal-item">
		<span class='goal-index'></span>
		<a class="goal-title" href='GoalC.php?act=details&goalID=10'>做有意义的软件</a>
		
				<div class="extra-info-wap">

			<!-- lock -->
						<span class="btn-icon btn-lock btn-lock-false" data-goal-id="10" data-is-public="1" title="锁起来，只给自己看"></span>
			
			<!-- delete -->
			<span class="btn-icon btn-remove" data-goal-id="10" data-goal-title="做有意义的软件" title="去掉它"></span>
		
		</div>
		
	</div>
		<div class="goal-item">
		<span class='goal-index'></span>
		<a class="goal-title" href='GoalC.php?act=details&goalID=48'> 转型互联网</a>
		
				<div class="extra-info-wap">

			<!-- lock -->
						<span class="btn-icon btn-lock btn-lock-false" data-goal-id="48" data-is-public="1" title="锁起来，只给自己看"></span>
			
			<!-- delete -->
			<span class="btn-icon btn-remove" data-goal-id="48" data-goal-title=" 转型互联网" title="去掉它"></span>
		
		</div>
		
	</div>
		<div class="goal-item">
		<span class='goal-index'></span>
		<a class="goal-title" href='GoalC.php?act=details&goalID=58'>  愿得一人心</a>
		
				<div class="extra-info-wap">

			<!-- lock -->
						<span class="btn-icon btn-lock" data-goal-id="58" data-is-public="0" title="开锁啦"></span>
			
			<!-- delete -->
			<span class="btn-icon btn-remove" data-goal-id="58" data-goal-title="  愿得一人心" title="去掉它"></span>
		
		</div>
		
	</div>
		<div class="goal-item">
		<span class='goal-index'></span>
		<a class="goal-title" href='GoalC.php?act=details&goalID=61'>安静地生活</a>
		
				<div class="extra-info-wap">

			<!-- lock -->
						<span class="btn-icon btn-lock btn-lock-false" data-goal-id="61" data-is-public="1" title="锁起来，只给自己看"></span>
			
			<!-- delete -->
			<span class="btn-icon btn-remove" data-goal-id="61" data-goal-title="安静地生活" title="去掉它"></span>
		
		</div>
		
	</div>
		<div class="goal-item">
		<span class='goal-index'></span>
		<a class="goal-title" href='GoalC.php?act=details&goalID=73'> 做饭</a>
		
				<div class="extra-info-wap">

			<!-- lock -->
						<span class="btn-icon btn-lock btn-lock-false" data-goal-id="73" data-is-public="1" title="锁起来，只给自己看"></span>
			
			<!-- delete -->
			<span class="btn-icon btn-remove" data-goal-id="73" data-goal-title=" 做饭" title="去掉它"></span>
		
		</div>
		
	</div>
		<div class="goal-item">
		<span class='goal-index'></span>
		<a class="goal-title" href='GoalC.php?act=details&goalID=75'> 职业理想</a>
		
				<div class="extra-info-wap">

			<!-- lock -->
						<span class="btn-icon btn-lock btn-lock-false" data-goal-id="75" data-is-public="1" title="锁起来，只给自己看"></span>
			
			<!-- delete -->
			<span class="btn-icon btn-remove" data-goal-id="75" data-goal-title=" 职业理想" title="去掉它"></span>
		
		</div>
		
	</div>
	</div>

		</div>
	
		<div id='footer'>
			<a href='HomeC.php?act=about'>关于</a>
			<span>2012 © beforeidie.asia</span>
		</div>
	</body>
</html><?php }} ?>
<?php /*%%SmartyHeaderCode:99650dc52b18450d7-77396961%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'fd039247c04473f593026e7bb80167af07968df0' => 
    array (
      0 => '..\\view\\discover\\discover.tp',
      1 => 1356349460,
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
  'nocache_hash' => '99650dc52b18450d7-77396961',
  'variables' => 
  array (
    'hotGoals' => 0,
    'goal' => 0,
  ),
  'has_nocache_code' => false,
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50dc52b1979828_55407714',
  'cache_lifetime' => 3600,
),true); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50dc52b1979828_55407714')) {function content_50dc52b1979828_55407714($_smarty_tpl) {?><!DOCTYPE html><html>	<head>		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		<title>发现</title>		<link rel="stylesheet" href="../style/jquery-ui-1.8.22.custom.css" />		<link rel="stylesheet" href="../style/style.css" />		<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>		<script type="text/javascript" src="../js/jquery-ui-1.8.22.custom.min.js"></script>		<script type="text/javascript" src="../js/jquery.ui.datepicker-zh-CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine-zh_CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>		<link rel="stylesheet" href="../style/validationEngine.jquery.css" type="text/css"/>		<script type="text/javascript" src="../js/goal-feedback.js"></script>	</head>	<body id="page-discover">		<div id="feedback-panel">			<div id="feedback-tag"></div>			<form action="PublicC.php" method="post" id="form-feedback">				<input id="feedback-subject" name="feedbackSubject" placeholder="主题（可不填）" autocomplete="off" type="text" />				<textarea id="feedback-content" class="validate[required]" name="feedbackContent" rows="10" placeholder="建议内容"></textarea>				<input class="btn btn-primary" type="submit" value="发送" />				<input type="hidden" name="act" value="send_feedback" />			</form>		</div>		<div id="header">			<div class="container">				<ul id="nav">					<li><span id="logo" class="btn-icon"></span></li>										<li><a href="PersonC.php?act=person">首页</a></li>					<li><a href="LikeC.php?act=mylikes">收藏</a></li>										<li><a href="DiscoverC.php?act=discover">浏览</a></li>										<li><a href="GoalC.php?act=new">添加</a></li>									</ul>								<div id="account-info">										<a href="AccountC.php?act=details">hustlzp</a>					<a href="PublicC.php?act=logout">登出</a>									</div>			</div>		</div>		<div id="content-wap" class="container"><h3 class="page-title">Before they die...</h3>		</div>
	
		<div id='footer'>
			<a href='HomeC.php?act=about'>关于</a>
			<span>2012 © beforeidie.asia</span>
		</div>
	</body>
</html><?php }} ?>
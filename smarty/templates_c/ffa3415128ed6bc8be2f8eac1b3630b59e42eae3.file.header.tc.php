<?php /* Smarty version Smarty-3.1.12, created on 2012-12-25 08:44:24
         compiled from "F:\xampp\htdocs\beforeidie\view\header.tc" */ ?>
<?php /*%%SmartyHeaderCode:1696250d850dbde79e7-99044877%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ffa3415128ed6bc8be2f8eac1b3630b59e42eae3' => 
    array (
      0 => 'F:\\xampp\\htdocs\\beforeidie\\view\\header.tc',
      1 => 1356421460,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1696250d850dbde79e7-99044877',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50d850dbe64394_26358008',
  'variables' => 
  array (
    'title' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50d850dbe64394_26358008')) {function content_50d850dbe64394_26358008($_smarty_tpl) {?><!DOCTYPE html><html>	<head>		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>		<link rel="stylesheet" href="../style/jquery-ui-1.8.22.custom.css" />		<link rel="stylesheet" href="../style/style.css" />		<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>		<script type="text/javascript" src="../js/jquery-ui-1.8.22.custom.min.js"></script>		<script type="text/javascript" src="../js/jquery.ui.datepicker-zh-CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine-zh_CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>		<link rel="stylesheet" href="../style/validationEngine.jquery.css" type="text/css"/>		<script type="text/javascript" src="../js/goal-feedback.js"></script>	</head>	<body id="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
">		<div id="feedback-panel">			<div id="feedback-tag"></div>			<form action="PublicC.php" method="post" id="form-feedback">				<input id="feedback-subject" name="feedbackSubject" placeholder="主题（可不填）" autocomplete="off" type="text" />				<textarea id="feedback-content" class="validate[required]" name="feedbackContent" rows="10" placeholder="建议内容"></textarea>				<input class="btn btn-primary" type="submit" value="发送" />				<input type="hidden" name="act" value="send_feedback" />			</form>		</div>		<div id="header">			<div class="container">				<ul id="nav">					<li><span id="logo" class="btn-icon"></span></li>					<?php if ((($tmp = @$_SESSION['valid_user'])===null||$tmp==='' ? 'unauth' : $tmp)!='unauth'){?>					<li><a href="PersonC.php?act=person">首页</a></li>					<li><a href="LikeC.php?act=mylikes">收藏</a></li>					<?php }?>					<li><a href="DiscoverC.php?act=discover">浏览</a></li>					<?php if ((($tmp = @$_SESSION['valid_user'])===null||$tmp==='' ? 'unauth' : $tmp)!='unauth'){?>					<li><a href="GoalC.php?act=new">添加</a></li>					<?php }else{ ?>					<li><a href="HomeC.php?act=about">关于</a></li>					<?php }?>				</ul>								<div id="account-info">					<?php if ((($tmp = @$_SESSION['valid_user'])===null||$tmp==='' ? 'unauth' : $tmp)=='unauth'){?>					<a href="AccountC.php?act=login">登陆</a>					<a href="AccountC.php?act=register">注册</a>					<?php }else{ ?>					<a href="AccountC.php?act=details"><?php echo $_SESSION['valid_user'];?>
</a>					<a href="PublicC.php?act=logout">登出</a>					<?php }?>				</div>			</div>		</div>		<div id="content-wap" class="container"><?php }} ?>
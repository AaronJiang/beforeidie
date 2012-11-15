<?php /* Smarty version Smarty-3.1.12, created on 2012-11-15 04:55:33
         compiled from "F:\xampp\htdocs\Dream\view\header.tc" */ ?>
<?php /*%%SmartyHeaderCode:489509235dc453670-27100161%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '29a6c5bdae96137dc78ca0b07fcd500d81ee6909' => 
    array (
      0 => 'F:\\xampp\\htdocs\\Dream\\view\\header.tc',
      1 => 1352951718,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '489509235dc453670-27100161',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_509235dc4c0ba0_13285814',
  'variables' => 
  array (
    'title' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_509235dc4c0ba0_13285814')) {function content_509235dc4c0ba0_13285814($_smarty_tpl) {?><!DOCTYPE html><html>	<head>		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>		<link rel="stylesheet" href="../style/jquery-ui-1.8.22.custom.css" />		<link rel="stylesheet" href="../style/style.css" />		<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>		<script type="text/javascript" src="../js/jquery-ui-1.8.22.custom.min.js"></script>		<script type="text/javascript" src="../js/jquery.ui.datepicker-zh-CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine-zh_CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>		<link rel="stylesheet" href="../style/validationEngine.jquery.css" type="text/css"/>		<script type="text/javascript" src="../js/goal-feedback.js"></script>	</head>	<body id="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
">			<div id="feedback-panel">			<div id="feedback-tag"></div>			<form action="PublicC.php" method="post" id="form-feedback">				<input id="feedback-subject" name="feedbackSubject" placeholder="主题（可不填）" autocomplete="off" type="text" />				<textarea id="feedback-content" class="validate[required]" name="feedbackContent" rows="10" placeholder="建议内容"></textarea>				<input class="btn btn-primary" type="submit" value="发送" />				<input type="hidden" name="act" value="send_feedback" />			</form>		</div>		<div id="header">			<div class="container">				<a id="logo-link" href="HomeC.php?act=home"></a>							<ul id="nav">					<li><a id="nav-home" href="HomeC.php?act=home">首页</a></li>					<li><a id="nav-my-goals" href="GoalC.php?act=my_goals">我的</a></li>					<li><a id="nav-followee-dynamics" href="DynC.php?act=dyns">动态</a></li>					<li><a id="nav-person" href="PersonC.php?act=person&userID=<?php echo $_SESSION['valid_user_id'];?>
">个人主页</a></li>					<li><a id="nav-newgoal" href="GoalC.php?act=new">新建</a></li>				</ul>								<div id="account-info">					<a href="../ctrl/AccountC.php?act=details"><?php echo $_SESSION['valid_user'];?>
的账号</a>					<a href="../ctrl/PublicC.php?act=logout">退出</a>				</div>			</div>		</div>		<div id="content-wap" class="container"><?php }} ?>
<?php /* Smarty version Smarty-3.1.12, created on 2012-12-15 03:22:56
         compiled from "F:\xampp\htdocs\Goal\view\header.tc" */ ?>
<?php /*%%SmartyHeaderCode:2024550ae471893ba43-50524726%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a600b38685ef190d79f1a2e2b1c9c81babad4cb3' => 
    array (
      0 => 'F:\\xampp\\htdocs\\Goal\\view\\header.tc',
      1 => 1355538127,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2024550ae471893ba43-50524726',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50ae4718ae8331_23065208',
  'variables' => 
  array (
    'title' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50ae4718ae8331_23065208')) {function content_50ae4718ae8331_23065208($_smarty_tpl) {?><!DOCTYPE html><html>	<head>		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>		<link rel="stylesheet" href="../style/jquery-ui-1.8.22.custom.css" />		<link rel="stylesheet" href="../style/style.css" />		<script type="text/javascript" src="../js/jquery-1.7.2.min.js"></script>		<script type="text/javascript" src="../js/jquery-ui-1.8.22.custom.min.js"></script>		<script type="text/javascript" src="../js/jquery.ui.datepicker-zh-CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine-zh_CN.js"></script>		<script type="text/javascript" src="../js/jquery.validationEngine.js"></script>		<link rel="stylesheet" href="../style/validationEngine.jquery.css" type="text/css"/>		<script type="text/javascript" src="../js/goal-feedback.js"></script>	</head>	<body id="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
">			<div id="feedback-panel">			<div id="feedback-tag"></div>			<form action="PublicC.php" method="post" id="form-feedback">				<input id="feedback-subject" name="feedbackSubject" placeholder="主题（可不填）" autocomplete="off" type="text" />				<textarea id="feedback-content" class="validate[required]" name="feedbackContent" rows="10" placeholder="建议内容"></textarea>				<input class="btn btn-primary" type="submit" value="发送" />				<input type="hidden" name="act" value="send_feedback" />			</form>		</div>		<div id="header">			<div class="container">				<ul id="nav">					<li><a href="PersonC.php?act=person"><span id="logo" class="btn-icon"></span>我想</a></li>					<li><a href="DiscoverC.php?act=discover">发现</a></li>					<li><a href="GoalC.php?act=new">新</a></li>				</ul>								<div id="account-info">					<a href="../ctrl/AccountC.php?act=details"><?php echo $_SESSION['valid_user'];?>
</a>					<a href="../ctrl/PublicC.php?act=logout">登出</a>				</div>			</div>		</div>		<div id="content-wap" class="container"><?php }} ?>
<?php /* Smarty version Smarty-3.1.12, created on 2012-11-01 08:32:50
         compiled from "F:\xampp\htdocs\Dream\view\header.tc" */ ?>
<?php /*%%SmartyHeaderCode:2827450922054d52815-44349291%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '29a6c5bdae96137dc78ca0b07fcd500d81ee6909' => 
    array (
      0 => 'F:\\xampp\\htdocs\\Dream\\view\\header.tc',
      1 => 1351755096,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2827450922054d52815-44349291',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_50922054e1f6b3_37516539',
  'variables' => 
  array (
    'title' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_50922054e1f6b3_37516539')) {function content_50922054e1f6b3_37516539($_smarty_tpl) {?><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'>	<head>		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>		<link rel='stylesheet' href='../style/jquery-ui-1.8.22.custom.css' />		<link rel='stylesheet' href='../style/style.css' />		<script type='text/javascript' src='../js/jquery-1.7.2.min.js'></script>		<script type='text/javascript' src='../js/jquery-ui-1.8.22.custom.min.js'></script>		<script type='text/javascript' src='../js/jquery.ui.datepicker-zh-CN.js'></script>		<script type='text/javascript' src='../js/jquery.validationEngine-zh_CN.js'></script>		<script type='text/javascript' src='../js/jquery.validationEngine.js'></script>		<link rel='stylesheet' href='../style/validationEngine.jquery.css' type='text/css'/>		<script type='text/javascript' src='../js/goal-feedback.js'></script>	</head>	<body id="<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
">			<div id='feedback-panel'>			<div id='feedback-tag'></div>			<form action='PublicC.php' method='post' id='form-feedback'>				<input id='feedback-subject' name='feedbackSubject' placeholder='主题（可不填）' autocomplete='off' type='text' />				<textarea id='feedback-content' class='validate[required]' name='feedbackContent' rows='10' placeholder='建议内容'></textarea>				<input id='submit-feedback' type='submit' value='发送' />				<input type='hidden' name='act' value='send_feedback' />			</form>		</div>		<div id='header'>			<div id='header-wap'>				<a id='logo-link' href='HomeC.php?act=home'></a>							<ul id='nav' class='clearfix'>					<li><a id='nav-discover' href='../ctrl/HomeC.php?act=home'>首页</a></li>					<li><a id='nav-goals' href='../ctrl/GoalC.php?act=my_goals'>我的Goals</a></li>					<li><a id='nav-dynamic' href='../ctrl/DynC.php?act=dyns'>动态</a></li>					<li><a id='nav-person' href='../ctrl/PersonC.php?act=person&userID=<?php echo $_SESSION['valid_user_id'];?>
'>个人主页</a></li>					<li><a id='nav-newgoal' href='../ctrl/GoalC.php?act=new'>新建</a></li>				</ul>								<div id='account-info'>					<span><a href='../ctrl/AccountC.php?act=details'><?php echo $_SESSION['valid_user'];?>
的账号</a></span>					<span><a href='../ctrl/PublicC.php?act=logout'>退出</a></span>				</div>			</div>		</div>		<div id='content-wap' class='clearfix'><?php }} ?>
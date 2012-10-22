<?php /* Smarty version Smarty-3.1.12, created on 2012-10-22 21:56:14
         compiled from "F:\xampp\htdocs\Dream\view\header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2611650835626866f60-12818942%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'a2e79ac05be85d1dbdaff7606962cdeaf6c74b0f' => 
    array (
      0 => 'F:\\xampp\\htdocs\\Dream\\view\\header.tpl',
      1 => 1350906751,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2611650835626866f60-12818942',
  'function' => 
  array (
  ),
  'version' => 'Smarty-3.1.12',
  'unifunc' => 'content_5083562686a9a3_31675913',
  'variables' => 
  array (
    'title' => 0,
    'page' => 0,
  ),
  'has_nocache_code' => false,
),false); /*/%%SmartyHeaderCode%%*/?>
<?php if ($_valid && !is_callable('content_5083562686a9a3_31675913')) {function content_5083562686a9a3_31675913($_smarty_tpl) {?><<?php ?>?php	//用户资格检测	session_start();		if(!is_auth()){		if(isset($_COOKIE['ua']) && isset($_COOKIE['ue'])){			$email = base64_decode($_COOKIE['ue']);			$_SESSION['valid_user'] = get_username_by_email($email);			$_SESSION['valid_user_id'] = get_userid_by_email($email);		}		else{			page_jump('account_page_login.php');		}	}?<?php ?>><!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'>	<head>		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />		<title><?php echo $_smarty_tpl->tpl_vars['title']->value;?>
</title>		<link rel='stylesheet' href='../style/jquery-ui-1.8.22.custom.css' />		<link rel='stylesheet' href='../style/style.css' />		<script type='text/javascript' src='../js/jquery-1.7.2.min.js'></script>		<script type='text/javascript' src='../js/jquery-ui-1.8.22.custom.min.js'></script>		<script type='text/javascript' src='../js/jquery.ui.datepicker-zh-CN.js'></script>		<script type='text/javascript' src='../js/jquery.validationEngine-zh_CN.js'></script>		<script type='text/javascript' src='../js/jquery.validationEngine.js'></script>		<link rel='stylesheet' href='../style/validationEngine.jquery.css' type='text/css'/>		<script type='text/javascript' src='../js/goal-feedback.js'></script>	</head>	<body id='<?php echo $_smarty_tpl->tpl_vars['page']->value;?>
'>					<div id='feedback-panel'>			<div id='feedback-tag'></div>				<form action='feedback_proc.php'method='post' id='form-feedback'>					<input id='feedback-subject' name='feedbackSubject' placeholder='主题（可不填）' autocomplete='off' type='text' />					<textarea id='feedback-content' class='validate[required]' name='feedbackContent' rows='10' placeholder='建议内容'></textarea>					<input id='submit-feedback' type='submit' value='发送'>				</form>			</div>								<div id='header'>				<div id='header-wap'>					<a id='logo-link' href='HomeC.php?act=home'></a>								<ul id='nav' class='clearfix'>						<li><a id='nav-goals' href='../ctrl/HomeC.php?act=home'>我的Goals</a></li>						<li><a id='nav-dynamic' href='../ctrl/DynC.php?act=followeeDyns'>动态</a></li>						<li><a id='nav-person' href='../ctrl/PersonC.php'>个人主页</a></li>						<li><a id='nav-newgoal' href='../ctrl/GoalC.php?act=new'>新建</a></li>						<li><a id='nav-discover' href='../ctrl/GoalC.php?act=discover'>发现</a></li>					</ul>									<div id='account-info'>						<span><a href='../controller/AccountC.php?act=details'>hustlzp的账号</a></span>						<span><a href='../controller/AccountC.php?act=logout'>退出</a></span>					</div>				</div>			</div>			<div id='content-wap' class='clearfix'><?php }} ?>
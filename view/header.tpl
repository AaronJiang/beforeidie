<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'><html xmlns='http://www.w3.org/1999/xhtml'>	<head>		<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />		<title>{$title}</title>		<link rel='stylesheet' href='../style/jquery-ui-1.8.22.custom.css' />		<link rel='stylesheet' href='../style/style.css' />		<script type='text/javascript' src='../js/jquery-1.7.2.min.js'></script>		<script type='text/javascript' src='../js/jquery-ui-1.8.22.custom.min.js'></script>		<script type='text/javascript' src='../js/jquery.ui.datepicker-zh-CN.js'></script>		<script type='text/javascript' src='../js/jquery.validationEngine-zh_CN.js'></script>		<script type='text/javascript' src='../js/jquery.validationEngine.js'></script>		<link rel='stylesheet' href='../style/validationEngine.jquery.css' type='text/css'/>		<script type='text/javascript' src='../js/goal-feedback.js'></script>	</head>	<body id="{$page}">			<div id='feedback-panel'>			<div id='feedback-tag'></div>			<form action='PublicC.php' method='post' id='form-feedback'>				<input id='feedback-subject' name='feedbackSubject' placeholder='主题（可不填）' autocomplete='off' type='text' />				<textarea id='feedback-content' class='validate[required]' name='feedbackContent' rows='10' placeholder='建议内容'></textarea>				<input id='submit-feedback' type='submit' value='发送' />				<input type='hidden' name='act' value='send_feedback' />			</form>		</div>		<div id='header'>			<div id='header-wap'>				<a id='logo-link' href='HomeC.php?act=home'></a>							<ul id='nav' class='clearfix'>					<li><a id='nav-goals' href='../ctrl/HomeC.php?act=home'>我的Goals</a></li>					<li><a id='nav-dynamic' href='../ctrl/DynC.php?act=dyns'>动态</a></li>					<li><a id='nav-person' href='../ctrl/PersonC.php?act=person&userID={$smarty.session.valid_user_id}'>个人主页</a></li>					<li><a id='nav-newgoal' href='../ctrl/GoalC.php?act=new'>新建</a></li>					<li><a id='nav-discover' href='../ctrl/DiscoverC.php?act=discover'>发现</a></li>				</ul>								<div id='account-info'>					<span><a href='../ctrl/AccountC.php?act=details'>{$smarty.session.valid_user}的账号</a></span>					<span><a href='../ctrl/PublicC.php?act=logout'>退出</a></span>				</div>			</div>		</div>		<div id='content-wap' class='clearfix'>
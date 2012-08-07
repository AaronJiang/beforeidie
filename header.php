<?php session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Goal</title>
		<link rel="stylesheet" href="style/jquery-ui-1.8.22.custom.css" />		
		<link rel="stylesheet" href="style/style.css" />
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="js/jquery.validate-1.9.min.js"></script>
		<script type="text/javascript" src="js/jquery-ui-1.8.22.custom.min.js"></script>
		<script type="text/javascript" src="js/jquery.ui.datepicker-zh-CN.js"></script>
	</head>

	<body>
		<div id="header">
			<a id="logo-link" href="home.php"></a>
			
			<ul id="nav" class="clearfix">
				<li><a id="nav-goals" href="home.php">我的梦想</a></li>
				<li><a id="nav-dynamic" href="dynamic.php">动态</a></li>
				<li><a id="nav-newgoal" href="goal_page_new.php">新建</a></li>
				<li><a id="nav-discover" href="discover.php">发现</a></li>
			</ul>
			<div id="account-info">
			<?php if(isset($_SESSION['valid_user'])){ ?>		
				<span><a href='account_page_details.php'><?php echo $_SESSION['valid_user']; ?>的账号</a><span>
				<span><a href='account_proc.php?proc=logout'>退出</a></span>			
			<?php } else { ?>
				<span><a href='account_page_login.php'>登陆</a><span>
				<span><a href='account_page_register.php'>注册</a></span>
			<?php } ?>
			</div>	
		</div>
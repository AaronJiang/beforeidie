<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title><?= $pageTitle ?></title>
		<script type="text/javascript" src="<?= base_url('static/js/jquery-1.7.2.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('static/js/jquery-ui-1.8.22.custom.min.js') ?>"></script>
		<script type="text/javascript" src="<?= base_url('static/js/goal-feedback.js') ?>"></script>
		<link rel="stylesheet" href="<?= base_url('static/style/style.css') ?>" />
	</head>

	<body id="<?= $pageID ?>">

		<?php if(isset($_SESSION['valid_user_id'])): ?>
		<div id="feedback-panel">
			<div id="feedback-tag"></div>
			<?= form_open('common/send_feedback', array('id' => 'form-feedback')) ?>
				<textarea id="feedback-content" name="feedbackContent" rows="10" placeholder="您的意见"></textarea>
				<input class="btn btn-primary" type="submit" value="发送" />
			</form>
		</div>
		<?php endif; ?>

		<div id="header">
			
			<div class="container">
				
				<ul id="nav">
					<li><span id="logo" class="btn-icon"></span></li>

					<?php if(isset($_SESSION['valid_user_id'])): ?>
					<li><a href="<?= base_url('person') ?>">首页</a></li>
					<li><a href="<?= base_url('like') ?>">收藏</a></li>
					<?php endif; ?>

					<li><a href="<?= base_url('discover') ?>">浏览</a></li>

					<?php if(isset($_SESSION['valid_user_id'])): ?>
					<li><a href="<?= base_url('goal/add') ?>">添加</a></li>
					<?php else: ?>
					<li><a href="<?= base_url('about') ?>">关于</a></li>
					<?php endif; ?>
				</ul>
				
				<div id="account-info">
					<?php if(isset($_SESSION['valid_user_id'])): ?>
					<a href="<?= base_url('account/info') ?>"><?= $_SESSION['valid_user'] ?></a>
					<a href="<?= base_url('common/logout') ?>">登出</a>
					<?php else: ?>
					<a href="<?= base_url('account/login') ?>">登陆</a>
					<a href="<?= base_url('account/register') ?>">注册</a>
					<?php endif; ?>
				</div>
			</div>
		</div>

		<div id="content-wap" class="container">

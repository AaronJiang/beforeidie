<?php
	include_once('model/data_funs.inc');
	
	//输出未认证时的 HTML 头
	function html_output_unauthed_header($title, $bodyID){
		echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>"
			. "<html xmlns='http://www.w3.org/1999/xhtml'>"
			. "<head>"
				. "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />"
				. "<title>". $title. "</title>"
				. "<link rel='stylesheet' href='style/jquery-ui-1.8.22.custom.css' />"	
				. "<link rel='stylesheet' href='style/style.css' />"
				/*. "<script type='text/javascript' src='js/less-1.3.0.min.js'></script>"*/
				. "<script type='text/javascript' src='js/jquery-1.7.2.min.js'></script>"
				. "<script type='text/javascript' src='js/jquery-ui-1.8.22.custom.min.js'></script>"
				. "<script type='text/javascript' src='js/jquery.ui.datepicker-zh-CN.js'></script>"
				. "<script type='text/javascript' src='js/jquery.validationEngine-zh_CN.js'></script>"
				. "<script type='text/javascript' src='js/jquery.validationEngine.js'></script>"
				. "<link rel='stylesheet' href='style/validationEngine.jquery.css' type='text/css'/>"
			. "</head>"
			
			. "<body id=". $bodyID. ">";
			
			//浏览器检测
			if(check_browser() == 'IE'){
				html_output_browser_warning();
			}
	}
	
	//输出未认证时的 HTML 尾
	function html_output_unauthed_footer(){
		echo "</body>"
			. "</html>";
	}

	//输出浏览器警告信息
	function html_output_browser_warning(){
		echo "<div id='browser-warning'>"
				. "<img src='imgs/confuse.png' />"
				. "<p>纳尼？亲，你还在使用 IE（或基于 IE 内核）的浏览器啊？那我可不能放你进去！</p>"
				. "<p>你可以：下载地球最好的浏览器 - <a target='_blank' href='http://www.google.cn/intl/zh-CN/chrome/browser/'>Chrome</a>，你会很快爱上它的极速与清爽！</p>"
				. "<p>或者：下载全中国最好的浏览器 - <a target='_blank' href='http://ie.sogou.com/'>搜狗浏览器</a>，并默认启用高速模式！</p>"
			. "</div>";
	}
	
	//输出认证后的 HTML 头
	function html_output_authed_header($title, $bodyID){
	
		//用户资格检测
		session_start();
	
		if(!is_auth()){
			if(isset($_COOKIE['ua']) && isset($_COOKIE['ue'])){
				$email = base64_decode($_COOKIE['ue']);
				$_SESSION['valid_user'] = get_username_by_email($email);
				$_SESSION['valid_user_id'] = get_userid_by_email($email);
			}
			else{
				page_jump('account_page_login.php');
			}
		}

		echo "<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>"
			. "<html xmlns='http://www.w3.org/1999/xhtml'>"
				. "<head>"
					/*
					. "<meta http-equiv='Pragma' content='no-cache'>"
					. "<meta http-equiv= 'Expires' content='0'>"
					. "<meta http-equiv='Cache-Control' content='no-cache, no-store, must-revalidate'>"
					. "<meta http-equiv='expires' CONTENT='Wed, 26 Feb 1997 08:21:57 GMT'>"
					*/
					. "<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />"
					. "<title>". $title. "</title>"
					. "<link rel='stylesheet' href='style/jquery-ui-1.8.22.custom.css' />"	
					. "<link rel='stylesheet' href='style/style.css' />"
					/*. "<script type='text/javascript' src='js/less-1.3.0.min.js'></script>"*/
					. "<script type='text/javascript' src='js/jquery-1.7.2.min.js'></script>"
					. "<script type='text/javascript' src='js/jquery-ui-1.8.22.custom.min.js'></script>"
					. "<script type='text/javascript' src='js/jquery.ui.datepicker-zh-CN.js'></script>"
					. "<script type='text/javascript' src='js/jquery.validationEngine-zh_CN.js'></script>"
					. "<script type='text/javascript' src='js/jquery.validationEngine.js'></script>"
					. "<link rel='stylesheet' href='style/validationEngine.jquery.css' type='text/css'/>"
					. "<script type='text/javascript' src='js/goal-feedback.js'></script>"
				. "</head>"
				
				. "<body id=". $bodyID. ">";
				
					//浏览器检测
					if(check_browser() == 'IE'){
						html_output_browser_warning();
					}
					
					//反馈框
					echo "<div id='feedback-panel'>"
						. "<div id='feedback-tag'></div>"
						. "<form action='feedback_proc.php'method='post' id='form-feedback'>"
							. "<input id='feedback-subject' name='feedbackSubject' placeholder='主题（可不填）' autocomplete='off' type='text' />"
							. "<textarea id='feedback-content' class='validate[required]' name='feedbackContent' rows='10' placeholder='意见内容'></textarea>"
							. "<input id='submit-feedback' type='submit' value='发送'>"
						. "</form>"
					. "</div>"
					
					. "<div id='header'>"
						. "<div id='header-wap'>"
							. "<a id='logo-link' href='home.php'></a>"
			
							. "<ul id='nav' class='clearfix'>"
								. "<li><a id='nav-goals' href='home.php'>我的Goals</a></li>"
								. "<li><a id='nav-dynamic' href='dynamic_page_followees.php'>动态</a></li>"
								. "<li><a id='nav-person' href='person.php?userID=". $_SESSION['valid_user_id']. "'>个人主页</a></li>"		
								. "<li><a id='nav-newgoal' href='goal_page_new.php'>新建</a></li>"
								. "<li><a id='nav-discover' href='discover.php'>发现</a></li>"
							. "</ul>"
				
							. "<div id='account-info'>"
								. "<span><a href='account_page_details.php'>". $_SESSION['valid_user']. "的账号</a></span>"
								. "<span><a href='account_proc.php?proc=logout'>退出</a></span>"
							. "</div>"
						. "</div>"
					. "</div>"

					. "<div id='content-wap' class='clearfix'>";
	}
	
	//输出认证后的 HTML 尾
	function html_output_authed_footer(){
		echo "</div>"	
			. "<div id='footer'>"
				. "<a href='about.php'>Goal是什么</a>"
				. "<a href='terms.php'>条款与隐私</a>"
				. "<span>©2012 hustlzp.com, all rights reserved.</p>"
			. "</div>"
		. "</body>"
		. "</html>";
	}

	//输出登陆页面的标语
	function html_output_slogan(){
		echo "<p id='login-slogan'>"
				. "<span>已经有 <b>". get_all_users_num() ."</b> 位用户，</span>"
				. "<span>在 <img id='logo' src='imgs/new.png' /> 设立了 <b>". get_all_goals_num() ."</b> 个目标，"
				. "</span><span>写下了 <b>". get_all_logs_num() ."</b> 条记录</span>"
			. "<p>";	
	}
?>
<?php
	require_once('smtp.php');
	
	//将数组进行 URL 编码
	function urlencodeAry($data){
		if(is_array($data)){
			foreach($data as $key => $val){
				$data[$key] = urlencodeAry($val);
			}
			return $data;
		} else {
			return urlencode($data);
		}
	}
	
	//连接数据库
	function db_conn(){

		$db = new mysqli('localhost', 'hustlzp', 'xiaowangzi', 'goal');
		//$db = new mysqli('Mysql1001.webweb.com', '98db92_w301_1', 'xiaowangzi', 'db_98db92_w301_1');

		if(mysqli_connect_errno()){
			echo 'Error: Could not connect to the database!';
			exit;
		}
		
		return $db;
	}
	
	//执行 SQL 语句
	function db_exec($query){
		$db = db_conn();
		$db->query("SET NAMES 'UTF8'");
		return $db->query($query);
	}
	
	//返回当前时间
	function now_time(){
		date_default_timezone_set('Asia/Shanghai');
		return date('Y-m-d H:i:s');	
	}
	
	//返回当前日期
	function now_date(){
		date_default_timezone_set('Asia/Shanghai');
		return date('Y-m-d');		
	}
	
	//页面跳转
	function page_jump($url){		
		header('Location:'. $url);
		exit;
	}

	//返回上一页
	function page_jump_back(){
		/*
		header('Expires: Thu, 01 Jan 1970 00:00:01 GMT');  
		header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');  
		header('Cache-Control: no-cache, must-revalidate, max-age=0');  
		header('Pragma: no-cache');
		*/
		header('Location:'. $_SERVER['HTTP_REFERER']);
		exit;
	}

	//发送邮件
	function send_email($smtpemailto, $mailsubject, $mailbody){
		//邮件配置参数
		
		
		$smtpserver = "smtp.qq.com";
		$smtpserverport = 25;
		$smtpusermail = "hustlzp@qq.com";
		$smtpuser = "hustlzp@qq.com";
		$smtppass = "xiaowangzi";
		$mailtype = "HTML";
			
		//发送邮件
		$smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
		$smtp->debug = FALSE;
		$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);	
	}
	
	//检测浏览器
	function get_browser_type(){
		$agent = $_SERVER["HTTP_USER_AGENT"];
		
		if(strpos($agent, "MSIE"))
			$browser = "IE";
		else if(strpos($agent,"Firefox"))
			$browser = "Firefox";
		else if(strpos($agent,"Chrome"))
			$browser = "Chrome";
		else if(strpos($agent,"Safari"))
			$browser = "Safari";
		else if(strpos($agent,"Opera"))
			$browser = "Opera";
		else 
			$browser = $agent;
			
		return $browser;
	}

?>
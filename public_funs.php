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
	
		if(mysqli_connect_errno()){
			echo 'Error: Could not connect to the database!';
			exit;
		}
		
		return $db;
	}
	
	//执行 SQL 语句
	function db_exec($query){
		$db = db_conn();
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
	}

	//返回上一页
	function page_jump_back(){
		header('Location:'. $_SERVER['HTTP_REFERER']);	
	}
	
	
	//发送邮件
	function send_email($smtpemailto, $mailsubject, $mailbody){
		//邮件配置参数
		$smtpserver = "smtp.qq.com";
		$smtpserverport =25;
		$smtpusermail = "hustlzp@qq.com";
		$smtpuser = "hustlzp@qq.com";
		$smtppass = "xiaowangzi";
		$mailtype = "HTML";
			
		//发送邮件
		@$smtp = new smtp($smtpserver, $smtpserverport, true, $smtpuser, $smtppass);
		$smtp->debug = FALSE;
		@$smtp->sendmail($smtpemailto, $smtpusermail, $mailsubject, $mailbody, $mailtype);	
	}

?>
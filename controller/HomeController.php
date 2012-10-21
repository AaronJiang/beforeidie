<?php
	include_once('../smarty/libs/Smarty.class.php');
	include_once('../data_funs.inc');
	
	$smarty = new Smarty();

	$smarty->setTemplateDir('../view/home');
	$smarty->setCompileDir('../smarty/templates_c/');
	$smarty->setConfigDir('../smarty/configs/');
	$smarty->setCacheDir('../smarty/cache/');

	$action = $_REQUEST['action'];
	
	switch($action){
		case "home":
			session_start();
			$userID = $_SESSION['valid_user_id'];
			
			//自动启动 Goal
			autostart_goals($userID);
			
			$smarty->assign('goalNum', array('now'=>get_goals_num($userID, "now", true),
											'future'=>get_goals_num($userID, "future", true),
											'finish'=>get_goals_num($userID, "finish", true)
											));
											
			$goalType = isset($_REQUEST['goalType'])? $_REQUEST['goalType']: 'now';
			$smarty->assign('goalType', $goalType);
			$smarty->assign('goals', get_goals($userID, $goalType, true));
			
			$smarty->display('home.tpl');
			break;

		case "about":
			//$smarty->assign();
			$smarty->display('about.tpl');
			break;

		case "terms":
		$smarty->display('terms.tpl');
			break;
	}

?>
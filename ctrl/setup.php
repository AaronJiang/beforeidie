<?php

include_once('../smarty/libs/Smarty.class.php');
include_once('../model/data_funs.inc');
include_once('utility.php');

@session_start();

// 重定向函数
function redirect($ctrl, $act, $paras=array()){
	$url = $ctrl. "C.php?act=". $act;
	
	if(isset($paras)){
		foreach($paras as $key => $value){
			$url .= "&". $key. "=". $value;
		}
	}
	
	page_jump($url);
}

// 定制的 Smarty 子类
class sm extends Smarty {

   function __construct($view = "")
   {
        parent::__construct();

		$this->setTemplateDir('../view/'. $view);
		$this->setCompileDir('../smarty/templates_c/');
		$this->setConfigDir('../smarty/configs/');
		$this->setCacheDir('../smarty/cache/');
   }
}
?>
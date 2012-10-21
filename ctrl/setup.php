<?php

include_once('../smarty/libs/Smarty.class.php');
include_once('../data_funs.inc');

class sm extends Smarty {

   function __construct($view)
   {
        parent::__construct();

		$this->setTemplateDir('../view/'. $view);
		$this->setCompileDir('../smarty/templates_c/');
		$this->setConfigDir('../smarty/configs/');
		$this->setCacheDir('../smarty/cache/');
   }
}
?>
<?php

/**
* BaseController
*/

class BaseController{
	public $smarty;
	/*
	*	初始化模板引擎
	*	@see IController::view()
	*/
	public function view(){
		$this->smarty = new Smarty();
		$this->smarty->template_dir = __DIR__."/../views";
		$this->smarty->compile_dir = __DIR__."/../../template_c";
		$this->smarty->left_delimiter = "<%";
		$this->smarty->right_delimiter = "%>";
		
	}
	public function __construct(){

	}
}
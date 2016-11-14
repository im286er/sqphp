<?php

/**
*	HomeController
*/

class HomeController extends BaseController{

	public function home(){
		parent::view();//初始化smarty
		$this->smarty->assign('test','欢迎使用');
		$this->smarty->display('test.html');
	}
}
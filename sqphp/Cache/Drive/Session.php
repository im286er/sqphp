<?php
//+--------------------------------------------
//session类，支持原生session和redis的session
//+--------------------------------------------
class Session {
	static protected $session_prefix;
	static private $_instance;
	public function __construct(){
		
		$this->session_prefix=C('session_prefix');
	}
	static function getInstance(){
		if(!(self::$_instance instanceof self)){
			$config=C();
			if (array_key_exists("SESSION", $config)){
					//$this->session_drive=$config["SESSION"];
					$className="Session".ucfirst($config["SESSION"]);
					$file=__DIR__.'/'.$className.".php";
					if(is_file($file)){
						require_once "{$file}";
						$className::init();
					}else{
						throw  new Exception("{$file}"."文件不存在");
					}
			}else{
				session_start();
			}
			
			self::$_instance = new self();
		}
		return self::$_instance;
	}
	/**
	*	获取session
	*	@param string key
	*/
	public function get($key){
		$key = $this->session_prefix.$key;
		return $_SESSION[$key];
	}
	/**
	*	写入session
	*	@param string || int $key
	*	@param string $value
	*/
	public function set($key,$value){
		$key = $this->session_prefix.$key;
		$_SESSION[$key] = $value;
		
	}
	/**
	*	清除session
	*	@param string || org $key
	*/
	public function clear($key=null){
		if($key==null){
			session_destroy();
		}else{
			$key = $this->session_prefix.$key;
			unset($_SESSION[$key]);
		}
	}
}

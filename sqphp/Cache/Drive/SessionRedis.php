<?php
class SessionRedis{
	static private $handler = null;
	static private $lifetime = null;
	static private $time = null;
	static public function init(){
		if(!array_key_exists("session_lifetime",C())){
			self::$lifetime = ini_get('session.gc_maxlifetime');
		}
		self::$time = time();
		self::$handler = new Redis();
		$port = C('redis_port')?C('redis_port'):6379;
		self::$handler->connect(C('redis_host'),$port);
		if(!self::$handler){
			
		}else{
			
		}
		self::start();
	}
	static public function start(){
		session_set_save_handler(
			array(__CLASS__, 'open'),
			array(__CLASS__, 'close'),
			array(__CLASS__, 'read'),
			array(__CLASS__, 'write'),
			array(__CLASS__, 'destroy'),
			array(__CLASS__, 'gc')
		);
		register_shutdown_function('session_write_close');
		session_start();
	}
	
	/**
	*	��session
	*/
	static public function open($path,$name){
		return true;
	}
	/**
	*	�ر�session
	*/
	static public function close(){
		return true;
	}
	/**
	*	��ȡsession
	*
	*/
	static public function read($PHPSESSID){
		
		$res = self::$handler->get($PHPSESSID);
		if($res==false || $res == null){
			return '';
		}
		return $res;
	}
	/**
	*	д��session
	*	@param string || int $key
	*	@param string || int $data
	*/
	static public function write($PHPSESSID,$data){

		if(self::$handler->set($PHPSESSID,$data)){
			self::$handler->expire($PHPSESSID,C('session_lifetime'));
			return true;
		}
		return false;
	}
	/**
	*	ע��session
	*
	*/
	static public function destroy($PHPSESSID){
		return self::$handler->delete($PHPSESSID);
	}
	
	/**
	*	���
	*/
	static public function gc($lifetime){
		return true;
	} 
	public function __destruct(){
		session_write_close();
	}
}
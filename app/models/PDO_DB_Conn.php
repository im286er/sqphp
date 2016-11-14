<?php
//+--------------------
//|pdo 连接mysql数据库
//+--------------------

class PDO_DB_Conn{
	static private $_instance;
	static private $_PDOs;

	private function __construct(){

	}

	static public function getInstance(){
		if(!(self::$_instance instanceof self)){
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	public function connect(){
		if(!self::$_PDOs){
			$db_host = C("host");
			$db_name = C("database");
			
			self::$_PDOs = new PDO("mysql:host=$db_host;db_name=$db_name",C("user"),C('pwd'));
			if(!self::$_PDOs){
				throw new Exception("pdo connect fail");
			}
			self::$_PDOs->query("set names utf8");	
		}
		return self::$_PDOs;
	}


}
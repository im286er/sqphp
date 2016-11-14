<?php
	class Mysql_DB_Conn{
		static private $_instance;
		static private $_connectSource;

		private function __construct(){

		}

		static public function getInstance(){
			if(!(self::$_instance instanceof self)){
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		public function connect(){
			if(!self::$_connectSource){
				self::$_connectSource = @mysql_connect(C("host"), C("user"), C("pwd"));
			
				if(!self::$_connectSource){
					throw new Exception("mysql connect fail ".mysql_error());
				}
				mysql_select_db(C("database"), self::$_connectSource);
				mysql_query("set names UTF8", self::$_connectSource);
			}
			return self::$_connectSource;
		}

	}

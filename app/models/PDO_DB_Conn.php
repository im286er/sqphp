<?php
//+--------------------
//|pdo 连接mysql数据库
//+--------------------

class PDO_DB_Conn{
   static  public  $PDOs;
    
    /**
     * 返回数据连接对像
     *
     * @return PDO_Mysql
     */
	public function __construct(){
	   try {
		$db_host=C("host");		
		$db_name=C("database");		
		self::$PDOs=new PDO("mysql:host=$db_host;dbname=$db_name",C("user"),C("pwd"));  		
		self::$PDOs->query("set names utf8");				 
	   }catch (PDOException $e){ 					
		   print $e->getMessage();
	   }  	
    }
}

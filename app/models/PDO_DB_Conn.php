<?php
//+--------------------
//|pdo ����mysql���ݿ�
//+--------------------

class PDO_DB_Conn{
   static  public  $PDOs;
    
    /**
     * �����������Ӷ���
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

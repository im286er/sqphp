<?php
//+--------------
//实现model基类
//+--------------
class Model{
	public $sql;
	public $TableName;
	public $lastsql;
	public $error;
	protected $options = array();
	public function __call($method,$args){
		if(in_array(strtolower($method),array('field','limit','where','order','group','data'),true)){
			$this->options[strtolower($method)] = $args[0];
			return $this;
		}else{
			exit("当前模型不存在".$method."方法");
		}
		
	}
	public function __construct($tablename=''){
		if(empty($tablename)){
			$this->TableName = C("table_prefix").str_replace("Model","",get_called_class());
		}else{
			$this->TableName = C("table_prefix").$tablename;
		}
		//echo $this->TableName;
		new PDO_DB_Conn();
	}
	/**
	*	插入数据
	*	@see IModel::create()
	*/
	public function create(){
		$data = $this->options["data"];
		$field = null;
		$val = null;
		if($data){
			foreach($data as $key=>$value){
				if(is_string($value)){
					$value = mysql_escape_string($value);
					$value = "'$value'";
				}else{
					$value = intval($value);
				}
				$val.= $value.",";
				$field .="`".$key."`,";
			}
			$field = rtrim($field,",");
			$val = rtrim($val,",");
			$this->sql = "INSERT INTO ".$this->TableName." ($field)"." VALUES($val)";		
			
		}else{
			exit("empty data");
		}
		if($pdo = PDO_DB_Conn::$PDOs){
			$rs = $pdo->prepare($this->sql);
			return $rs->execute();
		}else{
			$this->error = $pdo->errorInfo();
			return false;
		}
	}
	
	/**
	*	更新数据
	*	@see IModel::update()
	*/
	public function update(){
		//$where = " where ".$this->options["where"];
		$where = " where account='666666'";
		$data = $this->options["data"];
		$field = null;
		if($data){
			foreach($data as $key=>$value){
				if(is_string($value)){
					$value = mysql_escape_string($value);
					$value = "'$value'";
				}else{
					$value = intval($value);
				}
				$field .=",`".$key."`=".$value;
			}
			$sets = trim($field,",");
			$sets = "SET ".$sets;
			$this->sql = "UPDATE ".$this->TableName." $sets"." $where ";		
			
		}else{
			exit("empty data");
		}
		if($pdo = PDO_DB_Conn::$PDOs){
			echo $this->sql;
			$rs = $pdo->prepare($this->sql);
			return $rs->execute();
		}else{
			$this->error = $pdo->errorInfo();
			return false;
		}
	}
	
	/**
	*	读取数据
	*	@see IModel::read()
	*/
	public function read(){
		if($pdo = PDO_DB_Conn::$PDOs){
			if(array_key_exists("where",$this->options)){
				$where = " WHERE ".$this->options["where"]." ";
			}else{
				$where = null;
			}
			if(array_key_exists("order",$this->options)){
				$order = " ORDER BY ".$this->options["order"]." ";
			}else{
				$order = null;
			}
			if(array_key_exists("limit",$this->options)){
				$limit = " LIMIT ".$this->options["limit"];
			}else{
				$limit = null;
			}
			if(array_key_exists("field",$this->options)){
				$field = $this->options["field"];
			}else{
				$field = "*";
			}
			if(array_key_exists("group",$this->options)){
				$group = " GROUP BY ".$this->options["group"]." ";
			}else{
				$group = null;
			}
			$this->sql = "SELECT ".$field." FROM ".$this->TableName.$where.$group.$order.$limit;
			echo $this->sql;
			$pdo->query("set names utf8");
			$rs = $pdo->prepare($this->sql);
			$rs->execute();
			$this->lastsql = $rs->queryString;
			return $rs->fetchAll();
		}else{
			return false;
		}
	}
	
	/**
	*	读取单条数据
	*	@see IModel::find()
	*/
	public function find(){
		if($pdo = PDO_DB_Conn::$PDOs){
			if(array_key_exists("where",$this->options)){
				$where = " WHERE ".$this->options["where"]." ";
			}else{
				$where = null;
			}
			if(array_key_exists("order",$this->options)){
				$order = " ORDER BY ".$this->options["order"]." ";
			}else{
				$order = null;
			}
			
			$limit = " LIMIT 0,1";
			
			if(array_key_exists("field",$this->options)){
				$field = $this->options["field"];
			}else{
				$field = "*";
			}
			if(array_key_exists("group",$this->options)){
				$group = " GROUP BY ".$this->options["group"]." ";
			}else{
				$group = null;
			}
			$this->sql = "SELECT ".$field." FROM ".$this->TableName.$where.$group.$order.$limit;
			//echo $this->sql;
			$pdo->query("set names utf8");
			$rs = $pdo->prepare($this->sql);
			$rs->execute();
			$rs->setFetchMode(PDO::FETCH_ASSOC);
			$this->lastsql = $rs->queryString;
			return $rs->fetch();
		}else{
			return false;
		}
	}
	
	/**
	*	统计总记录数量
	*	@return number
	*/
	public function sum(){
		if($pdo = PDO_DB_Conn::$PDOs){
			if(array_key_exists("where",$this->options)){
				$where = " WHERE ".$this->options["where"];
			}else{
				$where = null;
			}
			
			$this->sql = "SELECT count(*) FROM ".$this->TableName.$where;
			//echo $this->sql;
			$pdo->query("set names utf8");
			$rs = $pdo->query($this->sql);
			$Rowcount = $rs->fetch();
			$count = $Rowcount[0];
			$this->lastsql = $rs->queryString;
			return $count;
		}else{
			return false;
		}
	}
	
	/**
	*	删除数据
	*	
	*/
	public function delete(){
		if ($pdo=PDO_DB_Conn::$PDOs) {
    	  if (array_key_exists("where", $this->options)){    	  	   	  		   
   	  	       $where=" WHERE ".$this->options["where"];
   	  	       $this->sql="DELETE FROM {$this->TableName} ".$where;
    	   }else{
    	   		$this->error="where条件不能为空";
    	   		return false;
    	   }	    	   	    	
   	       $rs=$pdo->prepare($this->sql);
   	       $this->lastSql=$rs->queryString;
   	  	   return $rs->execute();   
   	    	
   	    }else {
   	    	return false;
   	    }
	}
}
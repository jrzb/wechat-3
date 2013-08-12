<?php

class Database {
	public $host=SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT;
	public $name=SAE_MYSQL_USER;
	public $password=SAE_MYSQL_PASS;
	public $db=SAE_MYSQL_DB;
    
	public function dql($sql){
		$mysql=new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,$this->name,$this->password,$this->db);
		$mysql->query("set names utf8");	
		$res=$mysql->query($sql);
		return $res;
	}
	
	public function dml($sql)
	{   
		$mysql=new mysqli(SAE_MYSQL_HOST_M.':'.SAE_MYSQL_PORT,$this->name,$this->password,$this->db);
		$mysql->query("set names utf8");	
		$mysql->query($sql);
		
	}
}
?>
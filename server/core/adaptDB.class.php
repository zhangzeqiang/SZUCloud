<?php

class AdaptDB {

	private $mysql;
	function __construct($charset="ANSI"){
		//使用sae接口连接到数据库
		define ("DB_TYPE", "sae_db");
		
		if (DB_TYPE === "sae_db"){
			require_once("DB/sae_db.class.php");
			$this->mysql = new SaeDB($charset);
		}
	}
	/**
	 * @return:成功返回数组，失败时返回false
	 */
	public function select($sql){
		return $this->mysql->select($sql);
	}
	/**
	 * @return:运行Sql语句，不返回结果集
	 */
	public function exec($sql){
		$this->mysql->exec($sql);
	}
	function __destruct(){
	}
	public function getHandler(){
		return $this->mysql->getHandler();
	}
}

?>
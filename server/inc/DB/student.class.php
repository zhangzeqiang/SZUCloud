<?php

class T_student extends DBModel{

	//表名
	private $table;
	
	//属性值
	private $id;
	private $name;
	private $major;
	private $sex;
	
	public function __construct(){
		parent::__construct();
		$this->table = "student";
		$this->id = "id";
		$this->name = "name";
		$this->major = "major";
		$this->sex = "sex";
	}
	public function getData(){
		return parent::getData($this->table);
	}
	public function getNameWithStuNo($num){
		$sql = "select %s from %s where %s='%s'";
		$sql = sprintf($sql,$this->name,$this->table,$this->id,$num);
		return parent::select($sql);
	}
	public function __destruct(){
	}
}

?>
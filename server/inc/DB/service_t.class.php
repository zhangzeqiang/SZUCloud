<?php
class T_service extends DBModel{

	//表名
	private $table;
	
	//属性值
	private $id;
	private $title;
	private $img_url;
	private $url;
	
	public function __construct(){
		parent::__construct();
		$this->table = "service";
		$this->id = "id";
		$this->title = "title";
		$this->img_url = "img_url";
		$this->url = "url";
	}
	public function getData(){
		return parent::getData($this->table);
	}
	public function deleteRecordWithTitle($title){
		$sql = "delete from %s where %s='%s'";
		$sql = sprintf($sql, $this->table, $this->title, $title);
		parent::exec($sql);
	}public function insert($title, $img_url, $url){
		$id = parent::getDirectId($this->table);		//获取连续有序id
		$sql = "insert into %s(%s,%s,%s,%s) values(%s,'%s','%s','%s')";
		$sql = sprintf($sql, $this->table, $this->id, $this->title, $this->img_url, $this->url,
						$id, $title, $img_url, $url);
		parent::exec($sql);
	}
	public function deleteRecordWithId($id){
		$sql = "delete from %s where %s=%s";
		$sql = sprintf($sql, $this->table, $this->id, $id);
		parent::exec($sql);
	}
	public function getRecordWithId($id){
		$sql = "select*from %s where %s=%s";
		$sql = sprintf($sql, $this->table, $this->id, $id);
		return parent::select($sql);
	}
	public function __destruct(){
	}
}

?>
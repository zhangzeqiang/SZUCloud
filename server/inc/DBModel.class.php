<?php
	require_once("../core/adaptDB.class.php");
	class DBModel extends AdaptDB{
		
		public function __construct(){
			parent::__construct();
		}
		/*
		 * 获取最小Id，保证id连续有序
		 * 获取失败则返回false
		 */
		public function getDirectId($table, $attr="id"){
			$sql = "select %s from %s order by %s";
			$sql = sprintf($sql, $attr, $table, $attr);
			
			$arr = parent::select($sql);
			$i =  0;
			if (!is_array($arr)){
				return $i;
			}
			foreach($arr as $value_arr){
				if ($i != $value_arr[$attr]){
					return $i;
				}
				$i++;
			}
			return $i;
		}
		public function getData($table){
			$sql = "select * from %s";
			$sql = sprintf($sql, $table);
			$arr = parent::select($sql);
			return $arr;
		}
	}
	//add DB里需要用到的功能文件
	require_once("DB/service_t.class.php");
	require_once("DB/article_t.class.php");
	require_once("DB/join_stu_lesson.class.php");
	require_once("DB/student.class.php");
?>
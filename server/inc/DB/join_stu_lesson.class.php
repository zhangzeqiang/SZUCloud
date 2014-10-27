<?php

class T_Join_Stu_Lesson extends DBModel{

	//表名
	private $t_lesson;
	private $t_stu_tea_lesson;
	private $t_room_time_lesson;
	
	public function __construct(){
		parent::__construct();
		$this->t_lesson = "lesson";
		$this->t_stu_tea_lesson = "stu_tea_lesson";
		$this->t_room_time_lesson = "room_time_lesson";
	}
	public function getData(){
		return parent::getData($this->table);
	}
	public function getLessonDetailWithStuNo($studentNo){
		//$ret_arr([0](name,room_time(room_time0,room_time1)))为要返回的数组
		//获取课程id
		$sql = "select lesson_id from ".$this->t_stu_tea_lesson." where student_no=".$studentNo;
		$arr_lessonNo = parent::select($sql);
		//根据课程id获取room_time和课程名
		if (is_array($arr_lessonNo)){
			$i = 0;
			foreach($arr_lessonNo as $lesson_values){
				
				$lesson_id = $lesson_values["lesson_id"];
				//获取课程名
				$sql = "select name from ".$this->t_lesson." where id = ".$lesson_id;
				$temp_arr = parent::select($sql);
				$lesson_name = $temp_arr[0]["name"];
				$ret_arr[$i]["name"] = $lesson_name;
				//获取room_time
				$sql = "select room,time from ".$this->t_room_time_lesson." where lesson_id=".$lesson_id;
				$temp_arr = parent::select($sql);
				$r_i = 0;
				if (is_array($temp_arr)){
					foreach($temp_arr as $r_values){
						
						$ret_arr[$i]["room_time"][$r_i]["time"] = $r_values["time"];
						$ret_arr[$i]["room_time"][$r_i]["room"] = $r_values["room"];
						$r_i++;
					}
					
				}
				$i++;
			}
		}
		return $ret_arr;
	}
	public function __destruct(){
	}
}

?>
<?php
defined ("API_PATH") or exit();

class Api_SZU_Lesson extends JsonBuilder{

	private $code;		//标志码
	
	public function __construct(){
		parent::__construct();
		define ("EPARAM", -1);
		define ("NRECORD", 1001);
	}
    public function addData(){
		
		define(STUNO, "studentNo");
        define(STUNAME, "studentName");
		
		if (isset($_GET[STUNO])){
			
			if (isset($_GET[STUNAME])){
				//验证成功
				$num = $_GET[STUNO];
				$name = $_GET[STUNAME];
				if (self::check($num,$name)){
					$this->data["studentNo"] = $num;
					$this->data["studentName"] = $name;
					self::getLesson($num,$name);
				}else{
					$this->code = NRECORD;
				}

			}else{
				$this->code = EPARAM;
			}
		}else{
			$this->code = EPARAM;
		}
		return ;
    
    }
	public function buildJson($attr = array()){
	
		$this->makeBody();
		if ($this->code == EPARAM){
			$this->addHeader(__EPARAM__, "param invalid");
		}else if ($this->code == NRECORD){
			$this->addHeader(__OK__, "No Record");
		}else{
			$this->addHeader(__OK__, "success");
		}
        return $this->toJson();
    }
	protected function check($num, $name){
		$T_student = new T_student();
		$arr = $T_student->getNameWithStuNo($num);
		if (is_array($arr)){
			if ($arr[0]["name"] == $name){
				return true;
			}
		}
		return false;
	}
	protected function getLesson($num){

		$lesson = "lesson";
		$T_Join_stu_lesson = new T_Join_Stu_Lesson();
		//验证名字和姓名

		$this->data[$lesson] = $T_Join_stu_lesson->getLessonDetailWithStuNo($num);

	}
}
?>
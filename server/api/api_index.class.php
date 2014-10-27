<?php
defined ("API_PATH") or exit();

class Api_index extends JsonBuilder{

	private $code;		//标志码
	private $obj;

	public function __construct(){
		parent::__construct();
		define ("EPARAM", -1);
	}
    public function addData(){
		
		define(RANGE, "range");
        
        $s_banner = "banner";
        
		if (isset($_GET[RANGE])){
			 
            /*$this->data[$s_bhttp://www.baidu.com/img/bdlogo.pnganner][0]["img_url"] = "";
            $this->data[$s_banner][0]["title"] = "百度一下";
            $this->data[$s_banner][0]["url"] = "http://www.baidu.com";*/
            
			if ($_GET[RANGE] == "all"){
                
				$this->getAllService();
				return ;
			}
		}
		$this->code = EPARAM;
		return ;
    
    }
	public function buildJson($attr = array()){
	
		/*$this->makeBody();
		if ($this->code == EPARAM){
			$this->addHeader(__EPARAM__, "param invalid");
		}else if ($this->code == NRECORD){
			$this->addHeader(__OK__, "No Record");
		}else{
			$this->addHeader(__OK__, "success");
		}*/
		self::addData();
        return json_encode($this->obj);
    }
	protected function getAllService(){
		
		$T_service = new T_service();
		//显示已经上传的记录列表
		$arr = $T_service->getData();
		$i = 0;
		if (is_array($arr)){
			foreach ($arr as $value_arr){
				$title = $value_arr["title"];
				$img_url = $value_arr["img_url"];
				$url = $value_arr["url"];
				$ser_id = $value_arr["id"];
				/*$s_index = "service";
				$this->data[$s_index][$i]["img_url"] = $img_url;
				$this->data[$s_index][$i]["title"] = $title;
				$this->data[$s_index][$i]["url"] = $url;
				$this->data[$s_index][$i]["id"] = $ser_id;*/

				$this->obj->data[$i]->img = $img_url;
				$this->obj->data[$i]->name = $title;
				$this->obj->data[$i]->isNative = "true";
				$this->obj->data[$i]->href = $url;
				//$this->obj->data[$i]->id = $ser_id;
				$this->obj->data[$i]->isAdd = "true";
				/*$this->data[$i][img] = $img_url;
				$this->data[$i][name] = $title;
				$this->data[$i][isNative] = "true";
				$this->data[$i][href] = $url;
				//$this->data[$i][id] = $ser_id;
				$this->data[$i][isAdd] = "true";*/
				$i++;
			}
		}else{
			$this->code = NRECORD;
		}
	}
}
?>
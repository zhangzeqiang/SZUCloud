<?php
defined ("API_PATH") or exit();

class Api_Article extends JsonBuilder{

	private $code;		//标志码
	
    private $service_id;
    private $a_begin;
    private $a_count;
    
    private $T_article;
    
	public function __construct(){
		parent::__construct();
		define ("EPARAM", -1);
        $this->T_article = new T_article();
	}
    public function addData(){
		
		define(RANGE, "range");
        
        $s_banner = "banner";
        
		if (isset($_GET[RANGE])){
			
            /*$this->data[$s_banner][0]["img_url"] = "http://www.baidu.com/img/bdlogo.png";
            $this->data[$s_banner][0]["title"] = "百度一下";
            $this->data[$s_banner][0]["url"] = "http://www.baidu.com";*/
            
			if ($_GET[RANGE] == "all"){
               
				$this->getAllArticle();
				return ;
			}
            else if (self::resolveRange($_GET[RANGE])){
            	
                $this->getArtWithSIdAndCount($this->service_id, $this->a_begin, $this->a_count);
                return ;
            }
		}
		$this->code = EPARAM;
		return ;
    
    }
    private function resolveRange($arr){
    	
        $curtain = "-";
        $temp = explode($curtain, $arr);
        for ($i=0;$i<3;$i++){
        	
            if (!is_numeric($temp[$i])){
            	return 0;
            }
        }
        $this->service_id = $temp[0];		//所属服务类id
        $this->a_begin = $temp[1];		//第一个记录开始id
        $this->a_count = $temp[2];			//要获取的记录数
        
        return 1;
        
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
    protected function getArtWithSIdAndCount($service_id, $begin, $count){
    	
        $sql = "select * from article where service_id=".$service_id." order by id limit ".$begin.",".$count;
        $arr = $this->T_article->select($sql);
        
        $this->translateArticleArr($arr);
    }
    protected function getAllArticle(){
    	
        $arr = $this->T_article->getData();
        
        $this->translateArticleArr($arr);
    }
    private function translateArticleArr($arr){
    	$i = 0;
		if (is_array($arr)){
			foreach ($arr as $value_arr){
				$title = $value_arr["title"];
				$img_url = $value_arr["img_url"];
				$url = $value_arr["url"];
				$other = $value_arr["other"];
				/*$s_index = "article";
				$this->data[$s_index][$i]["img_url"] = $img_url;
				$this->data[$s_index][$i]["title"] = $title;
				$this->data[$s_index][$i]["url"] = $url;
				$this->data[$s_index][$i]["other"] = $other;*/
				$this->data[$i]["img_url"] = $img_url;
				$this->data[$i]["title"] = $title;
				$this->data[$i]["url"] = $url;
				$this->data[$i]["other"] = $other;
				$i++;
			}
		}else{
			$this->code = NRECORD;
		}
    }
}
?>
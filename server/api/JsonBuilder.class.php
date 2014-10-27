<?php
defined ("API_PATH") or exit();

define ("__FORBIDDEN__", 403);
define ("__NOFOUND__", 404);
define ("__OK__", 200);	//瀹㈡埛绔姹傛垚鍔?
define ("__ERROR__", 500);

define ("__EPARAM__", 210);	//浼犻€佽繃鏉ョ殑GET鍙傛暟鏃犳晥

abstract class JsonBuilder{
    
    protected $arr;
    
    protected $code_s;
    protected $msg_s;
    protected $data_s;
    
    protected $data;

    public function __construct(){
    	$this->code_s = code;
        $this->msg_s = msg;
        $this->data_s = data;
    }
    public function __destruct(){}
    
    protected function addHeader($code, $msg){
    	/*$this->arr[$this->code_s] = $code;
        $this->arr[$this->msg_s] = $msg;*/
    }
	protected function makeBody(){
		$this->addData();
		$this->arr[$this->data_s] = $this->data;
	}
    protected function url_encode($str){
        
        if(is_array($str)) {  
            foreach($str as $key=>$value) {  
                $str[urlencode($key)] = self::url_encode($value);  
            }  
        }else {  
            $str = urlencode($str);  
        }
        return $str;
    }
    protected function toJson(){ 
        $result = urldecode(json_encode(self::url_encode($this->arr)));
		$result = str_replace("{", "{", $result);
		return str_replace("}", "}", $result);	//zeqiang 2014/10/25 '['=>'{'
	}
	protected function toJsonNoCode(){
	
		return json_encode($this->arr);
	}
    abstract public function addData();
	abstract public function buildJson($attr = array());
}
?>
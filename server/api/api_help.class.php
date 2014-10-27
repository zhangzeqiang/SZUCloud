<?php
defined ("API_PATH") or exit();

class Api_help extends JsonBuilder{

    public function addData(){
		define ("HELP_DOC", "http://1.dbapi.sinaapp.com/doc/");
    	$this->data["description"] = "Help document linker";
        $this->data["link"] = HELP_DOC;
    }
	public function buildJson($attr = array()){
	
		$this->addHeader(__OK__, "Help Document");
		$this->makeBody();
		
        return $this->toJson();
    }
}
?>
<?php
defined ("API_PATH") or exit();

class ErrType extends JsonBuilder{

    public function addData(){
		
        $this->data["description"] = "Unknown Type";
    }
	public function buildJson($attr = array()){
	
		$this->addHeader(__ERROR__, "No Found!");
		$this->makeBody();
		
        return $this->toJson();
    }
}
?>
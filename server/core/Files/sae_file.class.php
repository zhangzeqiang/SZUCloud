<?php
/*
 * 功能:sae 文件操作
 */

define ("__FILE_INF__", "file.inf.php");
require_once(__FILE_INF__);

class SaeFile implements file_func{

    private $handle;
    private $attr;
    private $domain;
    
    public function __construct($domain="test"){
    	$this->handle = new SaeStorage();
    	$this->attr = array('encoding'=>'gzip');
        $this->domain = $domain;
    }
    
    public function moveFile($srcFileName, $destFileName){
    	
        $result = $this->handle->upload($this->domain, $destFileName, $srcFileName/*, -1, $this->attr, true*/);
    	return $result;
    }
	public function getUrl($file_name=null){
	
		return ($file_name==null)?null:$this->handle->getUrl($this->domain, $file_name);
	}
	public function setFileAttr($filename, $public=false){
	
		$private = $public?false:true;
		$attr = array('expires' => '1 y', 'private' => $private);
		return $this->handle->setFileAttr ($this->domain, $filename, $attr);		//设置文件属性
	}
	public function getFileAttr($filename){
	
		return $this->handle->getAttr ($this->domain, $filename);
	}
	public function isFileExits($filename){
		
		return $this->handle->fileExists($this->domain, $filename);
	}
	public function deleteFile($filename){
		return $this->handle->delete($this->domain, $filename);
	}
}
?>
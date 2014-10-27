<?php
/*
 * 文件适配接口类
 */
class AdaptFile{
	
    public $handle;
    
    public function __construct(){
    	
        define ("STORAGE_TYPE", "sae_storage");
        
        if (STORAGE_TYPE === "sae_storage"){
        	require_once("Files/sae_file.class.php");
            $this->handle = new SaeFile("test");
        }
    }
    public function moveFile($srcFileName, $destFileName){
    
    	$result = $this->handle->moveFile($srcFileName, $destFileName);
        return $result;
    }
    public function getUrl($file_name=null){
	
		return ($file_name==null)?null:$this->handle->getUrl($file_name);
	}
	public function setFileAttr($filename, $public=false){
	
		return $this->handle->setFileAttr($filename, $public);
	}
	public function getFileAttr($filename){
		
		return $this->handle->getFileAttr ($filename);
	}
	public function isFileExits($filename){
		
		return $this->handle->isFileExits($filename);
	}
	public function deleteFile($filename){
	
		return $this->handle->deleteFile($filename);
	}
}

?>
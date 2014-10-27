<?php

interface file_func{
	
    public function moveFile($srcFileName, $destFileName);
    public function getUrl($file_name=null);
	public function setFileAttr($filename, $public=false);
	public function getFileAttr($filename);
	public function isFileExits($filename);
	public function deleteFile($filename);
	
}

?>
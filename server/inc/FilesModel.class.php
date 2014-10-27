<?php
	require_once("../core/adaptFile.class.php");
	class FilesModel extends AdaptFile{
		public function __construct(){
			parent::__construct();
		}
	}
	
	//add Files里需要用到的功能文件
	require_once("Files/uploadAction.class.php");
	
?>
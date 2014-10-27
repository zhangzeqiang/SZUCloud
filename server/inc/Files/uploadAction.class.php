<?php
/*
 * 上传函数操作类
 */
	class UploadAction{
		
		//标准
		protected $limitType;
		protected $limitSize;
		
		//上传的文件属性
		protected $u_type;
		protected $u_size;
		protected $u_error;
		protected $u_name;
		protected $u_tmp_name;
		
		//目的目录
		protected $destDir;
		
		//句柄
		protected $hfile;
		
        protected $i;
		protected function __construct(){
			$this->limitType = array(
			"jpg" 	=> "image/jpg",
			"jpeg" 	=> "image/jpeg",
			"ico" 	=> "image/x-icon",
			"png" 	=> "image/png",
			"gif"	=> "image/gif",
			"text" 	=> "text/plain",
 			);
			$this->limitSize = 20000;
			$this->destDir = "img/";
			//if ($this->isUploadAction()){
				$this->u_type = $_FILES["file"]["type"];
				$this->u_size = $_FILES["file"]["size"];
				$this->u_name = $_FILES["file"]["name"];
				$this->u_error = $_FILES["file"]["error"];
				$this->u_tmp_name = $_FILES["file"]["tmp_name"];
				$this->hfile = new FilesModel();
            $this->i = 0;
			/*}else {
				$this->u_type = null;
				$this->u_size = 0;
				$this->u_name = null;
				$this->u_error = null;
				$this->u_tmp_name = null;
				$this->hfile = null;
			}*/
		}
		public function setLimitSize($size){
			$this->limitSize = $size;
		}
		public function setDestDir($destDir = "default/"){
			$this->destDir = $destDir;
		}
		public function isUploadAction(){
			return isset($_FILES["file"]);
		}
		public function getUrl($filename=null){
			if ($filename === null)
			{
				$filename = $this->u_name;
			}
			$file_addr = $this->destDir.$filename;
			if ($this->hfile->isFileExits($file_addr)){
				return $this->hfile->getUrl($file_addr);
			}
			return null;
		}
		public function isTypeSuit(){
			if ($this->hfile === null){return false;}
			foreach ($this->limitType as $type){
				if ($this->u_type === $type){
					return true;
				}
			}
			return false;
		}
		public function isSizeSuit(){
			if ($this->hfile === null){return false;}
			return ($this->limitSize > $this->u_size)?true:false;
		}
		public function getLimitSize(){
			if ($this->hfile === null){	return false;}
			return $this->limitSize;
		}
		public function getUploadType(){
			if ($this->hfile === null){return false;}
			return $this->u_type;
		}
		public function getUploadSize(){
			if ($this->hfile === null){return false;}
			return $this->u_size;
		}
		public function isFileExits($filename){
			if ($this->hfile === null){return false;}
			
			return $this->hfile->isFileExits($this->destDir.$filename);
		}
        public function move(){
            
            $limit_num = 50;
            if (false === $this->moveAs()){
                //保证文件名不重复,若文件已存在，则在第一个.前缀加1
                $this->i = $this->i+1;
                if ($this->i > $limit_num){		//最多只能有50个重复项
                    return false;   
                }
                $temp = explode(".", $this->u_name);
                $temp[0] = $temp[0].$this->i;
                for ($i=0;$i<(count($temp)-1);$i++){
                    $filename=$filename.".".$temp[$i];
                }
                $this->u_name = $filename;
                //再次移动文件
                if (false === $this->move()){
                    return false;
                }
            }
        }
		public function moveAs($filename=null, $public=true){
			if ($this->hfile === null){	return false;	}
			if ($filename === null){
				$filename = $this->u_name;
			}
			if ($this->isFileExits($filename)){
				return false;
			}
			$this->hfile->moveFile($this->u_tmp_name, $this->destDir.$filename);
			$this->hfile->setFileAttr($this->destDir.$filename, true);
			return true;
		}
		public function getHandler(){
			return $this->hfile;
		}
		public function deleteFile($filename){
			return $this->hfile->deleteFile($filename);
		}
		public function run(){
			$this->test();
		}
		protected function test(){
			echo "Upload Action Test Done<br>";
		}
	}
?>
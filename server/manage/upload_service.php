<?php session_start();	
	if ((!isset ($_SESSION["LOGIN_PHP"])) || $_SESSION["LOGIN_PHP"]!==true){
		header("Location:login.php");
	}
	define ("MAN_INC_PATH", "../inc/");
	require_once(MAN_INC_PATH."FilesModel.class.php");
	require_once(MAN_INC_PATH."DBModel.class.php");
	
	class myUpload extends UploadAction{
		public function __construct(){
			parent::__construct();
		}
		public function run(){
			if (!$this->isUploadAction()){	return false;	}
			if ($this->isTypeSuit()){
				if ($this->isSizeSuit()){
					if (false === $this->move()){
						echo "<br>文件重复项已达到最大限制请修改文件名<br>";
						return false;
					}
				}else {
					echo "<br>限制文件大小为:".$this->getLimitSize()."<br>";
					return false;
				}
			}else {
				echo "<br>请选择图片类型"."<br>";
				return false;
			}
			return true;
		}
	}
	function check($title, $url){
		if ($url == "" || $title == ""){
			return false;
		}else {
			return true;
		}
	}
	
	$T_service = new T_service();
	$myUpload = new myUpload();
	$T_article = new T_article();
	
	if (isset ($_GET["type"])){
		$type = $_GET["type"];
		if ($type == "del"){
			$id = $_GET["id"];
			$_arr = $T_service->getRecordWithId($id);
			if (is_array($_arr)){
				foreach($_arr as $values){
					$img_url = $values["img_url"];
					$arr_imgInfo = explode("img/", $img_url);
					$_filename = "img/".$arr_imgInfo[count($arr_imgInfo)-1];
					if ($myUpload->deleteFile($_filename)){	//删除存储
						//删除文件
						$ser_arr = $T_article->select("select img_url from article where service_id=".$id);
						if (is_array($ser_arr)){
							foreach($ser_arr as $ser_values){
								$ser_img_url = $ser_values["img_url"];
								$ser_arr_imgInfo = explode("article_img/", $ser_img_url);
								$ser_filename = "article_img/".$ser_arr_imgInfo[count($ser_arr_imgInfo)-1];
								if ($myUpload->deleteFile($ser_filename)){
								}else{
									echo "<script>alert('批量删除".$id."下记录出现异常');</script>";
								}
							}
						}
						$T_article->deleteRecordsWithServiceId($id);//删除栏目下所有图文记录
						$T_service->deleteRecordWithId($id);	//删除记录
						echo "<script>alert('成功删除".$id."');</script>";
					}else{
						echo "<script>alert('删除".$id."失败');</script>";
					}
				}
			}
			
		}
	}
?>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
        <style type='text/css'>
            .hidden{ display:none;}
            .pic_upload{ }
            .pic_upload .file{position:absolute;width:71px; }
            .pic_upload .sblock{position:relative;left:78px;width:150px;}
            .pic_upload .url{position:absolute;width:150px;}
            .pic_upload .name{positon:relative;left:300px;width:150px;}
            .pic_upload .submit{position:relative;}
            .shine:hover{ border:1px solid blue; }
			.left_float{<!--float:left;-->height:100px;width:105px;}
			.service{border:1px solid #CDC5BF;float:left;width:100px;height:80px;margin-left:5px;margin-bottom:5px;}
        </style>
		<link href="style/index.css" rel="stylesheet" type="text/css" />
        <script>
            function getFile(){
            	var result = document.getElementById("file").value;
                document.getElementById("sblock").value=result;
            }
			var flag=false;
			function DrawImage(ImgD){
				var image=new Image();
				image.src=ImgD.src;
				if(image.width>0 && image.height>0){
					flag=true;
					if(image.width>50){
					}else{
						ImgD.width=image.width;
						ImgD.height=image.height;
					}
				}
			}
        </script>
    </head>
	<body>
<?
	//处理上传的事件
	if (isset($_FILES["file"])){
	
		$title = $_POST["title"];
		$url = $_POST["url"];
		$script = "<script>alert('%s');</script>";
		if (check($title, $url)){
			//上传
			$myUpload->setLimitSize(80000);
			if ($myUpload->run()){
				$img_url = $myUpload->getUrl();
				//插入数据库
				$T_service->insert($title, $img_url, $url);
				$msg = "上传成功";
			}else {
				$msg = "文件已存在或出现其他错误";
			}
		}else{
			$msg = "请确认title,url正确输入";
		}
		$script = sprintf($script, $msg);
		//弹出提示框
		echo $script;
	}
	
echo "<div id='form'>";

//输出栏目编辑
echo "<fieldset>
  <legend>栏目添加:</legend>
  <form class='pic_upload' action='upload_service.php' method='post' enctype='multipart/form-data'>
  	<input class='file' id='file' name='file' value='选择图标' type='file' onChange='getFile();'>
    <input class='sblock' id='sblock' name='file' type='text'><br>
	img_url:<input type='text' readonly='readonly' value=".$img_url.">
	url:<input type='text' name='url'>
	名称:<input type='text' name='title'>
    <input class='submit' type='submit' value='提交'>
  </form></fieldset>";
  
//显示已经上传的记录列表
	$arr = $T_service->getData();
	if (is_array($arr)){
		echo "<fieldset>";
		echo "<legend>编辑已有栏目:</legend>";
		foreach ($arr as $value_arr){
			echo "<div class='service'>";
			$des = "<div class='left_float'><a href='%s'>
			<img class='shine' border=0 src='%s' title='%s' onload='javascript:DrawImage(this);' width='50' /></a>";
			$title = $value_arr["title"];
			$img_url = $value_arr["img_url"];
			$url = $value_arr["url"];
			$id = $value_arr["id"];
			$des = sprintf($des, $url, $img_url, $title);
			echo $des;
			echo "<a href='upload_service.php?type=del&id=".$id."'>删除</a>";
			echo "</div></div>";
		}
		echo "</fieldset>";
	}


echo "</div>";
?> 
 
    </body>    
</html>
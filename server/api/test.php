<?php
	require_once("../inc/DBModel.class.php");
	/*$T_service = new T_service();
	//显示已经上传的记录列表
	$arr = $T_service->getData();*/	//1、这两句导致了无法显示
									//2、注意越域问题
	$temp->img = "images/common/icon/icon1.jpg";
	$temp->name = "校园咨询";
	$temp->isNative = "false";
	$temp->href = "http://www.baidu.com";
	$temp->isAdd = "true";
	$obj->data[0] = $temp;
	$obj->data[1] = $temp;
	echo json_encode($obj);
	/*$i = 0;
	if (is_array($arr)){
		foreach ($arr as $value_arr){
			$title = $value_arr["title"];
			$img_url = $value_arr["img_url"];
			$url = $value_arr["url"];
			$ser_id = $value_arr["id"];
			$obj->data[$i]->img = "images/common/icon/icon1.jpg";
			$obj->data[$i]->name = $title;
			$obj->data[$i]->isNative = "true";
			$obj->data[$i]->href = $url;
			//$obj->data[$i]->id = $ser_id;
			$obj->data[$i]->isAdd = "true";
			$i++;
		}
	}
	echo json_encode($obj);*/
?>
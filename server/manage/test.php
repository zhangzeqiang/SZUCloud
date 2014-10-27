<?php
	define ("INC_PATH", "../inc/");
	require_once(INC_PATH."DBModel.class.php");

	$T_service = new T_service();
	$arr = $T_service->getData();
	if (!is_array($arr)){
		echo "不是数组";
		exit;
	}
	foreach($arr as $value_arr){
		foreach($value_arr as $value){
			echo $value."<br>";
		}
	}
	$T_service->insert("hello", "hello", "hello");
	echo "<br>".$T_service->getDirectId("service");
?>
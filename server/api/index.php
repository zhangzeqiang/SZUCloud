<?php
define ("API_PATH", __DIR__);

require_once("JsonBuilder.class.php");
require_once("../inc/DBModel.class.php");

define ("T_HELP", "help");
define ("T_INDEX", "index");
define ("T_ARTICLE", "article");
define ("T_TEST", "test");

//深大课表
define ("T_SZU_LESSON", "szu_lesson");

if (isset($_GET["type"])){
	$type = $_GET["type"];
}else{
	$type = T_HELP;
}
if ($type == T_HELP){
	/*require_once("api_help.class.php");
	$JsonBuilder = new Api_help();*/
	$help_url = "http://1.dbapi.sinaapp.com/doc/";
	header("location:".$help_url);	//跳转到帮助页面
}
else if ($type == T_INDEX){
	require_once("api_index.class.php");
	$JsonBuilder = new Api_index();
}
else if ($type == T_ARTICLE){
	require_once("api_article.class.php");
    $JsonBuilder = new Api_Article();
}
else if ($type == T_SZU_LESSON){
	require_once("api_szu_lesson.class.php");
	$JsonBuilder = new Api_SZU_Lesson();
}else if ($type == T_TEST){
	require_once("test.php");
	exit;
}else{
	require_once("api_nofound.class.php");
	$JsonBuilder = new ErrType();
}
$result =  $JsonBuilder->buildJson();
echo $result;


?>



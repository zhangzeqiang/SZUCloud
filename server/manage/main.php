<?php
	session_start();		//启动session
	if ((!isset ($_SESSION["LOGIN_PHP"])) || $_SESSION["LOGIN_PHP"]!==true){
		header("Location:login.php");
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理系统</title>
<script language="javascript" src="style/jquery.js"></script>
<link href="style/index.css" rel="stylesheet" type="text/css" />
</head>
<body>
<div id="mainDiv">
	<div id="topDiv">
	<div id="tmenu"><ul>
	<li ><a href="#">首页</a></li>
	<li ><a href="#">更多后台模板</a></li>
	<li ><a href="#">横向菜单</a></li>
	<li ><a href="#">横向菜单</a></li>
	<li ><a href="unlogin.php">退出</a></li>
	</ul></div></div>
	<div id="centerDiv">
	
	<div id="left">
	<div id="lhead">管理菜单</div>
	<ul>
	<li ><a href="upload_service.php" target="iframe">编辑栏目</a></li>
	<li ><a href="upload_article.php" target="iframe">编辑资讯</a></li>
	<li ><a href="#">菜单  3</a></li>
	<li ><a href="#">菜单  4</a></li>
	<li ><a href="#">菜单  5</a></li>
	<li ><a href="#">+添加</a></li>
	</ul>
	</div>
	<div id="right"> 
	<div id="current">&nbsp;&nbsp;&nbsp;&nbsp;当前位置:</div>
	<!--<div id="form">
		
		<fieldset>
			<legend>用户名与密码:</legend>
		
			<input id="hiddenField" name="hiddenField" type="hidden" value="hiddenvalue" />
			<label for="username">用户名:</label>
			
			<input type="text" id="username" name="username" value="dreamdu" />
			<label for="pass">密码:</label>
			<input type="password" id="pass" name="pass" />
		</fieldset>

	</div>-->
	<iframe name="iframe" id="iframe" src="upload_service.php" width="95%" height="97%" frameborder=0 />
	</div></div>
	<div id="bottomDiv"></div>
</div>
<script language="javascript">
$("#test1").toggle(function(){$("#test").slideDown()},function(){$("#test").slideUp()})
</script>
</body>
</html>
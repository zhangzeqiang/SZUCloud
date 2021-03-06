<!--------------------------------------------------------------------
--@Author:深圳大学荔园晨风2014技术组成员
--@Time:21/5/2014
--@版权所有
--@说明:使用此代码时请注明为深大荔园晨风技术组开发
-->
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
		<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
		<title>深大云课表</title>
        <style type='text/css'>
			body{background:#84C1FF;}
            div.layout{text-align:center;margin:auto auto auto auto;background:#84C1FF;}  
			input.align{text-align:center;width:300px;}  
			input.line{border:0;border-bottom:1 solid black;}
			div.top{margin-top:7px;margin-bottom:2px;}
		</style>
	</head>
	<body>
		<div class='layout'>
		<?php
		if (isset($_GET["action"])){
			$action = urldecode($_GET["action"]);					//$action发过来的值不能是中文，否则微信发过来的URL编码不能成功转化回来
			//echo "action".$action."<br>";
			//urldecode -- url解码函数
			//urlencode -- url编码函数
			if ($action == "show_lesson"){
				if (isset($_GET["student_no"])){
					require_once("function.php");
					require_once("../wechat/wechat_func.php");
					require_once("../wechat/interface.php");
					$student_no = $_GET["student_no"];

					$col_describe = array(
						0=>"深大云",1=>"周一",2=>"周二",3=>"周三",4=>"周四",5=>"周五"
					);
					$row_describe = array(
						0=>"深大云",1=>"1,2",2=>"3,4",3=>"5,6",4=>"7,8",5=>"9,10",6=>"11,12"
					);

					echo "<table width='100%' height='100%'>";

					for ($row=0;$row<7;$row++){
						echo "<tr>";
						for ($col=0;$col<6;$col++){
							$color = getColor();
							$color_mover = getColor();
							$attr = "<td bgcolor='%s' size='2' align='center' onmouseover='this.style.bgcolor='%s';this.style.size='2'' onmouseout='this.style.bgcolor='%s';this.style.size='2''>%s</td>";
							if ($row == 0){
								if ($col == 0){
									$tuser = getStudentName($student_no);			//获取学生姓名
									if (is_array($tuser)){
										foreach($tuser as $user_row){
											$user_name = $user_row['name'];
										}
									}else{
										$user_name = "未知";
									}
									$text = $user_name;
								}else{
									$text = $col_describe[$col];
								}
							}else{
								if ($col == 0){
									$text = $row_describe[$row];
								}else{
									$result = getRoomAndTimeWithStudentNO($student_no);
									if (is_array($result)){
										foreach($result as $my_row){
											$time = $my_row['time'];
											if (strpos($time, $col_describe[$col], 0) !== false && strpos($time, $row_describe[$row], 0) !== false){
												//处理教室和课程
												$text = $my_row['name']."\n".$my_row['room'];
												break;
											}else{
												$text = " ";
											}
										}
									}else{
										$text = " ";
									}
									
								}
							}
							$attr = sprintf($attr, $color, $color_mover, $color_mover, $text);
							echo $attr;
						}
						echo "</tr>";
					}
					echo "</table>";
				}
			}

		}

		?>
		</div>
	</body>
</html>
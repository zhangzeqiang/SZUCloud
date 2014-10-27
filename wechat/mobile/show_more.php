<!--------------------------------------------------------------------
--@Author:深圳大学荔园晨风2014技术组成员
--@Time:21/5/2014
--@版权所有
--@说明:使用此代码时请注明为深大荔园晨风技术组开发
-->
<!DOCTYPE HTML>
<html>
<head>
<meta charset="UTF-8"> 
<meta content="width=device-width,user-scalable=no" name="viewport"> 
<title>深大蹭客</title>
<link href="css/index.css" rel="stylesheet" type="text/css">
<link href="css/public.css" rel="stylesheet" type="text/css">
<script src="js/zepto.js" language="javascript" type="text/javascript" ></script>
<!--触摸屏效果滑动组件-->
<script type="text/javascript" src="./js/touch.js"></script>
<script type="text/javascript" src="./js/zepto.extend.js"></script>
<script type="text/javascript" src="./js/zepto.ui.js"></script>
<script type="text/javascript" src="./js/slider.js"></script>
<!--触摸屏效果滑动组件end-->
<style>
#main{
	width:100%;
}
.middle{
position:absolute;
display:block;
left:40%;
}
.all{
margin-left:10px;
margin-right:10px;
}
</style>
</head>


<body>
<header>
	<div class="logo fl"><img src="./images/home2.png"></div>
    <div class="middle">自己发起的活动</div>
	<div class="tool_btn fr">
        <a href="javascript:;" class="souban" id="soubanButton">导航</a>
    </div>
</header>
	<div style="display:none" class="hongye_style">
		<div class="course">
				<ul>
					<li><a href="">导航一</a></li>
					<li><a href="">导航二</a></li>
					<li><a href="">导航三</a></li>
					<li><a href="">导航四</a></li>
					<li><a href="">导航五</a></li>
					<li><a href="">导航六</a></li>
					<li><a href="">导航七</a></li>
					<li><a href="">导航八</a></li>
					<li><a href="">导航九</a></li>
					<li><a href="">导航十</a></li>
					<li><a href="">导航十一</a></li>
					<li><a href="">导航十二</a></li>


				</ul>
		</div>
	</div>
	<script>
		$("#soubanButton").click(function(){
				$(".hongye_style").toggle();
			})
	</script>

<script>
    //创建slider组件
    $('#fla').slider();
</script>
    <div class="clr"></div>
<div class="all">
	<hr style="border:dashed 1px #ffffff;height:6px;">
<?php
   require_once("../class/database.php");
    
	$sql="select subject,type,time,content,place,join_type,other from wechat_activity";

	$db=new saeDatabase();
	$result=$db->select($sql);
	$count=count($result)+0;

	
	for($i=0;$i<$count;$i++){
		$subject=mb_convert_encoding($result[$i]['subject'],"UTF-8","gbk");
		$type=mb_convert_encoding($result[$i]['type'],"UTF-8","gbk");
		$time=mb_convert_encoding($result[$i]['time'],"UTF-8","gbk");
		$content=mb_convert_encoding($result[$i]['content'],"UTF-8","gbk");
		$place=mb_convert_encoding($result[$i]['place'],"UTF-8","gbk");
		$join_type=mb_convert_encoding($result[$i]['join_type'],"UTF-8","gbk");
		$other=mb_convert_encoding($result[$i]['other'],"UTF-8","gbk");

?>
	<table border="0" style="width:100%;height:100%;background-color:#ECF5FF">		
		<tr valign="baseline"><td width="23%"><b>活动主题:</b></td><td><?php echo $subject; ?></td></tr>
		<tr valign="baseline"><td width="23%"><b>活动分类:</b></td><td><?php echo $type; ?></td></tr>
		<tr valign="baseline"><td width="23%"><b>活动时间:</b></td><td><?php echo $time; ?></td></tr>
		<tr valign="baseline"><td width="23%"><b>活动详情:</b></td><td><?php echo $content; ?></td></tr>
		<tr valign="baseline"><td width="23%"><b>活动地点:</b></td><td><?php echo $place; ?></td></tr>
		<tr valign="baseline"><td width="23%"><b>报名方式:</b></td><td><?php echo $join_type; ?></td></tr>
		<tr valign="baseline"><td width="23%"><b>其它:</b></td><td><?php echo $other; ?></td></tr>
	</table>
	<hr style="border:dashed 1px #ffffff;height:6px;">
	<?php	} ?>
</div>
</body>
<script>
	Zepto(function($){
		// 导航切换效果
		$("#CatNav a").click(function(){
			$("#CatNav a").removeClass('on');
			$(this).addClass('on');
			$(".CatNavList").css('display', 'none');
			$(".CatNavList" + $(this).index()).css('display', 'block');
		});

        $("#newsList").slider({
            autoPlay    : false, 
            showDot     : false,
			loop        : true,//是否循环
            slideend    : function(a, page){
                $("#CatNav a").removeClass('on');
                $("#CatNav a").eq(page).addClass('on');
            }
        });

	})
</script>
<link rel="stylesheet" type="text/css" href="css/slider.css" />
</html>

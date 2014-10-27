<!--------------------------------------------------------------------
--@Author:深圳大学荔园晨风2014技术组成员
--@Time:21/5/2014
--@版权所有
--@说明:使用此代码时请注明为深大荔园晨风技术组开发
-->
<?php
/*//////////////////////////////////////////////////////////////////
 * ---------------------  服务器URL -------------------------------
 *///////////////////////////////////////////////////////////////////
class URL{
	public static $LOCAL = "http://3.szunbbs.sinaapp.com";
}
/*///////////////////////////////////////////////////////////////////
 * -------------------------- END ----------------------------------
 *///////////////////////////////////////////////////////////////////

/*///////////////////////////////////////////////////////////////////
 * ------------------- TODO 字符交互界面定义 -------------------------
 *///////////////////////////////////////////////////////////////////
class WINDOWS{

	public static $type = array(

	/*activity_main
	another
	activity_register
	activity_show*/

	/*
	 * 深大云主页
	 */
	wechat_main => "
	深大云首页
	回复数字显示消息
	更多板块努力建设中
	【1】<a href='http://app.szucloud.cn/#/'>微官网</a>
	【2】<a href='http://app.szucloud.cn/#/article/enterprise'>励志创业</a>
	【3】查课表
	【4】天气资讯
	更多访问<a href='http://app.szucloud.cn/#/'>深大云</a>微官网",
	/*
	【3】<a href='http://app.szucloud.cn/#/article/info'>校园资讯</a>
	【4】<a href='http://app.szucloud.cn/#/article/fresh'>新生手册</a>
	【5】<a href='http://app.szucloud.cn/#/article/skill'>数码天地</a>
	【6】<a href='http://app.szucloud.cn/#/article/shop'>云商城</a>
	【9】快递查询
	*/
	/*
	 * 我的课程
	 */
	/*my_lesson => "
	<a href='%s/mobile/index.php?action=%s&student_no=%s'>点击</a>显示课程
	【1】返回云主页
	【2】根据课程名查看
	【3】根据时间查看
	输入其他显示课程主页",*/
	my_lesson => "
	<a href='%s/mobile/index.php?action=%s&student_no=%s'>点击此处显示课程</a>
	【1】返回云主页
	",
	lesson_check_with_name => "
	【格式】:微观经济学
	@输入课程名",


	lesson_check_with_time => "
	【格式】:单周一7,8,9
	@输入时间段",
	
	lesson_check_success => "
	@课程信息:
	【1】返回深大云
	【2】返回课程云主页",
	
	lesson_check_fail => "
	@不存在记录",
	
	/*
	 * 绑定学号
	 */
	bindToStudent => "
	@请输入学号",
	
	bindNameCheck => "
	@输入真实姓名进行验证",

	bindToStudentSuccess => "
	@验证成功",

	bindToStudentFail => "
	么哒,确定还有课
	么哒,确定没输错
	【1】返回深大云
	【2】重新输入
	",

	/*
	 * 天气
	 */
	weather_main=>"
	【1】返回深大云
	【2】本地天气
	【3】其他城市",

	weather_local=>"
	请发送你的定位地址（cenker不会以任何形式收集您的个人信息）",

	weather_other=>"
	请输入你要查询的城市名",

	weather_show=>"",//无需展示，发送图文信息即可

	weather_show_error=>"
	查询失败
	【1】返回深大云",

	/*
	 * 快递
	 */
	express_main=>"
	【1】返回深大云
	【2】快递单号(必填)",

	express_company=>"
	请输入快递公司名称",

	express_number=>"
	请输入快递单号",

	express_submit_success=>"
	%s",

	express_submit_fail=>"
	对不起，未查询到该单号",
	
	/*
	 * 校园资讯
	 */
	school_news => "
	<a href='http://app.szucloud.cn/#/article/info'>进入校园资讯</a>",
	
	/*
	 * 新生手册
	 */
	new_manual => "
	<a href='http://app.szucloud.cn/#/article/fresh'>进入新生手册</a>",
	
	 /*
	  * 数码天地
	  */
	digital_earth => "
	<a href='http://app.szucloud.cn/#/article/skill'>进入数码天地</a>",
	
	/*
	 * 励志创业
	 */
	encourage_work => "
	<a href='http://app.szucloud.cn/#/article/enterprise'>进入励志创业</a>",
	/*
	 * 云商城
	 */
	cloud_shop=> "
	<a href='http://app.szucloud.cn/#/article/shop'>进入云商城</a>",
	/*
	 * 其他信息
	 */
	develop => "
	@正在努力建设中
	敬请关注",
	
	no_define => "
	未定义,返回主界面",
	
	welcome => "欢迎订阅深大云",
	
	invalid => "不合法的输入",
	
	/*///////////////////
	 * NOTICE:
	 * 1、添加字符界面注意不要遗漏','
	 * 2、这里的other不要删除
	 *//////////////////
	other => " "
	);
}
/*//////////////////////////////////////////////////////////////////////
 *-------------------------- THE END -----------------------------------
 *///////////////////////////////////////////////////////////////////////

 
/*//////////////////////////////////////////////////////////////////////
 * --------------------- TODO 用户事件交互码定义 ----------------------------
 *//////////////////////////////////////////////////////////////////////
class CONSTANTS{
	
	public static $code_list = array (
	/*
	 * 原则:0表示主页.每种类型占10~20条交互码段
	 */
		/**
		 * 用户活动
		 * 范围:10 - 20
		 */
		10 => "activity_main",
		11 => "activity_show",
		12 => "activity_apply",
		13 => "activity_show_main",

		/*
		 * 学号绑定
		 */
		20 => "bindToStudent",
		21 => "bindNameCheck",
		22 => "bindToStudentSuccess",
		23 => "bindToStudentFail",
		
		/*
		 * 我的课程 
		 */
		30 => "my_lesson",
		31 => "lesson_check_with_name",
		32 => "lesson_check_with_time",
		33 => "lesson_check_success",
		34 => "lesson_check_fail",
		
		/*
		 *查看活动
		 */
		130 => "activity_douban",

		/*
		 * 开开房
		 */
		40=>"room_apply_main",

		41 => "room_apply_main_add",
		42 => "room_apply_send_QR_Code",
		43 => "room_apply_send_QR_Code_success",
		44 => "room_apply_send_QR_Code_fail",
		
		45 => "room_apply_main_show",
		
		46 => "room_apply_main_page",

		48 => "room_apply_main_delete_list",
		49 => "room_apply_main_delete",
		47 => "room_apply_main_delete_fail",
		/*
		 * 公文通
		 */
		 50=>"news_main",
			
		 /*
		 * 号码百事通
		 */
		60=>"telephone_main",
		61=>"telephone_ask",
		62=>"telephone_answer_success",
		63=>"telephone_answer_fail",
		
		/*
		 * 微社区
		 */
		64 => "wechat_zoon",
		/*
		 * 天气资讯
		 */
		70=>"weather_main",
		71=>"weather_local",
		72=>"weather_other",
		73=>"weather_show",
		74=>"weather_show_error",

		/*
		 * 快递查询
		 */
		80=>"express_main",
		81=>"express_company",
		82=>"express_number",
		83=>"express_submit_success",
		84=>"express_submit_fail",

		/*
		 * 周边生活
		 */
		90=>"localLife_main",
		91=>"localLife_eat",
		92=>"localLife_play",
		93=>"localLife_visit",
		94=>"localLife_live",
		95=>"localLife_transport",

		/*
		 * 添加活动
		 */
		120 => "activity_apply_main",
		121 => "activity_apply_subject",
		122 => "activity_apply_type",
		123 => "activity_apply_time",
		124 => "activity_apply_content",
		125 => "activity_apply_place",
		126 => "activity_apply_join_type",
		127 => "activity_apply_other",
		128 => "activity_apply_submit",
		129 => "activity_apply_fail",
		
		/*
		 * 校园资讯
		 */
		130 => "school_news",
		/*
		 * 新生手册
		 */
		140 => "new_manual",
		 /*
		  * 数码天地
		  */
		150 => "digital_earth",
		/*
		 * 励志创业
		 */
		160 => "encourage_work",
		/*
		 * 云商城
		 */
		170 => "cloud_shop",
		/*
		 * 其他信息界面定义
		 */
		900 => "develop",
		901 => "no_define",
		902 => "welcome",
		903 => "invalid",
		/*
		 * 深大云旧版本
		 */
		1000 => "cenker_old_version",
		/*
		 * 深大云
		 */
		0 => "wechat_main"

	);
}
/*//////////////////////////////////////////////////////////////////////
 * -------------------------- The End ----------------------------------
 *//////////////////////////////////////////////////////////////////////
?>
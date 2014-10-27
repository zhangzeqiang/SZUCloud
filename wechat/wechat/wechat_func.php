<!--------------------------------------------------------------------
--@Author:���ڴ�ѧ��԰����2014�������Ա
--@Time:21/5/2014
--@��Ȩ����
--@˵��:ʹ�ô˴���ʱ��ע��Ϊ�����԰���缼���鿪��
-->
<?php
require_once("../class/database.php");
require_once("interface.php");
function getStudentNoWithOpenId($openid){
	$db = new saeDatabase();

	$sql = "select student_no from wechat_user where openid = '$openid'";
	$result = $db->select($sql);

	//foreach($result as $row){
		return $result[0]['student_no'];
	//}
}
/*
 * �����û�id������������ʱ���н���һ����¼
 */
function setTempDataWithIndex($openid, $index, $data){
	//���֮ǰ��ʱ���Ѿ�����ʱ�����ˣ�����������ֱ�Ӹ������ݲ�����true,���֮ǰû���ݣ���ֱ�Ӳ��룬������false
	$sql = "select count(*) from temp_data where openid='%s' and myindex='%s'";
	$sql = sprintf($sql, $openid, $index);
	$db = new saeDatabase();
	
	$data = mb_convert_encoding($data, "gbk", "UTF-8");
	$result = $db->select($sql);
	
	if ($result[0]['count(*)']){
		//��ʱ�������Ѿ������ݣ���������
		$sql = "update temp_data set data='%s' where openid='%s' and myindex='%s'";
		$sql = sprintf($sql, $data, $openid, $index);
		$db->query($sql);
		return true;
	}else{
		//��ʱ������û�����ݣ�������¼
		$sql = "insert into temp_data(openid, myindex, data) values('%s','%s','%s')";
		$sql = sprintf($sql, $openid, $index, $data);
		$db->query($sql);
		return false;
	}
}
/*
 * �����û�id��������ȡ��ʱ���ж�Ӧ�ֶε�����
 */
function getTempDataWithIndex($openid, $index){
	
	$sql = "select count(*),data from temp_data where openid='%s' and myindex='%s'";
	$sql = sprintf($sql, $openid, $index);
	$db = new saeDatabase();

	$result = $db->select($sql);
	
	if (!$result[0]['count(*)']){
		//�����ʱ����û�����ݣ�����false
		return false;
	}else{
		//�����ʱ���������ݣ��򷵻�$data
		$data = mb_convert_encoding($result[0]['data'], "UTF-8", "gbk");
		return $data;
		//return $result[0]['data'];
	}

}
/*
 * ����ѧ�Ż�ȡѧ������
 */
function getNameWithStudentNo($student_no){
	$sql = "select count(*),name from student where id='%s'";
	$sql = sprintf($sql, $student_no);
	$db = new saeDatabase();

	$result = $db->select($sql);

	if (!$result[0]['count(*)']){
		//�����ʱ����û�����ݣ�����false
		return false;
	}else{
		//�����ʱ���������ݣ��򷵻�$data
		$data = mb_convert_encoding($result[0]['name'], "UTF-8", "gbk");
		return $data;
	}
}
/*
 * ��ȡ��ɾ����ʱ���ж�Ӧ�������û�id������
 */
function getAndDeleteTempWithIndex($openid, $index){
	//����getTempDataWithIndex֮���жϷ����Ƿ�Ϊfalse,���Ϊfalse�򷵻�false,�����ֵ��ɾ����¼������true
	$result = getTempDataWithIndex($openid, $index);
	$db = new saeDatabase();
	if ($result === false){					//ȫ���ڣ���������Ҳ���
		return false;
	}else{
		$sql = "delete from temp_data where openid='%s' and myindex ='%s'";
		$sql = sprintf($sql, $openid, $index);
		$db->query($sql);
		return $result;
	}
}
/*
 * ���ݴ����������ַ���������Ӧ��ʱ�������ݵ���֤�����������֤ͨ�������ݲ������ݿ⣬������true,
 * ��֤��ͨ���򷵻�false
 */
function activity_apply_submit_handle($openid, array $activity_apply_list){					
	$count = count($activity_apply_list);
	$db = new saeDatabase();
	for ($i=0;$i<$count;$i++){
		if ($activity_apply_list[$i] != "activity_apply_join_type" 
			&& $activity_apply_list[$i] != "activity_apply_other"){				//�����������ֶ���ȫ������Ϊ��
			$index = $activity_apply_list[$i];
			//����ʱ���ݱ��в鿴�����Ϊ���򷵻�false
			$data = getTempDataWithIndex($openid, $index);
			if ($data === false){
				return $i;						//���ص�һ���鵽�Ŀ��ֶ�������
			}
		}	
	}
	//���������ݴ������ݿ�
	if (($data = getTempDataWithIndex($openid,'activity_apply_subject')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$subject=$data;
	}
	if (($data = getTempDataWithIndex($openid,'activity_apply_type')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$type=$data;
	}
	if (($data = getTempDataWithIndex($openid,'activity_apply_time')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$time=$data;
	}
	if (($data = getTempDataWithIndex($openid,'activity_apply_content')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$content=$data;
	}
	if (($data = getTempDataWithIndex($openid,'activity_apply_place')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$place=$data;
	}
	if (($data = getTempDataWithIndex($openid,'activity_apply_join_type')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$join_type=$data;
	}
	if (($data = getTempDataWithIndex($openid,'activity_apply_other')) !== false){
		$data = mb_convert_encoding($data, "gbk", "UTF-8");
		$other=$data;
	}
	
	$sql = "insert into wechat_activity(subject,type,time,content,place,join_type,other,openid) 
			values('%s','%s','%s','%s','%s','%s','%s','%s')";
	$sql = sprintf($sql,$subject,$type,$time,$content,$place,$join_type,$other,$openid);
	$db->query($sql);
	
	//ɾ����ʱ������
	for ($i=0;$i<$count;$i++){
		
		$index = $activity_apply_list[$i];
		//����ʱ���ݱ��в鿴�����Ϊ���򷵻�false
		$data = getAndDeleteTempWithIndex($openid, $index);
	}
	return $count;							//��ʾ��������
}

function getActivityList(){
	$sql = "select subject,id from wechat_activity order by date desc";
	$db = new saeDatabase();
	$subject_list = $db->select($sql);
	$count = count($subject_list)+1;
	
	for($i=0;$i<$count;$i++){
		if ($i < 8){	//���ƾ������
			if ($i == 0){		//��һ���item
				$data = mb_convert_encoding("�����", "UTF-8", "gbk");
				$picText_list[$i]['Title'] = $data;
				$picText_list[$i]['PicUrl'] = URL::$LOCAL."/wechat/pic/activity_show.jpg";
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['Url'] = "";
			}else{
				$data = mb_convert_encoding($subject_list[$i-1]['subject'], "UTF-8", "gbk");
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['PicUrl'] = "";
				$picText_list[$i]['Title'] = $data;
				$action = 'show_activity';
				$action = urlencode($action);
				$picText_list[$i]['Url'] = URL::$LOCAL."/mobile/index.php?action=".$action."&id=".$subject_list[$i-1]['id'];
			}
			
		}else{
			break;
		}
	}
	$data = mb_convert_encoding("�鿴����", "UTF-8", "gbk");
	$picText_list[$i]['Title'] = $data;
	$picText_list[$i]['PicUrl'] = "";
	$picText_list[$i]['Description'] = "";
	$action = 'show_more_activity';
	$picText_list[$i]['Url'] = URL::$LOCAL."/mobile/index.php?action=".$action;
	return $picText_list;
}
/*
 *������ͼ����Ϣ--�����չʾ+�鿴����
 */
function getDoubanActivity(){
	$sql = "select subject,id from douban order by endtime desc";
	$db = new saeDatabase();
	$subject_list = $db->select($sql);
	$count = count($subject_list)+1;
	
	for($i=0;$i<$count;$i++){
		if ($i < 8){	//���ƾ������
			if ($i == 0){		//��һ���item
				$data = mb_convert_encoding("����", "UTF-8", "gbk");
				$picText_list[$i]['Title'] = $data;
				$picText_list[$i]['PicUrl'] = URL::$LOCAL."/wechat/pic/douban.png";
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['Url'] = "";
			}else{
				$data = mb_convert_encoding($subject_list[$i-1]['subject'], "UTF-8", "gbk");
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['PicUrl'] = "";
				$picText_list[$i]['Title'] = $data;
				$action = 'show_douban_activity';
				$action = urlencode($action);
				$picText_list[$i]['Url'] = URL::$LOCAL."/mobile/index.php?action=".$action."&id=".$subject_list[$i-1]['id'];
			}
			
		}else{
			break;
		}
	}
	$data = mb_convert_encoding("�鿴����", "UTF-8", "gbk");
	$picText_list[$i]['Title'] = $data;
	$picText_list[$i]['PicUrl'] = "";
	$picText_list[$i]['Description'] = "";
	$action = 'more_douban';
	$picText_list[$i]['Url'] = URL::$LOCAL."/mobile/index.php?action=".$action;
	return $picText_list;
}
/*
 * ��΢�Ŷ�ά��ת����url����
 */
function img_parse($img_url){

	$ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,"http://zxing.org/w/decode?u=".$img_url);//��������url��ַ 
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1); //�Ƿ���ʾ����
    $rule="%<pre[^>]*>(.*?)</pre>%si";
	$content=curl_exec($ch);
    preg_match($rule,$content,$rs);
	curl_close($ch);
	$res=strstr($rs[1],"http://weixin.qq.com/g/");
	if($res===false)
		return false;
	else
		return $rs[1];

}
/*
 * ���ݿγ�����ѯ
 */
function get_lesson_with_name($name){

		$name=mb_convert_encoding($name,"gbk","UTF-8");
		$sql="select room,time,name from room_time_lesson x,lesson y where x.lesson_id=y.id and y.name like'%".$name."%'";
//		$sql="select room,time from room_time_lesson where lesson_id in(select id from lesson where name like'%".$name."%')";
//		$sql=sprintf($sql,$name);


		$db = new saeDatabase();
		$result=$db->select($sql);

		$count=count($result)+0;
		//insert_wechat_user_instruct("count",$count);
		
		if($count>0){
			if($count<=10){
				for($i=0;$i<$count;$i++){
					$room=mb_convert_encoding($result[$i]['room'],"UTF-8","gbk");
				//	$time=mb_convert_encoding($result[$i]['time'],"UTF-8","gbk");
					$lname=$result[$i]['name'];
					$time=$result[$i]['time'];
					$content=$content."\n".$lname."\n".$room."  ".$time;	
				}
			}else{
				for($i=0;$i<10;$i++){
					$room=mb_convert_encoding($result[$i]['room'],"UTF-8","gbk");
				//	$time=mb_convert_encoding($result[$i]['time'],"UTF-8","gbk");
					$lname=$result[$i]['name'];
					$time=$result[$i]['time'];
					$content=$content."\n".$lname."\n".$room."  ".$time;	
				}
					$content=$content."
					"."<a href='".URL::$LOCAL."/mobile/index.php?action=%s&lesson_name=%s'>�鿴����</a>";
					$action="show_lesson_with_name";
					$action = urlencode($action);
					$lesson_name=$name;
					$lesson_name=mb_convert_encoding($lesson_name,"UTF-8","gbk");
					$lesson_name = urlencode($lesson_name);
					$content=sprintf($content,$action,$lesson_name);
			}
		}else{
			$content=false;
		}
		//echo $content;
		return $content;
}
/*
 * ����ʱ���ѯ
 */
function get_lesson_with_time($time){
		
		$time=mb_convert_encoding($time,"gbk","UTF-8");
		$time=str_replace("��",",",$time);
		//select name,room,time from room_time_lesson x,lesson y where time='��һ1,2' and x.lesson_id=y.id;

		$sql="select name,room,time from room_time_lesson x,lesson y where time='%s' and x.lesson_id=y.id";
		$sql=sprintf($sql,$time);
		$db = new saeDatabase();
		$result=$db->select($sql);
		$count=count($result)+0;
		insert_wechat_user_instruct("count",$count);
		if($count>0){
			if($count<=10){
				for($i=0;$i<$count;$i++){
					$name=$result[$i]['name'];
				//	$room=mb_convert_encoding($result[$i]['room'],"UTF-8","gbk");
				//	$time=mb_convert_encoding($result[$i]['time'],"UTF-8","gbk");
					$time=$result[$i]['time'];
					$content=$content."\n".$name."\n".$room."  ".$time;	
				}
			}else{
				insert_wechat_user_instruct("in","in");
				for($i=0;$i<10;$i++){
					$name=$result[$i]['name'];
					$room=$result[$i]['room'];
//					$room=mb_convert_encoding($result[$i]['room'],"UTF-8","gbk");
				//	$time=mb_convert_encoding($result[$i]['time'],"UTF-8","gbk");
					$time=$result[$i]['time'];
					$content=$content."\n".$name."\n".$room."  ".$time;	
				}
					$content=$content."
					"."<a href='".URL::$LOCAL."/mobile/index.php?action=%s&lesson_time=%s'>�鿴����</a>";
					$action="show_lesson_with_time";
					$action = urlencode($action);
					$lesson_time=$time;
					$lesson_time=mb_convert_encoding($lesson_time,"UTF-8","gbk");
					$lesson_time = urlencode($lesson_time);
					$content=sprintf($content,$action,$lesson_time);
			}
		}else{
			$content=false;
		}
		return $content;
}
function insert_room_record($openid, $name, $url, $intro="��"){
	$name=mb_convert_encoding($name,"gbk","UTF-8");
	$db = new saeDatabase();
	$sql = "select count(*) from room_record where openid='%s' and name='%s'";
	$sql = sprintf($sql, $openid, $name);

	$result = $db->select($sql);
	$count = $result[0]['count(*)'];

	if ($count > 0){				//�Ѿ��������������
		return false;
	}else{							//���������������
		$sql = "insert into room_record(openid,name,url,intro) values('%s','%s','%s','%s')";
		$sql = sprintf($sql, $openid, $name, $url, $intro);
		$db->query($sql);
		return true;
	}
}
function get_room_record($cur_page = 1){
	$sql = "select name,url from room_record";
	$db = new saeDatabase();
	$subject_list = $db->select($sql);
	$count = count($subject_list)+1;
	
	for($i=0;$i<$count;$i++){
		if ($i < 8){	//���ƾ������
			if ($i == 0){		//��һ���item
				$data = mb_convert_encoding("������ѯ", "UTF-8", "gbk");
				$picText_list[$i]['Title'] = $data;
				$picText_list[$i]['PicUrl'] = URL::$LOCAL."/wechat/pic/wechat_room.jpg";
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['Url'] = "";
			}else{
				$data = mb_convert_encoding($subject_list[$i-1]['name'], "UTF-8", "gbk");
				$url = $subject_list[$i-1]["url"];
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['PicUrl'] = "";
				$picText_list[$i]['Title'] = $data;
				$picText_list[$i]['Url'] = $url;
			}
			
		}else{
			break;
		}
	}
	$data = "1���ز��			2��ҳ";
	$data = mb_convert_encoding($data, "UTF-8", "gbk");
	$picText_list[$i]['Title'] = $data;
	$picText_list[$i]['PicUrl'] = "";
	$picText_list[$i]['Description'] = "";
	$picText_list[$i]['Url'] = "http://3.szunbbs.sinaapp.com/mobile/index.php?action=".$action."&id='getmore'";
	return $picText_list;
}
function get_my_room_record($openid){
	$db = new saeDatabase();
	$sql = "select id,name,url from room_record where openid='%s' order by id";
	$sql = sprintf($sql, $openid);
	$subject_list = $db->select($sql);

	$count = count($subject_list);

	for($i=0;$i<$count;$i++){
		
		if ($i < 8){	//���ƾ������
			$content = $content."��".$i."��<a href='".$subject_list[$i]['url']."'>".$subject_list[$i]['name']."</a>\n";
		}else{
			break;
		}
	}
	return $content;
}
function delete_room_with_orderNum($openid,$roomid){
	$db = new saeDatabase();
	$sql = "select id from room_record where openid='%s' order by id";
	$sql = sprintf($sql, $openid);
	$subject_list = $db->select($sql);

	$count = count($subject_list);

	for($i=0;$i<$count;$i++){
		
		if ($i < 8){	//���ƾ������
			if ($i == $roomid){			//��Ӧ�±�ļ�¼ɾ��
				$id = $subject_list[$i]['id'];
				$sql = "delete from room_record where id='%s'";
				$sql = sprintf($sql, $id);
				$db->query($sql);
				return true;
			}
		}else{
			break;
		}
	}
	return false;
}
/*
 * �����û������¼
 */
function insert_wechat_user_instruct($openid,$content){
	$sql="insert into wechat_user_instruct(openid,content) values ('%s','%s')";

	$content = mb_convert_encoding($content,"gbk","UTF-8");
	$sql=sprintf($sql,$openid,$content);
	$db = new saeDatabase();
	$db->query($sql);
	return true;
}
/*
 * ͨ��interface.php�е�activity_apply_type�����ַ����õ�����
 */
function get_type_with_activity_apply_type(){
	$type_str = WINDOWS::$type['activity_apply_type'];
	$type_str = str_replace("��", ";", $type_str);
	$type_str = str_replace("��", ";", $type_str);
	$type_list = explode(";",$type_str);
	$count = count($type_list);

	for ($i=0,$j=0;$i<$count;$i++){
		if ($i!==0){
			/*$num = $i%2;
			if ($num === 0){*/
				$my_type_list[$j++]=mb_convert_encoding($type_list[1],"UTF-8","gbk");
			//}
		}
	}
	return $my_type_list;
}
/*
 * ����ͨͼ�Ļ�ȡ
 */
function getGwtList(){
	$sql = "select title,id from gongwentong order by time desc";
	$db = new saeDatabase();
	$subject_list = $db->select($sql);
	$count = count($subject_list)+1;
	
	for($i=0;$i<$count;$i++){
		if ($i < 8){	//���ƾ������
			if ($i == 0){		//��һ���item
				$data = mb_convert_encoding("����ͨ", "UTF-8", "gbk");
				//$data = "����ͨ";
				$picText_list[$i]['Title'] = $data;
				$picText_list[$i]['PicUrl'] = URL::$LOCAL."/wechat/pic/gongwentong.jpg";
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['Url'] = "http://www.szu.edu.cn";
			}else{
				$data = mb_convert_encoding($subject_list[$i-1]['title'], "UTF-8", "gbk");
				//$data = $subject_list[$i-1]['title'];
				$data=str_replace("<b>","","$data");
				$data=str_replace("</b>","","$data");
				$data=str_replace("<font color=black>","","$data");
				$data=str_replace("</font>","","$data");
				$picText_list[$i]['Description'] = "";
				$picText_list[$i]['PicUrl'] = "";
				$picText_list[$i]['Title'] = $data;
				$action = 'gwt';
				$action = urlencode($action);
				$picText_list[$i]['Url'] = URL::$LOCAL."/mobile/index.php?action=".$action."&id=".$subject_list[$i-1]['id'];
			}
			
		}else{
			break;
		}
	}
	$data = mb_convert_encoding("�鿴����", "UTF-8", "gbk");
	//$data = "�鿴����";
	$picText_list[$i]['Title'] = $data;
	$picText_list[$i]['PicUrl'] = "";
	$picText_list[$i]['Description'] = "";
	$action = 'gwt_more';
	$picText_list[$i]['Url'] = URL::$LOCAL."/mobile/index.php?action=".$action."&id='getmore'";
	return $picText_list;
}
/*
 * ��ȡ��ط���Ĭ�������������Ѷ
 */
function getArticleWithServiceId($id=2){
	return 0;
}
?>